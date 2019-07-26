<?php $this->load->view("custom_layouts/header");  ?>
<link href="<?php echo base_url(); ?>assets/css/icons/font-awesome/css/all.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/style.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/content-box.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/skin.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/user_register/subscription_page.css">
</head>
<body>
    <div class="header_section">
        <img src="assets/uploads/content/logo.png" align="left" class="logo">
        <a href="login" class="btn btn-primary login_button">Login</a>
    </div>
    <div class="container">
        <div class="main_section">
            <?php if (!empty($this->session->flashdata('error'))) : ?>
                <div class="alert alert-danger alert-dismissable">
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>
            <div class="row">
                <?php foreach ($plans as $plan) : ?>
                    <div class="col-md-4">
                        <form method="post" action="user/plan">
                            <div class="list-group pricing-table">
                                <div class="list-group-item pricing-price">
                                    <span>$</span><?php echo $plan['price'] ?><span>/mon</span>
                                    <input type="hidden" value="<?php echo $plan['price'] ?>" name="price">
                                    <input type="hidden" value="<?php echo $plan['plan'] ?>" name="plan">
                                </div>
                                <div class="list-group-item pricing-name">
                                    <h3><?php echo $plan['plan'] ?> plan</h3>
                                </div>
                                <div class="list-group-item">
                                    <p class="row">
                                        <span class="col-1"><i class="fas fa-child"></i></span>
                                        <span class="col-10"><?php echo $plan['children'];
                                                                echo lang(' Children'); ?></span>
                                    </p>
                                </div>
                                <div class="list-group-item">
                                    <p class="row">
                                        <span class="col-1"><i class="fas fa-chalkboard-teacher"></i></span>
                                        <span class="col-10"><?php echo $plan['staff_members'];
                                                                echo lang(' Staff members'); ?></span>
                                    </p>
                                </div>
                                <div class="list-group-item">
                                    <p class="row">
                                        <span class="col-1"><i class="fas fa-calendar"></i></span>
                                        <span class="col-10"><?php echo $plan['calender_events'];
                                                                echo lang(' Calender events'); ?></span>
                                    </p>
                                </div>
                                <div class="list-group-item">
                                    <p class="row">
                                        <span class="col-1"><i class="fas fa-newspaper"></i></span>
                                        <span class="col-10"><?php echo  lang('yes News Module'); ?></span>
                                    </p>
                                </div>
                                <div class="list-group-item">
                                    <p class="row">
                                        <span class="col-1"><i class="fas fa-home"></i></span>
                                        <span class="col-10"><?php echo  lang('yes Rooms'); ?></span>
                                    </p>
                                </div>
                                <div class="list-group-item">
                                    <p class="row">
                                        <span class="col-1"><i class="fas fa-file-invoice"></i></span>
                                        <span class="col-10"><?php echo $plan['invoices'];
                                                                echo  lang(' Invoices'); ?></span>
                                    </p>
                                </div>
                                <!-- <div class="list-group-item">
                                <p class="row">
                                    <span class="col-1"><i class="fas fa-file-upload"></i></span>
                                    <span class="col-10"><?php echo  lang('No Files'); ?></span>
                                </p>
                            </div> -->
                                <div class="list-group-item pricing-btn text-center">
                                    <input type="submit" class="btn btn-sm circle-button" value="Select Plan">
                                </div>
                            </div>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>