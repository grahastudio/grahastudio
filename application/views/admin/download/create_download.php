
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
        echo form_open_multipart('admin/download/create');
        ?>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Nama File <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="download_title" placeholder="Nama Vector" value="<?php echo set_value('download_title'); ?>">
                <?php echo form_error('download_title', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Harga <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="download_price" placeholder="Harga" value="<?php echo set_value('download_price'); ?>">
                <?php echo form_error('download_price', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Url Download <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="download_url" placeholder="Url Download" value="<?php echo set_value('download_url'); ?>">
                <?php echo form_error('download_url', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Category <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <select name="category_id" class="form-control form-control-chosen select2_demo_1">
                  <?php foreach ($category as $category) :?>
                    <option value="<?php echo $category->id;?>"><?php echo $category->category_name;?></option>
                  <?php endforeach;?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Upload Gambar <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <div class="input-group mb-3">
                    <input type="file" name="download_image">
                </div>
            </div>
        </div>



        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Deskripsi  <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">

                <textarea class="form-control" id="summernote" name="download_desc" placeholder="Deskripsi Download"></textarea>
                <?php echo form_error('download_desc', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Keywords
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="download_keywords" placeholder="Pisahkan dengan koma" value="<?php echo set_value('download_keywords'); ?>">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-3"></div>
            <div class="col-lg-9">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Publish Download
                </button>
            </div>
        </div>

        <?php echo form_close() ?>



    </div>
</div>
</div>
