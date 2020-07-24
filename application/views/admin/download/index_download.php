<div class="card">
    <div class="card-header">
        <div class="card-header-left">
            <h5><?php echo $title; ?></h5>
        </div>
        <div class="card-header-right">

        </div>

    </div>
    <div class="card-body">
        <?php
        //Notifikasi
        if ($this->session->flashdata('message')) {
            echo '<div class="alert alert-success alert-dismissable fade show">';
            echo '<button class="close" data-dismiss="alert" aria-label="Close">×</button>';
            echo $this->session->flashdata('message');
            echo '</div>';
        }
        echo validation_errors('<div class="alert alert-warning">', '</div>');

        ?>
        <a href="<?php echo base_url('admin/download/create'); ?>" class="btn btn-info waves-effect waves-light">Buat Download</a>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>File Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>views</th>
                        <th width="25%">Action</th>
                    </tr>
                </thead>
                <?php $no = 1;
                foreach ($download as $download) { ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $download->download_title; ?></td>
                        <td><?php echo $download->category_name; ?></td>
                        <td><?php echo $download->download_price; ?></td>
                        <td><?php echo $download->download_views; ?></td>
                        <td>
                            <a href="<?php echo base_url('admin/download/create'); ?>" class="btn btn-success"><i class="ti-eye"></i> Lihat</a>
                            <a href="<?php echo base_url('admin/download/update/' . $download->id); ?>" class="btn btn-info"><i class="ti-pencil-alt"></i> Edit</a>
                            <?php include "delete_download.php"; ?>
                        </td>
                    </tr>

                <?php $no++;
                }; ?>
            </table>

            <div class="pagination col-md-12 text-center">
                <?php if (isset($pagination)) {
                    echo $pagination;
                } ?>
            </div>

        </div>

    </div>
</div>
