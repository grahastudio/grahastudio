<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');

        $id = $this->session->userdata('id');
        $user = $this->user_model->user_detail($id);
        if ($user->role_id == 2) {
            redirect('admin/home');
        }
    }
    public function index()
    {

        $list_user = $this->user_model->user_member();
        $data = [
            'title'                 => 'Data User',
            'list_user'             => $list_user,
            'content'               => 'admin/user/index_user'

        ];
        $this->load->view('admin/layout/wrapp', $data, FALSE);
    }
    //Create User
    public function create()
  	{
  		$this->form_validation->set_rules(
  			'user_name',
  			'Nama',
  			'required|trim',
  			['required' => 'nama harus di isi']
  		);
  		$this->form_validation->set_rules(
  			'email',
  			'Email',
  			'required|trim|valid_email|is_unique[user.email]',
  			[
  				'required' 		=> 'Email Harus diisi',
  				'valid_email' 	=> 'Email Harus Valid',
  				'is_unique'		=> 'Email Sudah ada, Gunakan Email lain'
  			]
  		);
  		$this->form_validation->set_rules(
  			'password1',
  			'Password',
  			'required|trim|min_length[3]|matches[password2]',
  			[
  				'matches' 		=> 'Password tidak sama',
  				'min_length' 	=> 'Password Min 3 karakter'
  			]
  		);
  		$this->form_validation->set_rules('password2', 'Ulangi Password', 'required|trim|matches[password1]');

  		if ($this->form_validation->run() == false) {
  			$data = [
  				'title'			=> 'Create User',
  				'content'       => 'admin/user/create_user'
  			];
  			$this->load->view('admin/layout/wrapp', $data, FALSE);
  		} else {
  			$email = $this->input->post('email', true);
  			$data = [
  				'user_title'	=> $this->input->post('user_title'),
  				'user_name' 	=> htmlspecialchars($this->input->post('user_name', true)),
  				'email' 		=> htmlspecialchars($email),
  				'user_image' 	=> 'default.jpg',
  				'user_phone'	=> $this->input->post('user_phone'),
  				'password'		=> password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
  				'role_id'		=> 2,
  				'is_active'		=> 0,
  				'date_created'	=> time()
  			];
  			$this->db->insert('user', $data);


  			$this->session->set_flashdata('message', '<div class="alert alert-success">Selamat Anda berhasil mendaftar, silahkan Aktivasi akun</div> ');
  			redirect('admin/user');
  		}
  	}

    //Banned User
  public function banned($id)
  {
    //Proteksi delete
    is_login();
    $data = [
      'id'                    => $id,
      'is_active'             => 0,
    ];
    $this->user_model->update($data);
    $this->session->set_flashdata('message', 'User Telah di banned');
    redirect($_SERVER['HTTP_REFERER']);
  }
  public function activated($id)
  {
    //Proteksi delete
    is_login();
    $data = [
      'id'                    => $id,
      'is_active'             => 1,
    ];
    $this->user_model->update($data);
    $this->session->set_flashdata('message', 'User Telah di Aktifkan');
    redirect($_SERVER['HTTP_REFERER']);
  }

}
