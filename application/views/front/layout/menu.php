<?php
$id             = $this->session->userdata('id');
$user           = $this->user_model->user_detail($id);
$meta           = $this->meta_model->get_meta();

?>

<!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <div class="logo mr-auto">
        <!-- <h1 class="text-light"><a href="index.html"><span>Vesperr</span></a></h1> -->
        <!-- Uncomment below if you prefer to use an image logo -->
        <a href="<?php echo base_url();?>"><img class="img-fluid" src="<?php echo base_url('assets/img/logo/' . $meta->logo) ?>"></a>
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="<?php echo base_url();?>">Home</a></li>
          <li><a href="<?php echo base_url('about');?>">Tentang</a></li>
          <li><a href="#services">Layanan</a></li>
          <li><a href="#portfolio">Portfolio</a></li>

          <li><a href="<?php echo base_url('berita');?>">Blog</a></li>
          <li class="drop-down"><a href="">Account</a>
            <ul>
              <li><a href="<?php echo base_url('auth');?>">Login</a></li>
              <li><a href="<?php echo base_url('auth/register');?>">Register</a></li>
            </ul>
          </li>
          <li class="get-started"><a href="#about">Minta Penawaran</a></li>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->
<main id="main">
