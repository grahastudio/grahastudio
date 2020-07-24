<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Download_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_alldownload()
    {
        $this->db->select('*');
        $this->db->from('download');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_download($limit, $start)
    {
        $this->db->select('download. *, category.category_name, category.category_slug');
        $this->db->from('download');
        // Join
        $this->db->join('category', 'category.id = download.category_id', 'LEFT');
        //End Join
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    // Total Row Untuk Paginasi
    public function total_row()
    {
        $this->db->select('download.*, user.user_name');
        $this->db->from('download');
        // Join
        $this->db->join('user', 'user.id = download.user_id', 'LEFT');
        //End Join
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    //Total Berita Main Page
    public function total()
    {
        $this->db->select('download.*,category.category_name, user.user_name');
        $this->db->from('download');
        // Join
        $this->db->join('category', 'category.id = download.category_id', 'LEFT');
        $this->db->join('user', 'user.id = download.user_id', 'LEFT');
        //End Join
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function detail_download($id)
    {
        $this->db->select('*');
        $this->db->from('download');
        $this->db->where('id', $id);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->row();
    }
    //Read Berita
    public function read($download_slug)
    {
        $this->db->select('download. *, category.category_name, category.category_slug, user.user_name');
        $this->db->from('download');
        // Join
        $this->db->join('category', 'category.id = download.category_id', 'LEFT');
        $this->db->join('user', 'user.id = download.user_id', 'LEFT');
        //End Join
        $this->db->where(array(
            'download.download_slug'      =>  $download_slug
        ));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }

    public function create($data)
    {
        $this->db->insert('download', $data);
    }
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('download', $data);
    }
    //Delete Data
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('download', $data);
    }

    // Halaman Depan

    public function popular_download()
    {
      $this->db->select('*');
      $this->db->from('download');
      $this->db->order_by('download_views', 'DESC');
      $this->db->limit(5);
      $query = $this->db->get();
      return $query->result();
    }

    public function download_category($category_id,$limit,$start)
    {
      $this->db->select('download.*,category.category_name, category.category_slug, user.user_name');
      $this->db->from('download');
      // Join
      $this->db->join('category', 'category.id = download.category_id', 'LEFT');
      $this->db->join('user', 'user.id = download.user_id', 'LEFT');
      //End Join
      $this->db->where(array( 'download.category_id'      =>  $category_id));
      $this->db->order_by('download.id','DESC');
      $this->db->limit($limit,$start);
      $query = $this->db->get();
      return $query->result();
    }

    public function total_category($category_id)
    {
      $this->db->select('download.*,category.category_name, category.category_slug, user.user_name');
      $this->db->from('download');
      // Join
      $this->db->join('category', 'category.id = download.category_id', 'LEFT');
      $this->db->join('user', 'user.id = download.user_id', 'LEFT');
      //End Join
      $this->db->where(array( 'download.category_id'      =>  $category_id));
      $this->db->order_by('download.id','DESC');
      $query = $this->db->get();
      return $query->result();
    }


    function update_counter($download_slug)
    {
        // return current article views
        $this->db->where('download_slug', urldecode($download_slug));
        $this->db->select('download_views');
        $count = $this->db->get('download')->row();
        // then increase by one
        $this->db->where('download_slug', urldecode($download_slug));
        $this->db->set('download_views', ($count->download_views + 1));
        $this->db->update('download');
    }


}
