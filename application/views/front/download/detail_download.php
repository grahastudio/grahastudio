<?php
$id             = $this->session->userdata('id');
$user           = $this->user_model->user_detail($id);
?>

<!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Download</h2>
        <ol>
          <li><a href="<?php echo base_url();?>">Home</a></li>
          <li><?php echo $title ?></li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs Section -->

  <section class="inner-page blog">
    <div class="container">
      <div class="row">
        <div class="col-md-8">

          <article class="entry entry-single card">

            <div class="entry-img">
              <img src="<?php echo base_url('assets/img/download/' . $download->download_image); ?>" alt="" class="img-fluid" width="100%;">
            </div>

            <h2 class="entry-title">
              <a href="download-single.html"><?php echo $download->download_title; ?></a>
            </h2>

            <div class="entry-meta">
              <ul>
                <li class="d-flex align-items-center"><i class="ri-user-3-line"></i> <?php echo $download->user_name; ?></li>
                <li class="d-flex align-items-center"><i class="ri-calendar-line"></i> <?php echo date('d F Y', $download->date_created);?></li>
                <li class="d-flex align-items-center"><i class="ri-eye-line"></i> <?php echo $download->download_views; ?> View</li>
              </ul>
            </div>

            <div class="entry-content">

<?php echo $download->download_desc; ?>




              <!-- Your share button code -->


            </div>

            <div class="entry-footer clearfix">
              <div class="float-left">
                <i class="ri-price-tag-3-line"></i>
                <ul class="cats">
                  <li><a href="<?php echo base_url('download/category/'.$download->category_slug);?>"><?php echo $download->category_name;?></a></li>
                </ul>

              </div>
              <div class="float-right share">
                <!-- AddToAny BEGIN -->
<div class="a2a_kit a2a_kit_size_32 a2a_default_style">
<a class="a2a_dd" href="https://www.addtoany.com/share"></a>
<a class="a2a_button_facebook"></a>
<a class="a2a_button_twitter"></a>
<a class="a2a_button_whatsapp"></a>
<a class="a2a_button_pinterest"></a>
<a class="a2a_button_line"></a>
</div>
<script async src="https://static.addtoany.com/menu/page.js"></script>
<!-- AddToAny END -->
              </div>

            </div>

          </article><!-- End download entry -->


        </div>
        <div class="col-md-4">



          <div class="card body-success">
            <div class="card-header order-success">
              <div class="row">
                <div class="col-md-2 text-center">
                  <h1 class="display-5"><i class="fas fa-download"></i></h1>
                </div>
                <div class="col-md-10 align-middle">
                  <h3><span class="align-middle">Download</span></h3>
                  <p style="font-size:13px;">Klik Tombol Download untuk mengunduh file</p>
                </div>
              </div>
            </div>
            <div class="card-body body-success">
              <div class="row">


                  <?php if ($this->session->userdata('id')) :?>
                  <?php $transaction_code = date('dmY') . strtoupper(random_string('alnum', 5));
                  echo form_open_multipart('download/detail/' .$download->download_slug);
                  ?>

                  <?php if ($download->download_price == 0) :?>

                        <a href="<?php echo $download->download_url;?>" class="btn btn-download btn-block">
                      DOWNLOAD</a>

                  
                  <?php else:?>
                    <input type="hidden" name="transaction_code" value="<?php echo $transaction_code ?>">
                    <input type="hidden" name="product" value="Download - <?php echo $download->download_title ?>">
                    <input type="hidden" name="user_id" value="<?php echo $user->id; ?>">
                    <input type="hidden" name="user_name" value="<?php echo $user->user_name; ?>">
                    <input type="hidden" name="email" value="<?php echo $user->email; ?>">
                    <input type="hidden" name="price" value="<?php echo $download->download_price; ?>">
                    <input type="hidden" name="payment_status" value="<?php if ($download->download_price == 0) :?>Lunas
                    <?php else:?>Belum<?php endif;?>">
                      <input type="hidden" name="order_status" value="<?php if ($download->download_price == 0) :?>Selesai
                      <?php else:?>Belum<?php endif;?>">

                    <button type="submit" value="Download" class="btn btn-download btn-block">DOWNLOAD</button>

                  <?php endif;?>

                  <?php echo form_close();?>

                              <?php else:?>
                                <a href="<?php echo base_url('auth');?>">
                                <button class="btn btn-download btn-block">DOWNLOAD</button></a>

                              <?php endif;?>


              </div>
            </div>
            <div class="card-footer order-success">
              <div class="form-row d-flex justify-content-between align-items-center ">
              <!-- Customer Support<br>
              <h5><i class="fab fa-whatsapp"></i> </h5> -->
            </div>
          </div>
          </div>





















        <?php include "download_sidebar.php";?>
        </div>
      </div>

    </div>
  </section>
