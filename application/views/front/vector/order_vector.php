<?php
$id             = $this->session->userdata('id');
$user           = $this->user_model->user_detail($id);
?>

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


<section>
  <div class="container">
    <div class="row">
      <div class="col-md-6 mt-3">

            <img style="border-radius:5px;" src="<?php echo base_url('assets/img/product/' . $vector->vector_image);?>" class="img-fluid animated" alt="">

            <h2><?php echo $vector->vector_name;?></h2>

            <h1>IDR. <?php echo number_format($vector->vector_price, '0', ',', '.') ;?></h1>
            <?php echo $vector->vector_desc;?>




      </div>

      <div class="col-md-6">
        <div class="card">
          <div class="card-body">

            <h3>Form Order Jasa Vector</h3>
            <hr>

            <?php
            $transaction_code = date('dmY') . strtoupper(random_string('alnum', 5));
            echo form_open_multipart('vector/order/' .$vector->vector_slug);
            ?>
            <!-- Input Hidden -->
            <input type="hidden" name="transaction_code" value="<?php echo $transaction_code ?>">
            <input type="hidden" name="product" value="vector - <?php echo $vector->vector_name ?>">
            <?php
            $sub = substr($vector->vector_price,-3);
            $total =  random_string('numeric', 3);
            $hasil =  $vector->vector_price + $total;
            $no = substr($hasil,-3);
            ?>
            <input type="hidden" name="unique_code" value="<?php echo $no ?>">
            <input type="hidden" name="price" value="<?php echo $hasil ?>">




            <!-- If User Login -->
  <?php if ($this->session->userdata('id')) :?>

            <input type="hidden" name="user_id" value="<?php echo $user->id; ?>">
            <div class="form-group">
              <label class="col-form-label">Nama Lengkap <span class="text-danger">*</span>
              </label>

                <input type="text" class="form-control" name="user_name" placeholder="Nama Lengkap" value="<?php echo $user->user_name; ?>">
                <?php echo form_error('user_name', '<small class="text-danger">', '</small>'); ?>

            </div>

            <div class="form-group">
              <label class="col-form-label">Email <span class="text-danger">*</span>
              </label>

                <input type="text" class="form-control" name="email" placeholder="Nama Lengkap" value="<?php echo $user->email; ?>" id="inputemail">
                <?php echo form_error('email', '<small class="text-danger">', '</small>'); ?>

            </div>

            <div class="form-group">
              <label class="col-form-label">No Whatsapp / Hp <span class="text-danger">*</span>
              </label>

                <input type="text" class="form-control" name="user_phone" placeholder="Nama Lengkap" value="<?php echo $user->user_phone; ?>">
                <?php echo form_error('user_phone', '<small class="text-danger">', '</small>'); ?>

            </div>

            <div class="form-group">
              <label class="col-form-label">Alamat <span class="text-danger">*</span>
              </label>

                <input type="text" class="form-control" name="user_address" placeholder="Alamat" value="<?php echo $user->user_address; ?>">
                <?php echo form_error('user_address', '<small class="text-danger">', '</small>'); ?>

            </div>

            <!-- End If User Login -->
            <?php else:?>

              <div class="form-group">
                <label class="col-form-label">Nama Lengkap <span class="text-danger">*</span>
                </label>

                  <input type="text" class="form-control" name="user_name" placeholder="Nama Lengkap" value="<?php echo set_value('user_name'); ?>">
                  <?php echo form_error('user_name', '<small class="text-danger">', '</small>'); ?>

              </div>

              <div class="form-group">
                <label class="col-form-label">Email <span class="text-danger">*</span>
                </label>

                  <input type="text" class="form-control" name="email" placeholder="Nama Lengkap" value="<?php echo set_value('email'); ?>" id="inputemail">
                  <?php echo form_error('email', '<small class="text-danger">', '</small>'); ?>

              </div>

              <div class="form-group">
                <label class="col-form-label">No Whatsapp / Hp <span class="text-danger">*</span>
                </label>

                  <input type="text" class="form-control" name="user_phone" placeholder="Nama Lengkap" value="<?php echo set_value('user_phone'); ?>">
                  <?php echo form_error('user_phone', '<small class="text-danger">', '</small>'); ?>

              </div>

              <div class="form-group">
                <label>Alamat <span class="text-danger">*</span>
                </label>

                  <input type="text" class="form-control" name="user_address" placeholder="Alamat" value="<?php echo set_value('user_address'); ?>">
                  <?php echo form_error('user_address', '<small class="text-danger">', '</small>'); ?>

              </div>

            <?php endif;?>

            <div class="form-group">
              <label>Upload Foto <span class="text-danger">*</span>
              </label>
                  <input type="file" name="image">
                </div>

            </div>

            <div class="form-group col-md-12">
              <label>Catatan  <span class="text-success">(Optional)</span>
              </label>
                <textarea class="form-control" name="description" placeholder="Catatan order"></textarea>
                <?php echo form_error('description', '<small class="text-danger">', '</small>'); ?>
            </div>

            <div class="form-group">
              <div class="col-lg-3"></div>
              <div class="col-lg-9">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                  Order
                </button>
              </div>
            </div>



















            <?php echo form_close();?>

          </div>
        </div>
      </div>

    </div>
  </div>
</section>
