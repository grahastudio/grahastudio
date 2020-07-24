<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vector_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_allvector()
    {
        $this->db->select('*');
        $this->db->from('vector');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_vector($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('vector');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
    // Total Row Untuk Paginasi
    public function total_row()
    {
        $this->db->select('vector.*, user.user_name');
        $this->db->from('vector');
        // Join
        $this->db->join('user', 'user.id = vector.user_id', 'LEFT');
        //End Join
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function detail_vector($id)
    {
        $this->db->select('*');
        $this->db->from('vector');
        $this->db->where('id', $id);
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->row();
    }
    //Read Berita
    public function read($vector_slug)
    {
        $this->db->select('*');
        $this->db->from('vector');
        // Join

        //End Join
        $this->db->where(array(
            'vector.vector_slug'      =>  $vector_slug
        ));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->row();
    }

    public function create($data)
    {
        $this->db->insert('vector', $data);
    }
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('vector', $data);
    }
    //Delete Data
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('vector', $data);
    }
}
