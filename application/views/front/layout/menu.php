<?php
$id             = $this->session->userdata('id');
$user           = $this->user_model->user_detail($id);
$meta           = $this->meta_model->get_meta();

?>

<nav id="navbar" class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
<div class="container">
  <a class="navbar-brand" href="<?php echo base_url();?>"><object id="svg1" data="<?php echo base_url('assets/img/logo/' . $meta->logo) ?>" type="image/svg+xml"></object></a>
  <button class="navbar-toggler" type="button" data-trigger="#main_nav">
    <span class="navbar-toggler-icon"><i class="ri-menu-3-line"></i></span>
  </button>
  <div class="navbar-collapse" id="main_nav">

<div class="offcanvas-header mt-3">
	<button class="btn bg-white btn-close float-right"> <i class="ri-close-line"></i> </button>
	<h5 class="py-2 text-grey"><a class="navbar-brand" href="<?php echo base_url();?>"><object id="svg1" data="<?php echo base_url('assets/img/logo/' . $meta->logo) ?>" type="image/svg+xml"></object></a></h5>
</div>

<ul class="navbar-nav">
	<li class="nav-item active"> <a class="nav-link" href="<?php echo base_url();?>">Home </a> </li>
	<li class="nav-item"><a class="nav-link" href="#"> Tentang </a></li>
	<li class="nav-item"><a class="nav-link" href="#"> Layanan </a></li>
  <li class="nav-item"><a class="nav-link" href="#"> Portfolio </a></li>
  <li class="nav-item"><a class="nav-link" href="<?php echo base_url('blog');?>"> Blog </a></li>
</ul>

<ul class="navbar-nav ml-auto">

  <?php if ($this->session->userdata('email')) { ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ti-user"></i> <?php echo $user->user_name; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo base_url('myaccount') ?>">My Account</a>

                            <a class="dropdown-item" href="<?php echo base_url('myaccount/ubah_password'); ?>">Setings</a>
                            <div class="dropdown-divider"></div>
                            <?php if ($user->role_id == 1) : ?>
                                <a class="dropdown-item" href="<?php echo base_url('admin/dashboard'); ?>">Panel Admin</a>
                            <?php endif; ?>
                            <a class="dropdown-item" href="<?php echo base_url('auth/logout'); ?>">Logout</a>
                        </div>
                    </li>
                <?php } else { ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('auth/register') ?>"><i class="ti ti-user"></i> Register</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('auth') ?>"><i class="ti ti-lock"></i> Login</a></li>
                <?php } ?>
</ul>
  </div> <!-- navbar-collapse.// -->
  </div>
</nav>




<main id="main">
