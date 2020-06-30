<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Portfolio_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_allportfolio()
    {
        $this->db->select('*');
        $this->db->from('portfolio');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_portfolio($limit, $start)
    {
        $this->db->select('portfolio.*,
                       category.category_name, user.user_name');
        $this->db->from('portfolio');
        // Join
        $this->db->join('category', 'category.id = portfolio.category_id', 'LEFT');
        $this->db->join('user', 'user.id = portfolio.user_id', 'LEFT');
        //End Join
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    //Total Portfolio Main Page
    public function total_row()
    {
        $this->db->select('portfolio.*,category.category_name, user.user_name');
        $this->db->from('portfolio');
        // Join
        $this->db->join('category', 'category.id = portfolio.category_id', 'LEFT');
        $this->db->join('user', 'user.id = portfolio.user_id', 'LEFT');
        //End Join
        $this->db->where(['portfolio_status'     =>  'Publish']);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function portfolio_detail($id)
    {
        $this->db->select('*');
        $this->db->from('portfolio');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    //Kirim Data Portfolio ke database
    public function create($data)
    {
        $this->db->insert('portfolio', $data);
    }
    //Update Data
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('portfolio', $data);
    }
    //Hapus Data Dari Database
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('portfolio', $data);
    }

    // Data Portfolio yang di tampilkan di Front End

    //listing Portfolio Main Page
    public function portfolio($limit, $start)
    {
        $this->db->select('portfolio.*,category.category_name, user.user_name');
        $this->db->from('portfolio');
        // Join
        $this->db->join('category', 'category.id = portfolio.category_id', 'LEFT');
        $this->db->join('user', 'user.id = portfolio.user_id', 'LEFT');
        //End Join
        $this->db->where(['portfolio_status'     =>  'Publish']);
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    //Total Portfolio Main Page
    public function total()
    {
        $this->db->select('portfolio.*,category.category_name, user.user_name');
        $this->db->from('portfolio');
        // Join
        $this->db->join('category', 'category.id = portfolio.category_id', 'LEFT');
        $this->db->join('user', 'user.id = portfolio.user_id', 'LEFT');
        //End Join
        $this->db->where(['portfolio_status'     =>  'Publish']);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    //Read Portfolio
    public function read($portfolio_slug)
    {
        $this->db->select('portfolio.*,category.category_name, user.user_name, user.user_image, user.user_bio');
        $this->db->from('portfolio');
        // Join
        $this->db->join('category', 'category.id = portfolio.category_id', 'LEFT');
        $this->db->join('user', 'user.id = portfolio.user_id', 'LEFT');
        //End Join
        $this->db->where(array(
            'portfolio_status'           =>  'Publish',
            'portfolio.portfolio_slug'      =>  $portfolio_slug
        ));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }

    function update_counter($portfolio_slug)
    {
        // return current article views
        $this->db->where('portfolio_slug', urldecode($portfolio_slug));
        $this->db->select('portfolio_views');
        $count = $this->db->get('portfolio')->row();
        // then increase by one
        $this->db->where('portfolio_slug', urldecode($portfolio_slug));
        $this->db->set('portfolio_views', ($count->portfolio_views + 1));
        $this->db->update('portfolio');
    }
}
