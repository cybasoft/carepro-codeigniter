<?php $this->load->view("custom_layouts/header");  ?>
<script src="<?php echo base_url(); ?>assets/js/user_register/script.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/user_register/style.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/user_register/skin.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/user_register/contact-form.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/user_register/daycare.css">
<script src="<?php echo base_url(); ?>assets/plugins/extras/jquery-ui.min.js"></script>
</head>
<body class="transparent-header">
    <div class="loading_div">
    </div>
    <?php if (!empty($this->session->flashdata('message'))) : ?>
        <div class="alert alert-success alert-dismissible fade show notifictions" role="alert">
            <?php echo $this->session->flashdata('message'); ?>
        </div>
    <?php endif; ?>
    <div class="section-empty section-item">
        <div class="container content">
            <div class="row">
                <div class="col-md-10 offset-md-1 login-box shadow-1 ">
                    <div class="text-center">
                        <h2 style="padding-bottom:15px;">Daycare Registration</h2>
                    </div>
                    <?php  if (!empty($this->session->flashdata('type'))) : ?>
                        <div style="">
                            <?php echo $this->session->flashdata('message'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($this->session->flashdata('error'))) : ?>
                        <div class="alert alert-danger alert-dismissable">
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>
                    <?php echo form_open_multipart("daycare/store/$activation_code", ['class' => 'form-box daycare_register']); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Name *</p>
                            <input class="form-control form-value" required="" name="name" type="text" value="<?php echo set_value('name'); ?>">
                        </div>
                        <div class="col-md-6">
                            <p>Employee Tax Identifier *</p>
                            <input name="employee_tax_identifier" type="text" class="form-control form-value" required="" value="<?php echo set_value('employee_tax_identifier'); ?>">
                        </div>
                    </div>
                    <hr class="space xs" />
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
                    <div class="row">
                        <div class="col-md-6">
                            <p for="avatar">Logo *</p>
                            <div class="media align-items-center form-group ml-0">
                                <img src="../assets/img/daycare/default-user-image.png" alt="daycare logo" class="ui-w-100 img_preview mr-3" id="img_preview">
                                <div class="media-body" id="img_div">
                                    <label class="btn btn-outline-primary btn-sm change_btn mr-1 mt-4">
                                        Change
                                        <input type="file" class="user-edit-fileinput" name="logo" value="<?php echo set_value('logo'); ?>" id="avatar" accept="image/*">
                                    </label>
                                    <button type="button" class="btn btn-default btn-sm md-btn-flat mt-3 reset_btn">Reset</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-2">
                                <button class="btn-sm btn mt-5 float-right" type="submit">Register</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="<?php echo base_url(); ?>assets/js/daycare.js"></script>
</html>