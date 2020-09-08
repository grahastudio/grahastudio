<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Website extends CI_Controller
{

  //Load Model
  public function __construct()
  {
    parent::__construct();
    $this->load->model('user_model');
    $this->load->model('transaksi_model');
    $this->load->model('meta_model');
    $this->load->model('website_model');
    $this->load->model('bank_model');
    $this->load->library('pagination');
  }

  //main page - Berita
  public function index()
  {
    $meta                 = $this->meta_model->get_meta();
    $website             = $this->website_model->get_allwebsite();

    // End Listing Berita dengan paginasi
    $data = array(
      'title'                 => 'Product - Web Application ',
      'deskripsi'             => 'Product - Jasa pembuatan Website murah dan berkualitas',
      'keywords'              => 'Produk - Jasa pembuatan Website, jasa pembuatan web system, jasa Web Developer, jasa Web company profile',
      'website'                => $website,
      'content'               => 'front/website/index_website'
    );
    $this->load->view('front/layout/wrapp', $data, FALSE);
  }
  public function order($website_slug = NULL)
  {
    if (!empty($website_slug)) {
      $website_slug;
    } else {
      redirect(base_url('website'));
    }
    $meta               = $this->meta_model->get_meta();
    $website             = $this->website_model->read($website_slug);

    // Validasi
    $this->form_validation->set_rules(
      'user_name',
      'Nama Lengkap',
      'required',
      [
        'required'      => 'Nama Lengkap harus di isi',
      ]
    );

    if ($this->form_validation->run() === FALSE) {

        //End Validasi
        $data = [
          'title'                 => 'Order Website ' .$website->website_name,
          'deskripsi'             => 'Website - ' .$website->website_desc,
          'keywords'              => 'Website - ' .$website->website_keywords,
          'website'                => $website,
          'content'               => 'front/website/order_website'
        ];
        $this->load->view('front/layout/wrapp', $data, FALSE);

        //Masuk Database

      } else {


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

          'date_created'      => time()
        ];
        $insert_id = $this->transaksi_model->create($data);

        //Kirim Email
  			// $this->_sendEmail($insert_id, 'order');

        $this->session->set_flashdata('message', 'Data Berita telah ditambahkan');
        redirect(base_url('website/success/'.$insert_id), 'refresh');


    }
    //End Masuk Database
    $data = [
      'title'                 => 'Order Website ' .$website->website_name,
      'deskripsi'             => 'Website - ' .$website->website_desc,
      'keywords'              => 'Website - ' .$website->website_keywords,
      'website'                => $website,
      'content'               => 'front/website/order_website'
    ];
    $this->load->view('front/layout/wrapp', $data, FALSE);
  }

  // private function _sendEmail($type, $insert_id)
  // {
  //   $last_transaksi     = $this->transaksi_model->last_transaksi($insert_id);
  //   $bank               = $this->bank_model->get_allbank();
  //   $meta               = $this->meta_model->get_meta();
  //
  //   $config = [
  //
  //     'protocol' 		=> 'smtp',
  //     'smtp_host' 	=> 'ssl://mail.site.com',
  //     'smtp_port' 	=> 465,
  //     'smtp_user' 	=> 'mail@site.com',
  //     'smtp_pass' 	=> 'password',
  //     'mailtype' 		=> 'html',
  //     'charset' 		=> 'utf-8',
  //
  //   ];
  //
  //   $this->load->library('email', $config);
  //   $this->email->initialize($config);
  //
  //   $this->email->set_newline("\r\n");
  //
  //   $this->email->from('mail@site.com', 'Testing');
  //   $this->email->to($this->input->post('email'));
  //
  //   if ($type == 'order') {
  //     $this->email->subject('Order Website');
  //     $this->email->message('
  //
  //
  //
  //
  //
  //     <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  //     <html xmlns="http://www.w3.org/1999/xhtml">
  //     <head>
  //       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  //       <meta name="viewport" content="width=device-width, initial-scale=1" />
  //       <title>Neopolitan Invoice Email</title>
  //
  //
  //       <style type="text/css">
  //       @import url(http://fonts.googleapis.com/css?family=Droid+Sans);
  //
  //
  //       img {
  //         max-width: 600px;
  //         outline: none;
  //         text-decoration: none;
  //         -ms-interpolation-mode: bicubic;
  //       }
  //
  //       a {
  //         text-decoration: none;
  //         border: 0;
  //         outline: none;
  //         color: #bbbbbb;
  //       }
  //
  //       a img {
  //         border: none;
  //       }
  //
  //
  //
  //       td, h1, h2, h3  {
  //         font-family: Helvetica, Arial, sans-serif;
  //         font-weight: 400;
  //       }
  //
  //       td {
  //         text-align: center;
  //       }
  //
  //       body {
  //         -webkit-font-smoothing:antialiased;
  //         -webkit-text-size-adjust:none;
  //         width: 100%;
  //         height: 100%;
  //         color: #37302d;
  //         background: #ffffff;
  //         font-size: 16px;
  //       }
  //
  //        table {
  //         border-collapse: collapse !important;
  //       }
  //
  //       .headline {
  //         color: #ffffff;
  //         font-size: 36px;
  //       }
  //
  //      .force-full-width {
  //       width: 100% !important;
  //      }
  //
  //      .force-width-80 {
  //       width: 80% !important;
  //      }
  //
  //
  //
  //
  //       </style>
  //
  //       <style type="text/css" media="screen">
  //           @media screen {
  //             td, h1, h2, h3 {
  //               font-family: 'Droid Sans', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
  //             }
  //           }
  //       </style>
  //
  //       <style type="text/css" media="only screen and (max-width: 480px)">
  //         @media only screen and (max-width: 480px) {
  //
  //           table[class="w320"] {
  //             width: 320px !important;
  //           }
  //
  //           td[class="mobile-block"] {
  //             width: 100% !important;
  //             display: block !important;
  //           }
  //
  //
  //         }
  //       </style>
  //     </head>
  //     <body class="body" style="padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none" bgcolor="#ffffff">
  //     <table align="center" cellpadding="0" cellspacing="0" class="force-full-width" height="100%" >
  //       <tr>
  //         <td align="center" valign="top" bgcolor="#ffffff"  width="100%">
  //           <center>
  //             <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="600" class="w320">
  //               <tr>
  //                 <td align="center" valign="top">
  //
  //
  //
  //                     <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" class="force-full-width" bgcolor="#2c3e50">
  //                       <tr>
  //                         <td style="color:#ffffff;">
  //                         <br>
  //                           '.$meta->title.'
  //                         </td>
  //                       </tr>
  //                       <tr>
  //                         <td class="headline">
  //                           Faktur Anda siap!
  //                         </td>
  //                       </tr>
  //                       <tr>
  //                         <td>
  //
  //                           <center>
  //                             <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" width="60%">
  //                               <tr>
  //                                 <td style="color:#ffffff;">
  //                                 <br>
  //                                  Untuk Melihat semua transaksi, silahkan masuk ke halaman akun anda
  //                                 <br>
  //                                 <br>
  //                                 </td>
  //                               </tr>
  //                             </table>
  //                           </center>
  //
  //                         </td>
  //                       </tr>
  //                       <tr>
  //                         <td>
  //                           <div>
  //                                 <a href="'.base_url('myaccount');.'"
  //                           style="background-color:#178f8f;border-radius:4px;color:#ffffff;display:inline-block;font-family:Helvetica, Arial, sans-serif;font-size:16px;font-weight:bold;line-height:50px;text-align:center;text-decoration:none;width:200px;-webkit-text-size-adjust:none;">My Account</a>
  //                             </div>
  //                           <br>
  //                           <br>
  //                         </td>
  //                       </tr>
  //                     </table>
  //
  //                     <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" class="force-full-width" bgcolor="#f5774e">
  //                       <tr>
  //                         <td style="background-color:#34495e;">
  //
  //                         <center>
  //                           <table style="margin:0 auto;" cellspacing="0" cellpadding="0" class="force-width-80">
  //                             <tr>
  //                               <td style="text-align:left; color:#ffffff">
  //                               <br>
  //                               <br>
  //                                 <span style="color:#ffffff;">'.$this->input->post('user_name').'</span> <br>
  //                                 '.$this->input->post('user_address').' <br>
  //
  //                                 '.$this->input->post('user_phone').'
  //                               </td>
  //                               <td style="text-align:right; vertical-align:top; color:#ffffff">
  //                               <br>
  //                               <br>
  //                                 <span style="color:#ffffff;">Kode Transaksi: '.echo $last_transaksi->transaction_code.'</span> <br>
  //                                 Tanggal : '.echo date('d F Y', $last_transaksi->date_created).'
  //                               </td>
  //                             </tr>
  //                           </table>
  //
  //
  //                           <table style="margin:0 auto;" cellspacing="0" cellpadding="0" class="force-width-80">
  //                             <tr>
  //                               <td  class="mobile-block" >
  //                               <br>
  //                               <br>
  //
  //                                 <table cellspacing="0" cellpadding="0" class="force-full-width">
  //                                   <tr>
  //                                     <td style="color:#ffffff; background-color:#2c3e50; padding: 10px 0px;">
  //                                       Produk
  //                                     </td>
  //                                   </tr>
  //                                   <tr>
  //                                     <td style="color:#2c3e50; padding:10px 0px; background-color: #ecf0f1;">
  //                                       '.$this->input->post('product').'
  //                                     </td>
  //                                   </tr>
  //                                 </table>
  //                               </td>
  //                               <td  class="mobile-block">
  //                               <br>
  //                               <br>
  //
  //
  //                               </td>
  //                               <td class="mobile-block">
  //                               <br>
  //                               <br>
  //
  //                                 <table cellspacing="0" cellpadding="0" class="force-full-width">
  //                                   <tr>
  //                                     <td style="color:#ffffff; background-color:#2c3e50; padding: 10px 0px;">
  //                                       Amount
  //                                     </td>
  //                                   </tr>
  //                                   <tr>
  //                                     <td style="color:#2c3e50; padding:10px 0px; background-color: #ecf0f1;">
  //                                       Rp. '.$this->input->post('price').'
  //                                     </td>
  //                                   </tr>
  //                                 </table>
  //                               </td>
  //                             </tr>
  //                           </table>
  //
  //
  //                           <table  style="margin: 0 auto;" cellspacing="0" cellpadding="0" class="force-width-80">
  //                             <tr>
  //                               <td style="color:#ffffff; text-align:left; border-bottom:1px solid #ffffff;">
  //                               <br>
  //                               <br>
  //                                 Silahkan Transfer Pembayaran Anda melalui rekening yang ada di halaman Web
  //
  //                                 <br>
  //                                 <br>
  //                               </td>
  //                             </tr>
  //                           </table>
  //
  //
  //
  //
  //
  //                           <table style="margin: 0 auto;" cellspacing="0" cellpadding="0" class="force-width-80">
  //                             <tr>
  //                               <td style="text-align:left; color:#ffffff;">
  //                               <br>
  //                                 Terima kasih untuk bisnis anda Silakan hubungi kami dengan pertanyaan apa pun mengenai faktur ini..
  //                               <br>
  //                               <br>
  //                               Awesome Inc
  //                               <br>
  //                               <br>
  //                               <br>
  //                               </td>
  //                             </tr>
  //                           </table>
  //                         </center>
  //
  //
  //
  //                         </td>
  //                       </tr>
  //
  //
  //                     </table>
  //
  //                     <table style="margin: 0 auto;" cellpadding="0" cellspacing="0" class="force-full-width" bgcolor="#414141" style="margin: 0 auto">
  //                       <tr>
  //                         <td style="background-color:#2c3e50;">
  //                         <br>
  //                         <br>
  //                           <span style="color:#ffffff;">Untuk Informasi silahkan Hubungi '.echo $meta->telepon.'</span>
  //                           <br>
  //                           <br>
  //                         </td>
  //                       </tr>
  //
  //                     </table>
  //
  //                 </td>
  //               </tr>
  //             </table>
  //         </center>
  //         </td>
  //       </tr>
  //     </table>
  //     </body>
  //     </html>
  //
  //
  //
  //
  //
  //
  //
  //
  //     ');
  //   }
  //
  //   if ($this->email->send()) {
  //     return true;
  //   } else {
  //     echo $this->email->print_debugger();
  //     die;
  //   }
  // }

  public function success($insert_id = NULL)
  {
    if (!empty($insert_id)) {
      $insert_id;
    } else {
      redirect(base_url('website'));
    }
    $bank               = $this->bank_model->get_allbank();
    $meta               = $this->meta_model->get_meta();
    $last_transaksi     = $this->transaksi_model->last_transaksi($insert_id);
    // End Listing Berita dengan paginasi
    $data = array(
      'title'                 => 'Product - website graphic ',
      'deskripsi'             => 'Product - Jasa pembuatan Foto website murah dan berkualitas',
      'keywords'              => 'Produk - Jasa pembuatan desain website, jasa pembuatan sketsa, jasa foto website, jasa foto kartun',
      'last_transaksi'        => $last_transaksi,
      'meta'                  => $meta,
      'bank'                  => $bank,
      'content'               => 'front/website/order_success'
    );
    $this->load->view('front/layout/wrapp', $data, FALSE);
  }
}


/* End of file Website.php */
/* Location: ./application/controllers/Website.php */
