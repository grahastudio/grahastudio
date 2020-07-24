
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
        echo form_open_multipart('admin/vector/create');
        ?>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Nama Vector <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="vector_name" placeholder="Nama Vector" value="<?php echo set_value('vector_name'); ?>">
                <?php echo form_error('vector_name', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Harga <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="vector_price" placeholder="Harga" value="<?php echo set_value('vector_price'); ?>">
                <?php echo form_error('vector_price', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Discount <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="vector_discount" placeholder="Diskon" value="<?php echo set_value('vector_discount'); ?>">
                <?php echo form_error('vector_discount', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>



        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Area <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="vector_area" placeholder="Nama Vector" value="<?php echo set_value('vector_area'); ?>">
                <?php echo form_error('vector_area', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">File <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="vector_file" placeholder="Nama Vector" value="<?php echo set_value('vector_file'); ?>">
                <?php echo form_error('vector_file', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Print <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <select name="vector_print" class="form-control form-control-chosen select2_demo_1">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Frame <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <select name="vector_frame" class="form-control form-control-chosen select2_demo_1">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Upload Gambar <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <div class="input-group mb-3">
                    <input type="file" name="vector_image">
                </div>
            </div>
        </div>



        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Deskripsi  <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">

                <textarea class="form-control" id="summernote" name="vector_desc" placeholder="Deskripsi Produk"></textarea>
                <?php echo form_error('vector_desc', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Keywords
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="vector_keywords" placeholder="Pisahkan dengan koma" value="<?php echo set_value('vector_keywords'); ?>">
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
