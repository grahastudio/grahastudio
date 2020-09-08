<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Website extends CI_Controller
{
    //load data
    public function __construct()
    {
        parent::__construct();
        $this->load->model('portfolio_model');
        $this->load->model('website_model');
        $this->load->library('pagination');

        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        if ($user->role_id == 2) {
            redirect('admin/dashboard');
        }
    }
    //listing data portfolio
    public function index()
    {
        $config['base_url']       = base_url('admin/website/index/');
        $config['total_rows']     = count($this->website_model->total_row());
        $config['per_page']       = 5;
        $config['uri_segment']    = 4;
        // $config['use_page_numbers'] = TRUE;
        // $config['page_query_string'] = true;
        // $config['query_string_segment'] = 'page';




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
        $start                    = ($this->uri->segment(4)) ? ($this->uri->segment(4)) : 0;
        //End Limit Start
        $this->pagination->initialize($config);


        $website = $this->website_model->get_website($limit, $start);
        $data = [
            'title'         => 'Data Website',
            'website'        => $website,
            'pagination'    => $this->pagination->create_links(),
            'content'       => 'admin/website/index_website'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    //Create New Portfolio
    public function create()
    {
        $this->form_validation->set_rules(
            'website_name',
            'Nama Produk',
            'required',
            [
                'required'      => 'Nama Produk harus di isi',
            ]
        );
        if ($this->form_validation->run()) {

            $config['upload_path']          = './assets/img/product/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|svg';
            $config['max_size']             = 5000; //Dalam Kilobyte
            $config['max_width']            = 5000; //Lebar (pixel)
            $config['max_height']           = 5000; //tinggi (pixel)
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('website_image')) {

                //End Validasi
                $data = [
                    'title'        => 'Tambah Produk',
                    'error_upload' => $this->upload->display_errors(),
                    'content'       => 'admin/website/create_website'
                ];
                $this->load->view('admin/layout/wrapp', $data, FALSE);

                //Masuk Database

            } else {

                //Proses Manipulasi Gambar
                $upload_data    = array('uploads'  => $this->upload->data());
                //Gambar Asli disimpan di folder assets/upload/image
                //lalu gambara Asli di copy untuk versi mini size ke folder assets/upload/image/thumbs

                $config['image_library']    = 'gd2';
                $config['source_image']     = './assets/img/product/' . $upload_data['uploads']['file_name'];
                //Gambar Versi Kecil dipindahkan
                // $config['new_image']        = './assets/img/artikel/thumbs/' . $upload_data['uploads']['file_name'];
                $config['create_thumb']     = TRUE;
                $config['maintain_ratio']   = TRUE;
                $config['width']            = 500;
                $config['height']           = 500;
                $config['thumb_marker']     = '';

                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $slugcode               = random_string('numeric', 5);
                $website_slug            = url_title($this->input->post('website_name'), 'dash', TRUE);
                $data  = [
                    'user_id'           => $this->session->userdata('id'),
                    'website_slug'       => $slugcode . '-' .$website_slug,
                    'website_name'       => $this->input->post('website_name'),
                    'website_price'      => $this->input->post('website_price'),
                    'website_discount'   => $this->input->post('website_discount'),
                    'website_renewal'       => $this->input->post('website_renewal'),
                    'website_image'      => $upload_data['uploads']['file_name'],
                    'website_desc'       => $this->input->post('website_desc'),
                    'website_keywords'   => $this->input->post('website_keywords'),
                    'date_created'      => time()
                ];
                $this->website_model->create($data);
                $this->session->set_flashdata('message', 'Data Produk telah ditambahkan');
                redirect(base_url('admin/website'), 'refresh');
            }
        }
        //End Masuk Database
        $data = [
            'title'             => 'Buat Produk Website',
            'content'           => 'admin/website/create_website'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }


    //Edit Website
    public function Update($id)
    {
        $website = $this->website_model->detail_website($id);
        //Validasi
        $valid = $this->form_validation;

        $valid->set_rules(
            'website_name',
            'Nama Produk',
            'required',
            ['required'      => '%s harus diisi']
        );

        if ($valid->run()) {
            //Kalau nggak Ganti gambar
            if (!empty($_FILES['website_image']['name'])) {

                $config['upload_path']          = './assets/img/product/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg|svg';
                $config['max_size']             = 5000; //Dalam Kilobyte
                $config['max_width']            = 5000; //Lebar (pixel)
                $config['max_height']           = 5000; //tinggi (pixel)
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('website_image')) {

                    //End Validasi
                    $data = [
                        'title'        => 'Edit Produk Website',
                        'berita'       => $website,
                        'error_upload' => $this->upload->display_errors(),
                        'content'          => 'admin/website/update_website'
                    ];
                    $this->load->view('admin/layout/wrapp', $data, FALSE);

                    //Masuk Database

                } else {

                    //Proses Manipulasi Gambar
                    $upload_data    = array('uploads'  => $this->upload->data());
                    //Gambar Asli disimpan di folder assets/upload/image
                    //lalu gambar Asli di copy untuk versi mini size ke folder assets/upload/image/thumbs

                    $config['image_library']    = 'gd2';
                    $config['source_image']     = './assets/img/product/' . $upload_data['uploads']['file_name'];
                    //Gambar Versi Kecil dipindahkan
                    // $config['new_image']        = './assets/img/artikel/thumbs/' . $upload_data['uploads']['file_name'];
                    $config['create_thumb']     = TRUE;
                    $config['maintain_ratio']   = TRUE;
                    $config['width']            = 500;
                    $config['height']           = 500;
                    $config['thumb_marker']     = '';

                    $this->load->library('image_lib', $config);

                    $this->image_lib->resize();

                    // Hapus Gambar Lama Jika Ada upload gambar baru
                    if ($website->website_image != "") {
                        unlink('./assets/img/product/' . $website->website_image);
                        // unlink('./assets/img/artikel/thumbs/' . $berita->berita_gambar);
                    }
                    //End Hapus Gambar

                    $data  = [
                        'id'                => $id,
                        'user_id'           => $this->session->userdata('id'),
                        'website_name'       => $this->input->post('website_name'),
                        'website_price'      => $this->input->post('website_price'),
                        'website_discount'   => $this->input->post('website_discount'),
                        'website_area'       => $this->input->post('website_area'),
                        'website_file'       => $this->input->post('website_file'),
                        'website_print'      => $this->input->post('website_print'),
                        'website_frame'      => $this->input->post('website_frame'),
                        'website_image'      => $upload_data['uploads']['file_name'],
                        'website_desc'       => $this->input->post('website_desc'),
                        'website_keywords'   => $this->input->post('website_keywords'),
                        'date_updated'      => time()
                    ];
                    $this->website_model->update($data);
                    $this->session->set_flashdata('message', 'Data telah di Update');
                    redirect(base_url('admin/website'), 'refresh');
                }
            } else {
                //Update Berita Tanpa Ganti Gambar
                // Hapus Gambar Lama Jika ada upload gambar baru
                if ($website->website_image != "")
                    $data  = [
                        'id'         => $id,
                        'user_id'           => $this->session->userdata('id'),
                        'website_name'       => $this->input->post('website_name'),
                        'website_price'      => $this->input->post('website_price'),
                        'website_discount'   => $this->input->post('website_discount'),
                        'website_area'       => $this->input->post('website_area'),
                        'website_file'       => $this->input->post('website_file'),
                        'website_print'      => $this->input->post('website_print'),
                        'website_frame'      => $this->input->post('website_frame'),
                        'website_desc'       => $this->input->post('website_desc'),
                        'website_keywords'   => $this->input->post('website_keywords'),
                        'date_updated'      => time()
                    ];
                $this->website_model->update($data);
                $this->session->set_flashdata('message', 'Data telah di Update');
                redirect(base_url('admin/website'), 'refresh');
            }
        }
        //End Masuk Database
        $data = [
            'title'             => 'Update Produk Website',
            'website'            => $website,
            'content'           => 'admin/website/update_website'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    //delete
    public function delete($id)
    {
        //Proteksi delete
        is_login();

        $portfolio = $this->portfolio_model->portfolio_detail($id);
        //Hapus gambar

        if ($portfolio->portfolio_gambar != "") {
            unlink('./assets/img/portfolio/' . $portfolio->portfolio_gambar);
            // unlink('./assets/img/artikel/thumbs/' . $portfolio->portfolio_gambar);
        }
        //End Hapus Gambar
        $data = ['id'   => $portfolio->id];
        $this->portfolio_model->delete($data);
        $this->session->set_flashdata('message', 'Data telah di Hapus');
        redirect($_SERVER['HTTP_REFERER']);
    }
}
