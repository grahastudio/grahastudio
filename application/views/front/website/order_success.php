

<section>
  <div class="container">
    <div class="col-md-7 mx-auto">
      <div class="card mt-5 body-success">
        <div class="card-header order-success">
          <div class="row">
            <div class="col-md-2 text-center">
              <h1 class="display-2"><i class="far fa-check-circle"></i></h1>
            </div>
            <div class="col-md-10 align-middle">
              <h3><span class="align-middle">Terima kasih atas pembeliannya</span></h3>
              <p style="font-size:13px;">Simpan Struk Invoice ini untuk dapat melakukan pengecekan status order anda</p>
            </div>
          </div>
        </div>
        <div class="card-body body-success">
          <div class="row">
            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <?php echo $last_transaksi->product;?></br>
                  Customer :</br>
                  <b><?php echo $last_transaksi->user_name;?></b></br>

                  Kode Transaksi :</br>
                  <b><?php echo $last_transaksi->transaction_code;?></b></br>

                  Kode Unik :</br>
                  <b><?php echo $last_transaksi->unique_code;?></b></br>

                  Harga :</br>
                  <b>IDR. <?php echo number_format($last_transaksi->price, '0', ',', '.');?></b></br>
                  <hr>
                  Total Pembayaran </br>
                  <span style="font-size:30px;"><b>IDR. <?php echo number_format($last_transaksi->price, '0', ',', '.');?></b></span></br>

                </div>
              </div>
            </div>
            <div class="col-md-6">
              Untuk Pembayaran Silahkan Transfer Ke rekening di bawah ini<br>

              <?php foreach ($bank as $bank) :?>
                <div class="row mt-3">
                <div class="col-4"> <img class="img-fluid" src="<?php echo base_url('assets/img/galery/'.$bank->bank_logo);?>">
                </div>
                <div class="col-8">
                No. rek : <b><?php echo $bank->bank_number;?></b>
                  A.n   : <b><?php echo $bank->bank_account;?></b>
                  </div>
                  </div>
              <?php endforeach;?>
              Jika anda sudah transfer pembayaran silahkan Konfirmasi Pembayaran anda
              <a class="btn btn-primary" href="<?php echo base_url('transaksi/konfirmasi/' .$last_transaksi->transaction_code);?>">Konfirmasi Pembayaran</a>

            </div>
          </div>
        </div>
        <div class="card-footer order-success">
          <div class="form-row d-flex justify-content-between align-items-center ">
          Customer Support<br>
          <h5><i class="fab fa-whatsapp"></i> <?php echo $meta->telepon;?></h5>
        </div>
      </div>
      </div>
    </div>
  </div>
</section>
