<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Myaccount extends CI_Controller
{

    //Load Model
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('meta_model');
    }

    //main page - Berita
    public function index()
    {
        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);

        $meta = $this->meta_model->get_meta();

        // End Listing Berita dengan paginasi
        $data = array(
            'title'       => 'Akun Saya',
            'deskripsi'   => 'Berita - ' . $meta->description,
            'keywords'    => 'Berita - ' . $meta->keywords,
            'user'        => $user,
            'meta'        => $meta,
            'content'     => 'front/myaccount/index_account'
        );
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }



    public function update()
    {
        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        $meta = $this->meta_model->get_meta();

        $this->form_validation->set_rules(
            'user_name',
            'Nama',
            'required',
            [
                'required'         => 'Nama harus di isi'
            ]
        );
        if ($this->form_validation->run()) {
            //Kalau nggak Ganti gambar
            if (!empty($_FILES['user_image']['name'])) {

                $config['upload_path']          = './assets/img/avatars/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 5000; //Dalam Kilobyte
                $config['max_width']            = 5000; //Lebar (pixel)
                $config['max_height']           = 5000; //tinggi (pixel)
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('user_image')) {

                    //End Validasi
                    $data = [
                        'title'                 => 'Ubah Profile',
                        'deskripsi'             => 'Update Akun Saya',
                        'keywords'              => 'update Account',
                        'meta'                  => $meta,
                        'error_upload'          => $this->upload->display_errors(),
                        'content'               => 'front/myaccount/update_account'
                    ];
                    $this->load->view('front/layout/wrapp', $data, FALSE);

                    //Masuk Database

                } else {

                    //Proses Manipulasi Gambar
                    $upload_data    = array('uploads'  => $this->upload->data());
                    //Gambar Asli disimpan di folder assets/upload/image
                    //lalu gambar Asli di copy untuk versi mini size ke folder assets/upload/image/thumbs

                    $config['image_library']    = 'gd2';
                    $config['source_image']     = './assets/img/avatars/' . $upload_data['uploads']['file_name'];
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
                    if ($user->user_image != "") {
                        unlink('./assets/img/avatars/' . $user->user_image);
                        // unlink('./assets/img/artikel/thumbs/' . $berita->berita_gambar);
                    }
                    //End Hapus Gambar

                    $data  = [
                        'id'                    => $id,
                        'user_name'             => $this->input->post('user_name'),
                        'email'                 => $this->input->post('email'),
                        'user_image'            => $upload_data['uploads']['file_name'],
                        'user_phone'            => $this->input->post('user_phone'),
                        'user_address'          => $this->input->post('user_address'),
                        'date_updated'          => time()
                    ];
                    $this->user_model->update($data);
                    $this->session->set_flashdata('message', 'Data telah di Update');
                    redirect(base_url('myaccount'), 'refresh');
                }
            } else {
                //Update Berita Tanpa Ganti Gambar
                // Hapus Gambar Lama Jika ada upload gambar baru
                if ($user->user_image != "")
                    $data  = [
                        'id'                    => $id,
                        'user_name'             => $this->input->post('user_name'),
                        'email'                 => $this->input->post('email'),
                        'user_phone'            => $this->input->post('user_phone'),
                        'user_address'          => $this->input->post('user_address'),
                        'date_updated'          => time()
                    ];
                $this->user_model->update($data);
                $this->session->set_flashdata('message', 'Data telah di Update');
                redirect(base_url('myaccount'), 'refresh');
            }
        }

        $data = [
            'title'                 => 'Ubah Profile',
            'deskripsi'             => 'Update Akun Saya',
                        'keywords'              => 'update Account',
            'meta'                  => $meta,
            'user'                  => $user,
            'content'               => 'front/myaccount/update_account'
        ];
        $this->load->view('front/layout/wrapp', $data, FALSE);
    }





    public function ubah_password()
    {
        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        $meta = $this->meta_model->get_meta();

        $this->form_validation->set_rules(
            'password1',
            'Password',
            'required|trim|min_length[3]|matches[password2]',
            [
                'required'      => 'Password harus Di isi',
                'matches'         => 'Password tidak sama',
                'min_length'     => 'Password Min 3 karakter'
            ]
        );
        $this->form_validation->set_rules('password2', 'Ulangi Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            // End Listing Berita dengan paginasi
            $data = array(
                'title'       => 'Ubah Password',
                'deskripsi'             => 'Update Password Saya',
                        'keywords'              => 'update Password',
                'user'        => $user,
                'meta'        => $meta,
                'content'     => 'front/myaccount/password_account'
            );
            $this->load->view('front/layout/wrapp', $data, FALSE);
        } else {
            $data = [
                'id'            => $id,
                'password'        => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            ];
            $this->user_model->update($data);
            $this->session->set_flashdata('message', 'Data telah di ubah');
            redirect(base_url('myaccount'), 'refresh');
        }
    }


}

/* End of file Myaccount.php */
/* Location: ./application/controllers/Myaccount.php */
