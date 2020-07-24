<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vector extends CI_Controller
{
    //load data
    public function __construct()
    {
        parent::__construct();
        $this->load->model('portfolio_model');
        $this->load->model('vector_model');
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
        $config['base_url']       = base_url('admin/vector/index/');
        $config['total_rows']     = count($this->vector_model->total_row());
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


        $vector = $this->vector_model->get_vector($limit, $start);
        $data = [
            'title'         => 'Data Vector',
            'vector'        => $vector,
            'pagination'    => $this->pagination->create_links(),
            'content'       => 'admin/vector/index_vector'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    //Create New Portfolio
    public function create()
    {
        $this->form_validation->set_rules(
            'vector_name',
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
            if (!$this->upload->do_upload('vector_image')) {

                //End Validasi
                $data = [
                    'title'        => 'Tambah Produk',
                    'error_upload' => $this->upload->display_errors(),
                    'content'       => 'admin/vector/create_vector'
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
                $vector_slug            = url_title($this->input->post('vector_name'), 'dash', TRUE);
                $data  = [
                    'user_id'           => $this->session->userdata('id'),
                    'vector_slug'       => $slugcode . '-' .$vector_slug,
                    'vector_name'       => $this->input->post('vector_name'),
                    'vector_price'      => $this->input->post('vector_price'),
                    'vector_discount'   => $this->input->post('vector_discount'),
                    'vector_area'       => $this->input->post('vector_area'),
                    'vector_file'       => $this->input->post('vector_file'),
                    'vector_print'      => $this->input->post('vector_print'),
                    'vector_frame'      => $this->input->post('vector_frame'),
                    'vector_image'      => $upload_data['uploads']['file_name'],
                    'vector_desc'       => $this->input->post('vector_desc'),
                    'vector_keywords'   => $this->input->post('vector_keywords'),
                    'date_created'      => time()
                ];
                $this->vector_model->create($data);
                $this->session->set_flashdata('message', 'Data Produk telah ditambahkan');
                redirect(base_url('admin/vector'), 'refresh');
            }
        }
        //End Masuk Database
        $data = [
            'title'             => 'Buat Produk Vector',
            'content'           => 'admin/vector/create_vector'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }


    //Edit Vector
    public function Update($id)
    {
        $vector = $this->vector_model->detail_vector($id);
        //Validasi
        $valid = $this->form_validation;

        $valid->set_rules(
            'vector_name',
            'Nama Produk',
            'required',
            ['required'      => '%s harus diisi']
        );

        if ($valid->run()) {
            //Kalau nggak Ganti gambar
            if (!empty($_FILES['vector_image']['name'])) {

                $config['upload_path']          = './assets/img/product/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg|svg';
                $config['max_size']             = 5000; //Dalam Kilobyte
                $config['max_width']            = 5000; //Lebar (pixel)
                $config['max_height']           = 5000; //tinggi (pixel)
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('vector_image')) {

                    //End Validasi
                    $data = [
                        'title'        => 'Edit Produk Vector',
                        'berita'       => $vector,
                        'error_upload' => $this->upload->display_errors(),
                        'content'          => 'admin/vector/update_vector'
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
                    if ($vector->vector_image != "") {
                        unlink('./assets/img/product/' . $vector->vector_image);
                        // unlink('./assets/img/artikel/thumbs/' . $berita->berita_gambar);
                    }
                    //End Hapus Gambar

                    $data  = [
                        'id'                => $id,
                        'user_id'           => $this->session->userdata('id'),
                        'vector_name'       => $this->input->post('vector_name'),
                        'vector_price'      => $this->input->post('vector_price'),
                        'vector_discount'   => $this->input->post('vector_discount'),
                        'vector_area'       => $this->input->post('vector_area'),
                        'vector_file'       => $this->input->post('vector_file'),
                        'vector_print'      => $this->input->post('vector_print'),
                        'vector_frame'      => $this->input->post('vector_frame'),
                        'vector_image'      => $upload_data['uploads']['file_name'],
                        'vector_desc'       => $this->input->post('vector_desc'),
                        'vector_keywords'   => $this->input->post('vector_keywords'),
                        'date_updated'      => time()
                    ];
                    $this->vector_model->update($data);
                    $this->session->set_flashdata('message', 'Data telah di Update');
                    redirect(base_url('admin/vector'), 'refresh');
                }
            } else {
                //Update Berita Tanpa Ganti Gambar
                // Hapus Gambar Lama Jika ada upload gambar baru
                if ($vector->vector_image != "")
                    $data  = [
                        'id'         => $id,
                        'user_id'           => $this->session->userdata('id'),
                        'vector_name'       => $this->input->post('vector_name'),
                        'vector_price'      => $this->input->post('vector_price'),
                        'vector_discount'   => $this->input->post('vector_discount'),
                        'vector_area'       => $this->input->post('vector_area'),
                        'vector_file'       => $this->input->post('vector_file'),
                        'vector_print'      => $this->input->post('vector_print'),
                        'vector_frame'      => $this->input->post('vector_frame'),
                        'vector_desc'       => $this->input->post('vector_desc'),
                        'vector_keywords'   => $this->input->post('vector_keywords'),
                        'date_updated'      => time()
                    ];
                $this->vector_model->update($data);
                $this->session->set_flashdata('message', 'Data telah di Update');
                redirect(base_url('admin/vector'), 'refresh');
            }
        }
        //End Masuk Database
        $data = [
            'title'             => 'Update Produk Vector',
            'vector'            => $vector,
            'content'           => 'admin/vector/update_vector'
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
