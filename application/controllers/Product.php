<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{

    //Load Model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('berita_model');
        $this->load->model('category_model');
        $this->load->model('meta_model');
        $this->load->library('pagination');
    }

    //main page - Berita
    public function index()
    {
        $meta               = $this->meta_model->get_meta();

        // End Listing Berita dengan paginasi
        $data = array(
            'title'                 => 'Blog - ' . $meta->title,
            'deskripsi'             => 'Blog - ' . $meta->description,
            'keywords'              => 'Blog - ' . $meta->keywords,
            'content'               => 'front/product/index_product'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
    public function vector()
    {
        $meta               = $this->meta_model->get_meta();

        // End Listing Berita dengan paginasi
        $data = array(
            'title'                 => 'Product - vector graphic ',
            'deskripsi'             => 'Product - Jasa pembuatan Foto vector murah dan berkualitas',
            'keywords'              => 'Produk - Jasa pembuatan desain vector, jasa pembuatan sketsa, jasa foto vector, jasa foto kartun',
            'content'               => 'front/product/vector'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }
    public function desain()
    {

    }
    public function website()
    {

    }
    public function websystem()
    {

    }
    public function application()
    {

    }
    public function video()
    {

    }
}

/* End of file berita.php */
/* Location: ./application/controllers/Berita.php */
