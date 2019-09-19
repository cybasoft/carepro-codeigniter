<?php $this->load->view("registration/header");  ?>

<body class="transparent-header">
    <div class="loading_div">
    </div>
    <div class="section-empty section-item">
        <div class="container content">
            <div class="row">
                <div class="col-md-6 offset-md-3 login-box shadow-1 ">
                    <div class="text-center">
                        <h2 style="padding-bottom:15px;">Register</h2>
                    </div>
                    <?php if (!empty($this->session->flashdata('type'))) : ?>
                        <div style="">
                            <?php echo $this->session->flashdata('message'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($this->session->flashdata('verify_email_error'))) : ?>
                        <div class="alert alert-danger alert-dismissable">
                            <?php echo $this->session->flashdata('verify_email_error'); ?>
                        </div>
                    <?php endif; ?>
                    <?php echo form_open('user/create', ['class' => 'form-box user_register']); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <p>Name *</p>
                            <input class="form-control form-value" required="" name="name" type="text" value="<?php echo set_value('name'); ?>">
                        </div>
                    </div>
                    <hr class="space xs" />
                    <div class="row">
                        <div class="col-md-12">
                            <p>E-Mail Address *</p>
                            <input name="email" type="email" class="form-control form-value" required="" value="<?php echo set_value('email'); ?>">
                        </div>
                    </div>
                    <hr class="space xs" />
                    <div class="row">
                        <div class="col-md-12">
                            <p>Password *</p>
                            <input required="" name="password" type="password" class="form-control form-value" value="">
                        </div>
                    </div>
                    <hr class="space xs" />
                    <div class="row">
                        <div class="col-md-12">
                            <p>Confirm Password *</p>
                            <input type="password" required="" name="password_confirm" class="form-control form-value" value="">
                        </div>
                    </div>
                    <hr class="space xs" />
                    <button class="btn-sm btn" type="submit" id="user_register">Register</button>
                    <a href="../auth/login" style="float:right;margin-top:14px">Already have an account?</a>
                    <?php echo form_close(); ?>
                    <p style="padding-top: 40px;" class="text-center">By registering your account, you agree to the <a href="https://stripe.com/us/connect-account/legal" class="btn-text stripe_connect" target="_blank">Terms and condition</a>.</p>
                </div>
            </div>
        </div>
    </div>
</body>
<?php $this->load->view("registration/footer");  ?>
<script>
    $(document).ready(function() {
        $('.user_register').submit(function(e) {
            e.target.checkValidity();
            $('.loading_div').show();
        });
    });
</script>

