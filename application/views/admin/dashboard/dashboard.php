<div class="row mb-3">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Berita</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($berita); ?></div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                            <a href="<?php echo base_url('admin/pemasukan'); ?>" style="color:#333;text-decoration:none;">
                                <span class="text-success mr-2"><i class="fas fa-arrow-right"></i> </span>
                                <span class="text-success">Lihat Data Pemasukan</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="ti-import fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Pengeluaran</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?php echo count($list_user); ?></div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                            <a href="<?php echo base_url('admin/pengeluaran'); ?>" style="color:#333;text-decoration:none;">
                                <span class="text-danger mr-2"><i class="fas fa-arrow-right"></i> </span>
                                <span class="text-danger">Lihat Data Pengeluaran</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="ti-export fa-2x text-danger"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- New User Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Saldo Akhir</div>
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                            dfdsf
                        </div>
                        <div class="mt-2 mb-0 text-muted text-xs">
                            <a href="<?php echo base_url('admin/kas'); ?>" style="color:#333;text-decoration:none;">
                                <span class="text-info mr-2"><i class="fas fa-arrow-right"></i> </span>
                                <span class="text-info">Lihat Data Saldo</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="ti-credit-card fa-2x text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Invoice Example -->
    <div class="col-xl-8 col-lg-7 mb-4">
        <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Donasi Terbaru</h6>
                <a class="m-0 float-right btn btn-danger btn-sm" href="<?php echo base_url('admin/kas'); ?>">View More <i class="fas fa-chevron-right"></i></a>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>Tanggal</th>
                            <th>Kategori</th>
                          
                            <!-- <th>Action</th> -->

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_user as $list_user) : ?>

                            <tr>


                                <td><?php echo $list_user->user_name; ?></td>


                                <!-- <td><a href="<?php echo base_url('admin/dashboard/view/' . $kas->id); ?>" class="btn btn-primary btn-sm">Detail</a></td> -->



                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer"></div>
        </div>
    </div>
    <!-- Message From Customer-->
    <div class="col-xl-4 col-lg-5 ">
        <div class="card">
            <div class="card-header py-4 bg-primary d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-light">Title</h6>
            </div>
            <div>
                <div class="customer-message align-items-center">
                    <a class="font-weight-bold" href="#">
                        <div class="text-truncate message-title">Hi there! I am wondering if you can help me with a
                            problem I've been having.</div>
                        <div class="small text-gray-500 message-time font-weight-bold">Udin Cilok · 58m</div>
                    </a>
                </div>
                <div class="customer-message align-items-center">
                    <a href="#">
                        <div class="text-truncate message-title">But I must explain to you how all this mistaken idea
                        </div>
                        <div class="small text-gray-500 message-time">Nana Haminah · 58m</div>
                    </a>
                </div>
                <div class="customer-message align-items-center">
                    <a class="font-weight-bold" href="#">
                        <div class="text-truncate message-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit
                        </div>
                        <div class="small text-gray-500 message-time font-weight-bold">Jajang Cincau · 25m</div>
                    </a>
                </div>
                <div class="customer-message align-items-center">
                    <a class="font-weight-bold" href="#">
                        <div class="text-truncate message-title">At vero eos et accusamus et iusto odio dignissimos
                            ducimus qui blanditiis
                        </div>
                        <div class="small text-gray-500 message-time font-weight-bold">Udin Wayang · 54m</div>
                    </a>
                </div>
                <div class="card-footer text-center">
                    <a class="m-0 small text-primary card-link" href="#">View More <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </div>















</div>
<!--Row-->
