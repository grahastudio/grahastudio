<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Website_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_allwebsite()
    {
        $this->db->select('*');
        $this->db->from('website');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_website($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('website');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    // Total Row Untuk Paginasi
    public function total_row()
    {
        $this->db->select('website.*, user.user_name');
        $this->db->from('website');
        // Join
        $this->db->join('user', 'user.id = website.user_id', 'LEFT');
        //End Join
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function detail_website($id)
    {
        $this->db->select('*');
        $this->db->from('website');
        $this->db->where('id', $id);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->row();
    }
    //Read Berita
    public function read($website_slug)
    {
        $this->db->select('*');
        $this->db->from('website');
        // Join

        //End Join
        $this->db->where(array(
            'website.website_slug'      =>  $website_slug
        ));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }

    public function create($data)
    {
        $this->db->insert('website', $data);
    }
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('website', $data);
    }
    //Delete Data
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('website', $data);
    }
}
