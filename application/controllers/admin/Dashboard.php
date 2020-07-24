<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('berita_model');

    }

    public function index()
    {

        $list_user              = $this->user_model->user_dashboard();
        $berita                 = $this->berita_model->get_allberita();


        $data = [
            'title'             => 'Dashboard',
            'list_user'         => $list_user,

            'berita'            => $berita,
            'content'           => 'admin/dashboard/dashboard'

        ];

        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
}
