<?php $meta = $this->meta_model->get_meta(); ?>
<div class="container">
    <div class="col-md-6 mx-auto" style="margin-top: 130px;">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->

                <div class="p-5">
                    <div class="text-center">

                        <h1 class="h5 text-gray-900 mb-4">Silahkan Login!</h1>
                        <?php echo $this->session->flashdata('message'); ?>
                    </div>
                    <?php
                    $attributes = array('class' => 'user');
                    echo form_open('auth', $attributes)
                    ?>
                    <div class="form-group">
                      <div class="input-group input-group-lg mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ri-mail-check-line"></i> </span>
                        </div>
                        <input type="text" class="form-control form-control-user" name="email" id="email" placeholder="Enter Email Address..." value="<?php echo set_value('email'); ?>">
                        <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group input-group-lg mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ri-lock-line"></i> </span>
                        </div>
                        <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password">
                        <?php echo form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                  </div>

                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Login
                    </button>

                    <?php echo form_close() ?>
                    <hr>
                    <div class="text-center">
                        <a class="small" href="<?php echo base_url('auth/forgotpassword'); ?>">Lupa Password?</a>
                    </div>
                    <!-- <div class="text-center">
                        <a class="small" href="<?php echo base_url('auth/register') ?> ">Create an Account!</a>
                    </div> -->
                </div>

            </div>
        </div>
    </div>

</div>
