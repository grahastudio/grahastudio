
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
        echo form_open_multipart('admin/website/update/' .$website->id);
        ?>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Nama Website <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="website_name" placeholder="Nama Website" value="<?php echo $website->website_name; ?>">

            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Harga <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="website_price" placeholder="Price" value="<?php echo $website->website_price; ?>">

            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Discount <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="website_discount" placeholder="Diskon" value="<?php echo $website->website_discount; ?>">

            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Area <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="website_area" placeholder="Website Area" value="<?php echo $website->website_area; ?>">

            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">File <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="website_file" placeholder="File Website" value="<?php echo $website->website_file; ?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Print <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <select name="website_print" class="form-control form-control-chosen select2_demo_1">
                    <option value="Yes">Yes</option>
                    <option value="No" <?php if ($website->website_print == "No") { echo "selected";} ?>>No</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Frame <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <select name="website_frame" class="form-control form-control-chosen select2_demo_1">
                    <option value="Yes">Yes</option>
                    <option value="No" <?php if ($website->website_frame == "No") { echo "selected";} ?>>No</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Upload Gambar <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <div class="input-group mb-3">
                    <input type="file" name="website_image">
                    <img class="img-fluid" src="<?php echo base_url('assets/img/product/'.$website->website_image);?>">
                </div>
            </div>
        </div>



        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Deskripsi  <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">

                <textarea class="form-control" id="summernote" name="website_desc" ><?php echo $website->website_desc;?></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Keywords
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="website_keywords" placeholder="Pisahkan dengan koma" value="<?php echo $website->website_keywords; ?>">
            </div>
        </div>

        <div class="form-group row">
            <div class="col-lg-3"></div>
            <div class="col-lg-9">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Update Product
                </button>
            </div>
        </div>

        <?php echo form_close() ?>



    </div>
</div>
</div>
