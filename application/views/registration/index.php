<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo session('company_name'); ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo assets('img/favicon.ico'); ?>">
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/user_register/script.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/user_register/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/user_register/skin.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/user_register/contact-form.css">
    <style>
        .form-control {
            height: 34px;
        }
        .stripe_connect:hover{
            text-decoration: none;
        }
    </style>
</head>
<body class="transparent-header">
    <div class="section-empty section-item">
        <div class="container content">
            <div class="row">
                <div class="col-md-10 offset-md-1 login-box shadow-1 ">
                    <div class="text-center">
                        <h2 style="padding-bottom:15px;">Register</h2>
                    </div>
                    <?php if (!empty($this->session->flashdata('type'))) : ?>
                        <div style="">
                            <?php echo $this->session->flashdata('message'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($this->session->flashdata('success'))) : ?>
                        <div class="alert alert-primary alert-dismissable">
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($this->session->flashdata('error'))) : ?>
                        <div class="alert alert-danger alert-dismissable">
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>
                    <?php echo form_open('user/create', ['class' => 'form-box']); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Name *</p>
                            <input class="form-control form-value" required="" name="name" type="text" value="<?php echo set_value('name'); ?>">
                        </div>
                        <div class="col-md-6">
                            <p>E-Mail Address *</p>
                            <input name="email" type="email" class="form-control form-value" required="" value="<?php echo set_value('email'); ?>">
                        </div>
                    </div>
                    <hr class="space xs" />
                    <div class="row">
                        <div class="col-md-6">
                            <p>Password *</p>
                            <input required="" name="password" type="password" class="form-control form-value" value="">
                        </div>
                        <div class="col-md-6">
                            <p>Confirm Password *</p>
                            <input type="password" required="" name="password_confirm" class="form-control form-value" value="">
                        </div>
                    </div>
                    <hr class="space xs" />
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <p>Address Line 1 *</p>
                                <input id="address_line_1" class="form-control" required="" placeholder="Street and number, P.O. box, c/o." name="address_line_1" type="text" value="<?php echo set_value('address_line_1'); ?>">
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <p>Address Line 2</p>
                            <input id="address_line_2" class="form-control" placeholder="Apartment, suite, unit, building, floor, etc." name="address_line_2" type="text" value="<?php echo set_value('address_line_2'); ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <p>City / Town / Village *</p>
                                <input id="city" class="form-control" required="" name="city" type="text" value="<?php echo set_value('city'); ?>">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <p>State / Province / Region *</p>
                                <input id="state" class="form-control" required="" name="state" type="text" value="<?php echo set_value('state'); ?>">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <p>ZIP *</p>
                                <input id="zip_code" class="form-control" required="" name="zip_code" type="text" value="<?php echo set_value('zip_code'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <p for="country">Country *</p>
                                <select id="country" class="form-control" required="" name="country" value="<?php echo set_value('country'); ?>">
                                    <option value="1">United States</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <p for="phone">Phone Number *</p>
                                <input id="phone" class="form-control" required="" name="phone" type="text" value="<?php echo set_value('phone'); ?>">
                            </div>
                        </div>
                    </div>
                    <button class="btn-sm btn" type="submit">Register</button>
                    <div>
                        <a href="../auth/login" style="float:right;">Already have an account?</a>
                    </div>
                    <?php echo form_close(); ?>
                    <p style="padding-top: 40px;" class="text-center">By registering your account, you agree to the <a href="https://stripe.com/us/connect-account/legal" class="btn-text stripe_connect" target="_blank">Stripe Connected Account Agreement</a>.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>