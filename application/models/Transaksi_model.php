<?php
defined('BASEPATH') or exit('No direct script access allowed');

class transaksi_model extends CI_Model
{
    //load database
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_alltransaksi()
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_transaksi($limit, $start)
    {
        $this->db->select('transaksi.*,
                       category.category_name, user.user_name');
        $this->db->from('transaksi');
        // Join
        $this->db->join('category', 'category.id = transaksi.category_id', 'LEFT');
        $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
        //End Join
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    //Total transaksi Main Page
    public function total_row()
    {
        $this->db->select('transaksi.*,category.category_name, user.user_name');
        $this->db->from('transaksi');
        // Join
        $this->db->join('category', 'category.id = transaksi.category_id', 'LEFT');
        $this->db->join('user', 'user.id = transaksi.user_id', 'LEFT');
        //End Join
        $this->db->where(['transaksi_status'     =>  'Publish']);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function transaksi_detail($id)
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    //Kirim Data transaksi ke database
    public function create($data)
    {
        $this->db->insert('transaksi', $data);
    }
    //Update Data
    public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('transaksi', $data);
    }
    //Hapus Data Dari Database
    public function delete($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->delete('transaksi', $data);
    }

    
}
