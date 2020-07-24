<!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2><?php echo $title ?></h2>
        <ol>
          <li><a href="<?php echo base_url('') ?>"><i class="ti ti-home"></i> Home</a></li>
          <li><?php echo $title ?></li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs Section -->

  <section class="inner-page blog">
    <div class="container">
      <div class="row">
      <div class="col-md-8">

<div class="row">

  <?php foreach ($download as $download) : ?>

        <div class="col-md-6">
          <div class="card">
            <img src="<?php echo base_url('assets/img/download/' . $download->download_image); ?>" class="card-img-top" alt="<?php echo $download->download_title; ?>">
            <div class="card-body">
              <h2 class="index-title"><a href="<?php echo base_url('download/detail/' . $download->download_slug); ?> "> <?php echo substr($download->download_title, 0, 25); ?></a></h2>
              <p><?php echo substr($download->download_desc, 0, 100); ?></p>

            </div>
            <div class="card-footer">
            <i class="ri-price-tag-3-line"></i> <a href="<?php echo base_url('download/category/'.$download->category_slug);?>"><?php echo $download->category_name; ?></a>
            </div>
          </div>
        </div>

<?php endforeach;?>

      </div>
      <div class="pagination col-md-12 text-center">
          <?php if (isset($pagination)) {
              echo $pagination;
          } ?>
      </div>
    </div>


      <div class="col-md-4">
        <?php include "download_sidebar.php";?>
            </div><!-- End sidebar -->
      </div>
    </div>

    </div>
  </section>
