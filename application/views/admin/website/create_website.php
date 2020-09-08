
<div class="card shadow mb-4">
  <div class="col-md-8 mx-auto">
    <div class="card-header py-3">
        <?php echo $title; ?>
    </div>
    <div class="card-body">


        <div class="text-center">
            <?php
            echo $this->session->flashdata('message');
            if (isset($errors_upload)) {
                echo '<div class="alert alert-warning">' . $error_upload . '</div>';
            }
            ?>
        </div>
        <?php
        echo form_open_multipart('admin/website/create');
        ?>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Nama Website <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="website_name" placeholder="Nama Website" value="<?php echo set_value('website_name'); ?>">
                <?php echo form_error('website_name', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Harga <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="website_price" placeholder="Harga" value="<?php echo set_value('website_price'); ?>">
                <?php echo form_error('website_price', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Discount <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="website_discount" placeholder="Diskon" value="<?php echo set_value('website_discount'); ?>">
                <?php echo form_error('website_discount', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Biaya Perpanjangan <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="website_renewal" placeholder="Perpanjangan" value="<?php echo set_value('website_renewal'); ?>">
                <?php echo form_error('website_renewal', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>


        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Upload Gambar <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <div class="input-group mb-3">
                    <input type="file" name="website_image">
                </div>
            </div>
        </div>



        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Deskripsi  <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">

                <textarea class="form-control" id="summernote" name="website_desc" placeholder="Deskripsi Produk"></textarea>
                <?php echo form_error('website_desc', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Keywords
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="website_keywords" placeholder="Pisahkan dengan koma" value="<?php echo set_value('website_keywords'); ?>">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-3"></div>
            <div class="col-lg-9">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Publish Product
                </button>
            </div>
        </div>

        <?php echo form_close() ?>



    </div>
</div>
</div>
