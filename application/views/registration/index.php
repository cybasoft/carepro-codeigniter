<?php $this->load->view("custom_layouts/header");  ?>
<script src="<?php echo base_url(); ?>assets/js/user_register/script.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/user_register/style.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/user_register/skin.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/user_register/contact-form.css">
<style>
    .form-control {
        height: 34px;
    }

    .stripe_connect:hover {
        text-decoration: none;
    }

    body {
        position: relative
    }

    .loading_div {
        display: none;
        position: fixed;
        background: #fff url('../assets/img/loader.gif') no-repeat 50%;
        opacity: .5;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1000;
        height: 100%;
    }
</style>
</head>

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
<script>
    $(document).ready(function() {
        $('.user_register').submit(function(e) {
            e.target.checkValidity();
            $('.loading_div').show();
        });
    });
</script>
</html>