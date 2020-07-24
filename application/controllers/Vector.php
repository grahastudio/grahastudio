<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vector extends CI_Controller
{

  //Load Model
  public function __construct()
  {
    parent::__construct();
    $this->load->model('user_model');
    $this->load->model('transaksi_model');
    $this->load->model('meta_model');
    $this->load->model('vector_model');
    $this->load->model('bank_model');
    $this->load->library('pagination');
  }

  //main page - Berita
  public function index()
  {
    $meta               = $this->meta_model->get_meta();
    $vector             = $this->vector_model->get_allvector();

    // End Listing Berita dengan paginasi
    $data = array(
      'title'                 => 'Product - vector graphic ',
      'deskripsi'             => 'Product - Jasa pembuatan Foto vector murah dan berkualitas',
      'keywords'              => 'Produk - Jasa pembuatan desain vector, jasa pembuatan sketsa, jasa foto vector, jasa foto kartun',
      'vector'                => $vector,
      'content'             => 'front/vector/index_vector'
    );
    $this->load->view('front/layout/wrapp', $data, FALSE);
  }
  public function order($vector_slug = NULL)
  {
    if (!empty($vector_slug)) {
      $vector_slug;
    } else {
      redirect(base_url('vector'));
    }
    $meta               = $this->meta_model->get_meta();
    $vector             = $this->vector_model->read($vector_slug);

    // Validasi
    $this->form_validation->set_rules(
      'user_name',
      'Nama Lengkap',
      'required',
      [
        'required'      => 'Nama Lengkap harus di isi',
      ]
    );

    if ($this->form_validation->run()) {

      $config['upload_path']          = './assets/img/order/vector/';
      $config['allowed_types']        = 'gif|jpg|png|jpeg';
      $config['max_size']             = 5000; //Dalam Kilobyte
      $config['max_width']            = 5000; //Lebar (pixel)
      $config['max_height']           = 5000; //tinggi (pixel)
      $this->load->library('upload', $config);
      if (!$this->upload->do_upload('image')) {

        //End Validasi
        $data = [
          'title'                 => 'Order Vector ' .$vector->vector_name,
          'deskripsi'             => 'Vector - ' .$vector->vector_desc,
          'keywords'              => 'Vector - ' .$vector->vector_keywords,
          'vector'                => $vector,
          'error_upload'          => $this->upload->display_errors(),
          'content'               => 'front/vector/order_vector'
        ];
        $this->load->view('front/layout/wrapp', $data, FALSE);

        //Masuk Database

      } else {

        //Proses Manipulasi Gambar
        $upload_data    = array('uploads'  => $this->upload->data());
        //Gambar Asli disimpan di folder assets/upload/image
        //lalu gambara Asli di copy untuk versi mini size ke folder assets/upload/image/thumbs

        $config['image_library']    = 'gd2';
        $config['source_image']     = './assets/img/order/vector/' . $upload_data['uploads']['file_name'];
        //Gambar Versi Kecil dipindahkan
        // $config['new_image']        = './assets/img/artikel/thumbs/' . $upload_data['uploads']['file_name'];
        $config['create_thumb']     = TRUE;
        $config['maintain_ratio']   = TRUE;
        $config['width']            = 5000;
        $config['height']           = 5000;
        $config['thumb_marker']     = '';

        $this->load->library('image_lib', $config);
        $this->image_lib->resize();

        $data  = [
          'user_id'           => $this->session->userdata('id'),
          'transaction_code'  => $this->input->post('transaction_code'),
          'product'           => $this->input->post('product'),
          'description'       => $this->input->post('description'),
          'unique_code'       => $this->input->post('unique_code'),
          'price'             => $this->input->post('price'),
          'payment_status'    => 'Belum',
          'order_status'      => 'Belum',
          'user_name'         => $this->input->post('user_name'),
          'email'             => $this->input->post('email'),
          'user_phone'        => $this->input->post('user_phone'),
          'user_address'       => $this->input->post('user_address'),
          'image'             => $upload_data['uploads']['file_name'],
          'date_created'      => time()
        ];
        $insert_id = $this->transaksi_model->create($data);
        $this->session->set_flashdata('message', 'Data Berita telah ditambahkan');
        redirect(base_url('vector/success/'.$insert_id), 'refresh');
      }
    }
    //End Masuk Database
    $data = [
      'title'                 => 'Order Vector ' .$vector->vector_name,
      'deskripsi'             => 'Vector - ' .$vector->vector_desc,
      'keywords'              => 'Vector - ' .$vector->vector_keywords,
      'vector'                => $vector,
      'content'               => 'front/vector/order_vector'
    ];
    $this->load->view('front/layout/wrapp', $data, FALSE);
  }
  public function success($insert_id = NULL)
  {
    if (!empty($insert_id)) {
      $insert_id;
    } else {
      redirect(base_url('vector'));
    }
    $bank               = $this->bank_model->get_allbank();
    $meta               = $this->meta_model->get_meta();
    $last_transaksi     = $this->transaksi_model->last_transaksi($insert_id);
    // End Listing Berita dengan paginasi
    $data = array(
      'title'                 => 'Product - vector graphic ',
      'deskripsi'             => 'Product - Jasa pembuatan Foto vector murah dan berkualitas',
      'keywords'              => 'Produk - Jasa pembuatan desain vector, jasa pembuatan sketsa, jasa foto vector, jasa foto kartun',
      'last_transaksi'        => $last_transaksi,
      'meta'                  => $meta,
      'bank'                  => $bank,
      'content'               => 'front/vector/order_success'
    );
    $this->load->view('front/layout/wrapp', $data, FALSE);
  }
}


/* End of file Vector.php */
/* Location: ./application/controllers/Vector.php */
