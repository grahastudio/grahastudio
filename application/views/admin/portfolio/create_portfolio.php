<div class="card shadow mb-4">
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
        echo form_open_multipart('admin/portfolio/create');
        ?>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Judul Portfolio <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <input type="text" class="form-control" name="portfolio_title" placeholder="Judul Portfolio" value="<?php echo set_value('portfolio_title'); ?>">
                <?php echo form_error('portfolio_title', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Kategori <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <select name="category_id" class="form-control form-control-chosen select2_demo_1">
                    <option value="">Pilih Kategori</option>
                    <?php foreach ($category as $category) { ?>
                        <option value="<?php echo $category->id ?>">
                            <?php echo $category->category_name ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Status Portfolio <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <select name="portfolio_status" class="form-control form-control-chosen select2_demo_1">
                    <option value="Publish">Publish</option>
                    <option value="Draft">Draft</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Upload Gambar <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <div class="input-group mb-3">
                    <input type="file" name="portfolio_gambar">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Deskripsi Portfolio <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">

                <textarea class="form-control" id="summernote" name="portfolio_desc" placeholder="Deskripsi Portfolio"></textarea>
                <?php echo form_error('portfolio_desc', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Keywords
            </label>
            <div class="col-lg-6">
                <input type="text" class="form-control" name="portfolio_keywords" placeholder="Pisahkan dengan koma" value="<?php echo set_value('portfolio_keywords'); ?>">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Publish Portfolio
                </button>
            </div>
        </div>

        <?php echo form_close() ?>



    </div>
</div>
