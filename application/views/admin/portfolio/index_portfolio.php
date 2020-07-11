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
        <a href="<?php echo base_url('admin/portfolio/create'); ?>" class="btn btn-info waves-effect waves-light">Buat Portfolio</a>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Judul Portfolio</th>
                        <th>Kategori</th>
                        <th>Post by</th>
                        <th>date Post</th>
                        <th>date Update</th>
                        <th>Views</th>
                        <th width="25%">Action</th>
                    </tr>
                </thead>
                <?php $no = 1;
                foreach ($portfolio as $portfolio) { ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $portfolio->portfolio_title; ?></td>
                        <td><?php echo $portfolio->category_name; ?></td>
                        <td><?php echo $portfolio->user_name; ?></td>
                        <td><?php echo date('D, d F Y', $portfolio->date_created); ?> <?php echo date('H:i', $portfolio->date_created); ?></td>
                        <td><?php echo date('D, d F Y', $portfolio->date_updated); ?> <?php echo date('H:i', $portfolio->date_updated); ?></td>
                        <td><?php echo $portfolio->portfolio_views; ?></td>
                        <td>
                            <a href="<?php echo base_url('admin/portfolio/create'); ?>" class="btn btn-success"><i class="ti-eye"></i> Lihat</a>
                            <a href="<?php echo base_url('admin/portfolio/update/' . $portfolio->id); ?>" class="btn btn-info"><i class="ti-pencil-alt"></i> Edit</a>
                            <?php include "delete_portfolio.php"; ?>
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
