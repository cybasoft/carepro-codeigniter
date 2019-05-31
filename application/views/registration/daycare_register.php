<?php $this->load->view("custom_layouts/header");  ?>
<script src="<?php echo base_url(); ?>assets/js/user_register/script.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/user_register/style.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/user_register/skin.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/user_register/contact-form.css">
<script src="<?php echo base_url(); ?>assets/plugins/extras/jquery-ui.min.js"></script>
<style>
    .form-control {
        height: 34px;
    }

    .stripe_connect:hover {
        text-decoration: none;
    }

    .user-edit-fileinput {
        position: absolute;
        visibility: hidden;
        width: 1px;
        height: 1px;
        opacity: 0;
    }

    .img_preview {
        width: 60px !important;
        height: 60px !important;
    }

    .media {
        margin-left: 12px;
    }

    .notifictions {
        z-index: 3000;
        max-width: 500px;
        top: 10px;
        right: 5px;
        position: absolute !important;
    }
    body{
        overflow-x: hidden;
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
                                        change
                                        <input type="file" class="user-edit-fileinput" name="logo" value="<?php echo set_value('logo'); ?>" id="avatar" accept="image/*">
                                    </label>
                                    <button type="button" class="btn btn-default btn-sm md-btn-flat mt-3 reset_btn">reset</button>
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
<script>
    $(document).ready(function() {
        $('.daycare_register').submit(function(e) {
            e.target.checkValidity();
            $('.loading_div').show();
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.img_preview').attr('src', e.target.result);
                    $("#avatar").attr('value', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        $(".user-edit-fileinput").change(function() {
            $("#img_preview").attr("src", "");
            $("#img_preview").removeClass("mr-3");
            $("#img_preview").addClass("d-block");
            $("#img_div").addClass("ml-3");
            $("#edit_image").val('');
            $("#customer_image").val('');
            $("#profile_image").val('');
            readURL(this);
        });
        $(".reset_btn").click(function() {
            $("#avatar").attr('value', '');
            $("#edit_image").val('');
            $("#customer_image").val('');
            $("#profile_image").val('');
            $("#img_preview").attr('src', '../assets/img/daycare/default-user-image.png');
        });

        $(".notifictions").delay(2000).hide("slide", {
            direction: "right"
        }, 5000);
    });
</script>
</html>