

<!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Blog</h2>
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
        <div class="col-md-9">

          <article class="entry entry-single card">

            <div class="entry-img">
              <img src="<?php echo base_url('assets/img/artikel/' . $berita->berita_gambar); ?>" alt="" class="img-fluid" width="100%;">
            </div>

            <h2 class="entry-title">
              <a href="blog-single.html"><?php echo $berita->berita_title; ?></a>
            </h2>

            <div class="entry-meta">
              <ul>
                <li class="d-flex align-items-center"><i class="ri-user-3-line"></i> <a href="blog-single.html"><?php echo $berita->user_name; ?></a></li>
                <li class="d-flex align-items-center"><i class="ri-calendar-line"></i> <a href="blog-single.html"><time datetime="2020-01-01">Jan 1, 2020</time></a></li>
                <li class="d-flex align-items-center"><i class="ri-eye-line"></i> <a href="blog-single.html"><?php echo $berita->berita_views; ?> View</a></li>
              </ul>
            </div>

            <div class="entry-content">
              <p>
<?php echo $berita->berita_desc; ?>
              </p>

            </div>

            <div class="entry-footer clearfix">
              <div class="float-left">
                <i class="ri-price-tag-3-line"></i>
                <ul class="cats">
                  <li><a href="#"><?php echo $berita->category_name;?></a></li>
                </ul>


              </div>

              <div class="float-right share">
                <a href="" title="Share on Twitter"><i class="icofont-twitter"></i></a>
                <a href="" title="Share on Facebook"><i class="icofont-facebook"></i></a>
                <a href="" title="Share on Instagram"><i class="icofont-instagram"></i></a>
              </div>

            </div>

          </article><!-- End blog entry -->

          <div class="blog-author clearfix">
            <img src="<?php echo base_url('assets/img/avatars/' .$berita->user_image); ?>" class="rounded-circle float-left" alt="">
            <h4><?php echo $berita->user_name; ?></h4>
            <div class="social-links">
              <a href="https://twitters.com/#"><i class="ri-twitter-line"></i></a>
              <a href="https://facebook.com/#"><i class="ri-facebook-fill"></i></a>
              <a href="https://instagram.com/#"><i class="ri-instagram-line"></i></a>
            </div>
            <p>
              <?php echo $berita->user_bio;?>
            </p>
          </div><!-- End blog author bio -->



        </div>
        <div class="col-md-3">
          <div class="sidebar card">
            <h3 class="sidebar-title">Search</h3>
            <div class="sidebar-item search-form">
              <form action="">
                <input type="text">
                <button type="submit"><i class="icofont-search"></i></button>
              </form>

            </div><!-- End sidebar search formn-->

            <h3 class="sidebar-title">Categories</h3>
            <div class="sidebar-item categories">
              <ul>
                <li><a href="#">General <span>(25)</span></a></li>
                <li><a href="#">Lifestyle <span>(12)</span></a></li>
                <li><a href="#">Travel <span>(5)</span></a></li>
                <li><a href="#">Design <span>(22)</span></a></li>
                <li><a href="#">Creative <span>(8)</span></a></li>
                <li><a href="#">Educaion <span>(14)</span></a></li>
              </ul>

            </div><!-- End sidebar categories-->

            <h3 class="sidebar-title">Recent Posts</h3>
            <div class="sidebar-item recent-posts">
              <div class="post-item clearfix">
                <img src="assets/img/portfolio/portfolio-5.jpg" alt="">
                <h4><a href="blog-single.html">Nihil blanditiis at in nihil autem</a></h4>
                <time datetime="2020-01-01">Jan 1, 2020</time>
              </div>

              <div class="post-item clearfix">
                <img src="assets/img/portfolio/portfolio-5.jpg" alt="">
                <h4><a href="blog-single.html">Quidem autem et impedit</a></h4>
                <time datetime="2020-01-01">Jan 1, 2020</time>
              </div>

              <div class="post-item clearfix">
                <img src="assets/img/portfolio/portfolio-5.jpg" alt="">
                <h4><a href="blog-single.html">Id quia et et ut maxime similique occaecati ut</a></h4>
                <time datetime="2020-01-01">Jan 1, 2020</time>
              </div>



            </div><!-- End sidebar recent posts-->



          </div><!-- End sidebar -->
        </div>
      </div>

    </div>
  </section>
