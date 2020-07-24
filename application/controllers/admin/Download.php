<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Download extends CI_Controller
{
    //load data
    public function __construct()
    {
        parent::__construct();
        $this->load->model('portfolio_model');
        $this->load->model('download_model');
        $this->load->model('category_model');
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
        $config['base_url']       = base_url('admin/download/index/');
        $config['total_rows']     = count($this->download_model->total_row());
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


        $download = $this->download_model->get_download($limit, $start);
        $data = [
            'title'         => 'Data Download',
            'download'        => $download,
            'pagination'    => $this->pagination->create_links(),
            'content'       => 'admin/download/index_download'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    //Create New Portfolio
    public function create()
    {
        $category            = $this->category_model->get_category_download();
        $this->form_validation->set_rules(
            'download_title',
            'Nama File Download',
            'required',
            [
                'required'      => 'Nama Produk harus di isi',
            ]
        );
        if ($this->form_validation->run()) {

            $config['upload_path']          = './assets/img/download/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|svg';
            $config['max_size']             = 5000; //Dalam Kilobyte
            $config['max_width']            = 5000; //Lebar (pixel)
            $config['max_height']           = 5000; //tinggi (pixel)
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('download_image')) {

                //End Validasi
                $data = [
                    'title'             => 'Tambah File Download',
                    'category'          => $category,
                    'error_upload'      => $this->upload->display_errors(),
                    'content'           => 'admin/download/create_download'
                ];
                $this->load->view('admin/layout/wrapp', $data, FALSE);

                //Masuk Database

            } else {

                //Proses Manipulasi Gambar
                $upload_data    = array('uploads'  => $this->upload->data());
                //Gambar Asli disimpan di folder assets/upload/image
                //lalu gambara Asli di copy untuk versi mini size ke folder assets/upload/image/thumbs

                $config['image_library']    = 'gd2';
                $config['source_image']     = './assets/img/download/' . $upload_data['uploads']['file_name'];
                //Gambar Versi Kecil dipindahkan
                // $config['new_image']        = './assets/img/artikel/thumbs/' . $upload_data['uploads']['file_name'];
                $config['create_thumb']     = TRUE;
                $config['maintain_ratio']   = TRUE;
                $config['width']            = 5000;
                $config['height']           = 5000;
                $config['thumb_marker']     = '';

                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $slugcode                     = random_string('numeric', 5);
                $download_slug                = url_title($this->input->post('download_title'), 'dash', TRUE);
                $data  = [
                    'user_id'                 => $this->session->userdata('id'),
                    'download_slug'           => $slugcode . '-' .$download_slug,
                    'category_id'             => $this->input->post('category_id'),
                    'download_title'          => $this->input->post('download_title'),
                    'download_price'          => $this->input->post('download_price'),
                    'download_desc'           => $this->input->post('download_desc'),
                    'download_url'            => $this->input->post('download_url'),
                    'download_keywords'       => $this->input->post('download_keywords'),
                    'download_image'          => $upload_data['uploads']['file_name'],
                    'date_created'            => time()
                ];
                $this->download_model->create($data);
                $this->session->set_flashdata('message', 'Data Download telah ditambahkan');
                redirect(base_url('admin/download'), 'refresh');
            }
        }
        //End Masuk Database
        $data = [
            'title'             => 'Buat File Download',
            'category'          => $category,
            'content'           => 'admin/download/create_download'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }


    //Edit Download
    public function Update($id)
    {
        $category            = $this->category_model->get_category_download();
        $download = $this->download_model->detail_download($id);
        //Validasi
        $valid = $this->form_validation;

        $valid->set_rules(
            'download_title',
            'Nama File Download',
            'required',
            ['required'      => '%s harus diisi']
        );

        if ($valid->run()) {
            //Kalau nggak Ganti gambar
            if (!empty($_FILES['download_image']['name'])) {

                $config['upload_path']          = './assets/img/download/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg|svg';
                $config['max_size']             = 5000; //Dalam Kilobyte
                $config['max_width']            = 5000; //Lebar (pixel)
                $config['max_height']           = 5000; //tinggi (pixel)
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('download_image')) {

                    //End Validasi
                    $data = [
                        'title'               => 'Edit File Download',
                        'download'            => $download,
                        'category'            => $category,
                        'error_upload'        => $this->upload->display_errors(),
                        'content'             => 'admin/download/update_download'
                    ];
                    $this->load->view('admin/layout/wrapp', $data, FALSE);

                    //Masuk Database

                } else {

                    //Proses Manipulasi Gambar
                    $upload_data    = array('uploads'  => $this->upload->data());
                    //Gambar Asli disimpan di folder assets/upload/image
                    //lalu gambar Asli di copy untuk versi mini size ke folder assets/upload/image/thumbs

                    $config['image_library']    = 'gd2';
                    $config['source_image']     = './assets/img/download/' . $upload_data['uploads']['file_name'];
                    //Gambar Versi Kecil dipindahkan
                    // $config['new_image']        = './assets/img/artikel/thumbs/' . $upload_data['uploads']['file_name'];
                    $config['create_thumb']     = TRUE;
                    $config['maintain_ratio']   = TRUE;
                    $config['width']            = 5000;
                    $config['height']           = 5000;
                    $config['thumb_marker']     = '';

                    $this->load->library('image_lib', $config);

                    $this->image_lib->resize();

                    // Hapus Gambar Lama Jika Ada upload gambar baru
                    if ($download->download_image != "") {
                        unlink('./assets/img/download/' . $download->download_image);
                        // unlink('./assets/img/artikel/thumbs/' . $berita->berita_gambar);
                    }
                    //End Hapus Gambar

                    $data  = [
                        'id'                      => $id,
                        'user_id'                 => $this->session->userdata('id'),
                        // 'download_slug'           => $slugcode . '-' .$download_slug,
                        'download_title'          => $this->input->post('download_title'),
                        'category_id'             => $this->input->post('category_id'),
                        'download_price'          => $this->input->post('download_price'),
                        'download_desc'           => $this->input->post('download_desc'),
                        'download_url'            => $this->input->post('download_url'),
                        'download_keywords'       => $this->input->post('download_keywords'),
                        'download_image'          => $upload_data['uploads']['file_name'],
                        'date_updated'            => time()
                    ];
                    $this->download_model->update($data);
                    $this->session->set_flashdata('message', 'Data telah di Update');
                    redirect(base_url('admin/download'), 'refresh');
                }
            } else {
                //Update Berita Tanpa Ganti Gambar
                // Hapus Gambar Lama Jika ada upload gambar baru
                if ($download->download_image != "")
                    $data  = [
                        'id'                      => $id,
                        'user_id'                 => $this->session->userdata('id'),
                        // 'download_slug'           => $slugcode . '-' .$download_slug,
                        'download_title'          => $this->input->post('download_title'),
                        'category_id'             => $this->input->post('category_id'),
                        'download_price'          => $this->input->post('download_price'),
                        'download_desc'           => $this->input->post('download_desc'),
                        'download_url'            => $this->input->post('download_url'),
                        'download_keywords'       => $this->input->post('download_keywords'),
                        // 'download_image'          => $upload_data['uploads']['file_name'],
                        'date_updated'            => time()
                    ];
                $this->download_model->update($data);
                $this->session->set_flashdata('message', 'Data telah di Update');
                redirect(base_url('admin/download'), 'refresh');
            }
        }
        //End Masuk Database
        $data = [
            'title'                 => 'Update Produk Download',
            'download'              => $download,
            'category'              => $category,
            'content'               => 'admin/download/update_download'
        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }

    //delete
    public function delete($id)
    {
        //Proteksi delete
        is_login();

        $download = $this->download_model->download_detail($id);
        //Hapus gambar

        if ($download->download_gambar != "") {
            unlink('./assets/img/download/' . $download->download_gambar);
            // unlink('./assets/img/artikel/thumbs/' . $portfolio->portfolio_gambar);
        }
        //End Hapus Gambar
        $data = ['id'   => $download->id];
        $this->download_model->delete($data);
        $this->session->set_flashdata('message', 'Data telah di Hapus');
        redirect($_SERVER['HTTP_REFERER']);
    }




}
