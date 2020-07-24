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
        <a href="<?php echo base_url('admin/vector/create'); ?>" class="btn btn-info waves-effect waves-light">Buat Vector</a>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Vector</th>
                        <th>Area</th>
                        <th>File</th>
                        <th>Price</th>
                        <th width="25%">Action</th>
                    </tr>
                </thead>
                <?php $no = 1;
                foreach ($vector as $vector) { ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $vector->vector_name; ?></td>
                        <td><?php echo $vector->vector_area; ?></td>
                        <td><?php echo $vector->vector_file; ?></td>
                        <td><?php echo $vector->vector_price; ?></td>
                        <td>
                            <a href="<?php echo base_url('vector/order/' .$vector->vector_slug); ?>" class="btn btn-success"><i class="ti-eye"></i> Lihat</a>
                            <a href="<?php echo base_url('admin/vector/update/' . $vector->id); ?>" class="btn btn-info"><i class="ti-pencil-alt"></i> Edit</a>
                            <?php include "delete_vector.php"; ?>
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
