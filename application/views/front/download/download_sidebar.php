<div class="sidebar card">
            <!-- <h3 class="sidebar-title">Search</h3>
            <div class="sidebar-item search-form">
              <form action="">
                <input type="text">
                <button type="submit"><i class="icofont-search"></i></button>
              </form>

            </div> -->

            <h3 class="sidebar-title">Category File</h3>
            <div class="sidebar-item categories">
              <ul>
                  <?php foreach($category_download as $category_download){?>
                <li><a href="<?php echo base_url('download/category/'.$category_download->category_slug);?>"><?php echo $category_download->category_name;?></a></li>
                  <?php };?>
              </ul>

            </div><!-- End sidebar categories-->

            <h3 class="sidebar-title">Recent Download</h3>
            <div class="sidebar-item recent-posts">
                <?php foreach ($popular_download as $popular_download) {?>
                    <div class="post-item clearfix">
                <img src="<?php echo base_url('assets/img/download/' .$popular_download->download_image);?>" alt="">
                <h4><a href="<?php echo base_url('download/detail/' .$popular_download->download_slug);?>"><?php echo substr($popular_download->download_title, 0 ,40);?></a></h4>
                <!-- <i class="ri-calendar-line"></i> <?php echo date('d F Y', $popular_download->date_created);?> -->
                <div class="icon"><i class="ri-download-2-line"></i> <?php echo $popular_download->download_views;?></div>
              </div>
                <?php };?>


            </div><!-- End sidebar recent posts-->



          </div><!-- End sidebar -->
