<!--  Breadcrumbs Section -->
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


  <!-- ======= Hero Section ======= -->
  <section>

    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <h1>Jasa pembuatan Aplikasi Website</h1>
          <p style="line-height:30px;">Di era digital seperti saat ini, website merupakan suatu bagian penting bagi
          Perusahaan atau pebisnis seperti anda, dengan adanya website akanlebih mudah untuk anda memasarkan produk.
        bisnis anda semakin profesional dengan adanya website dan orang semakin tertarik dengan apa yang anda tawarkan</p>

          <!-- <p style="line-height:30px;">Gimana apa kalian tertarik untuk merubah foto kalian menjadi lebih unik? BTW aku order gambar seperti ini untuk apa? Nah, Untuk keperluan sendiri ada banyak
          bray kamu bisa gunakan ini untuk pajang di sosial media, buat di cetak untuk sendiri, atau di cetak buat kado temen kalian yang ulang tahun
          atau nikah. Atau buat pre wedding biar fotonya nggak monoton.</p> -->

          <p style="line-height:30px;">
            Buat website dengan nama domain anda sekarang, sebelum orang lain menggunakannya..
        </p>

        </div>
        <div class="col-lg-5">
          <img src="<?php echo base_url('assets/img/galery/website.svg');?>" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->


  <!-- ======= Features Section ======= -->
<section id="layanan" class="features">
<div class="container">

<div class="section-title" data-aos="fade-up">
<h2>Layanan</h2>
<p>Kami Melayani jasa Material promosi Digital dengan media online dan media cetak</p>
</div>

<div class="row" data-aos="fade-up" data-aos-delay="300">

<?php foreach ($website as $website) :?>

<div class="col-md-4">
<div class="icon-box">
  <div class="row">
    <div class="col-3">
  <img class="img-fluid" src="<?php echo base_url('assets/img/product/'.$website->website_image );?>">
</div>
<div class="col-9">
  <h3><a href="<?php echo base_url('website/order/'.$website->website_slug);?>"><?php echo $website->website_name;?></a></h3>
  <?php echo $website->website_price;?>
</div>
</div>
</div>
</div>

<?php endforeach;?>



</div>

</div>
</section><!-- End Features Section -->
