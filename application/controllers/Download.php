<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Download extends CI_Controller
{

    //Load Model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('download_model');
        $this->load->model('category_model');
        $this->load->model('transaksi_model');
        $this->load->model('bank_model');
        $this->load->model('meta_model');
        $this->load->library('pagination');
    }

    //main page - Download
    public function index()
    {
        $meta                 = $this->meta_model->get_meta();
        $popular_download     = $this->download_model->popular_download();
        $category_download    = $this->category_model->get_category_download();
        // $recent_post        = $this->download_model->recent_post();



        // Listing Download Dengan Pagination
        $this->load->library('pagination');

        $config['base_url']       = base_url('download/index/');
        $config['total_rows']     = count($this->download_model->total());
        $config['per_page']       = 1;
        $config['uri_segment']    = 3;

        //Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        //Limit dan Start
        $limit                    = $config['per_page'];
        $start                    = ($this->uri->segment(3)) ? ($this->uri->segment(3)) : 0;
        //End Limit Start
        $this->pagination->initialize($config);

        $download                   = $this->download_model->get_download($limit, $start);
        // End Listing Download dengan paginasi
        $data = array(
            'title'                 => 'Download - ' . $meta->title,
            'deskripsi'             => 'Download - ' . $meta->description,
            'keywords'              => 'Download - ' . $meta->keywords,
            'pagination'            => $this->pagination->create_links(),
            'download'              => $download,
            'popular_download'      => $popular_download,
            'category_download'     => $category_download,
            // 'recent_post'           => $recent_post,
            'content'               => 'front/download/index_download'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }

    //main page - detail Download
    public function detail($download_slug = NULL)
    {
        if (!empty($download_slug)) {
            $download_slug;
        } else {
            redirect(base_url('download'));
        }

        $download           = $this->download_model->read($download_slug);
        $popular_download     = $this->download_model->popular_download();
        $category_download    = $this->category_model->get_category_download();


        $this->form_validation->set_rules(
           'transaction_code',
           'Nama',
           'required',
           [
               'required'      => 'Nama harus di isi',
           ]
       );

       if ($this->form_validation->run() === FALSE) {

        $data = array(
            'title'                 => $download->download_title,
            'deskripsi'             => $download->download_title,
            'keywords'              => $download->download_keywords,
            'download'              => $download,
            'popular_download'      => $popular_download,
            'category_download'     => $category_download,
            'content'               => 'front/download/detail_download'
        );
        $this->add_count($download_slug);
        $this->load->view('front/layout/wrapp', $data, FALSE);
}else{

        $data  = [
          'user_id'           => $this->session->userdata('id'),
          'transaction_code'  => $this->input->post('transaction_code'),
          'product'           => $this->input->post('product'),
          'price'             => $this->input->post('price'),
          'payment_status'    => $this->input->post('payment_status'),
          'order_status'      => $this->input->post('order_status'),
          'user_name'         => $this->input->post('user_name'),
          'email'             => $this->input->post('email'),
          'date_created'      => time()
        ];
        $insert_id = $this->transaksi_model->create($data);
        $this->session->set_flashdata('message', 'Data Download telah ditambahkan');
        redirect(base_url('transaksi'), 'refresh');

      }


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






    //  Category Article
  public function category($slug_kategori = NULL)
  {
    if (!empty($slug_kategori)) {
        $slug_kategori;
    } else {
        redirect(base_url('download'));
    }

    $category                   = $this->category_model->read($slug_kategori);
    $category_id                = $category->id;
    $popular_download     = $this->download_model->popular_download();
    $category_download    = $this->category_model->get_category_download();

    // $meta                       = $this->meta_model->listing();
    // Listing Download Dengan Pagination
    $this->load->library('pagination');

    $config['base_url']       = base_url('download/category/'.$category->category_slug.'/index/');
    $config['total_rows']     = count($this->download_model->total_category($category_id));
    $config['per_page']       = 1;
    $config['uri_segment']    = 5;

    //Membuat Style pagination untuk BootStrap v4
    $config['first_link']       = 'First';
    $config['last_link']        = 'Last';
    $config['next_link']        = 'Next';
    $config['prev_link']        = 'Prev';
    $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
    $config['full_tag_close']   = '</ul></nav></div>';
    $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
    $config['num_tag_close']    = '</span></li>';
    $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
    $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
    $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
    $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['prev_tagl_close']  = '</span>Next</li>';
    $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
    $config['first_tagl_close'] = '</span></li>';
    $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
    $config['last_tagl_close']  = '</span></li>';

    //Limit dan Start
    $limit                    = $config['per_page'];
    $start                    = ($this->uri->segment(5)) ? ($this->uri->segment(5)) : 0;
    //End Limit Start
    $this->pagination->initialize($config);

    $download                   = $this->download_model->download_category($category_id,$limit,$start);
    // End Listing Download
    $data = array(
        'title'       => 'Kategori Download - '.$category->category_name,
        'deskripsi'   => 'Kategori Download - '.$category->category_name,
        'keywords'    => 'Kategori Download - '.$category->category_name,
        'pagination'    => $this->pagination->create_links(),
        'download'      => $download,
        'category_download'      => $category_download,
        'popular_download'      => $popular_download,
        'content'         => 'front/download/index_download'
  );
  $this->load->view('front/layout/wrapp', $data, FALSE);
}

    // This is the counter function..
    function add_count($download_slug)
    {
        // load cookie helper
        $this->load->helper('cookie');
        // this line will return the cookie which has slug name
        $check_visitor_download = $this->input->cookie(urldecode($download_slug), FALSE);
        // this line will return the visitor ip address
        $ip = $this->input->ip_address();
        // if the visitor visit this article for first time then //
        //set new cookie and update article_views column  ..
        //you might be notice we used slug for cookie name and ip
        //address for value to distinguish between articles  views
        if ($check_visitor_download == false) {
            $cookie = array(
                "name"   => urldecode($download_slug),
                "value"  => "$ip",
                "expire" =>  time() + 7200,
                "secure" => false
            );
            $this->input->set_cookie($cookie);
            $this->download_model->update_counter(urldecode($download_slug));
        }
    }
}

/* End of file download.php */
/* Location: ./application/controllers/Download.php */
