<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="/assets/frontend/img/favicon.png" type="image/png">
    <title><?php echo config('company', 'name'); ?></title>
    <link rel="stylesheet" href="/assets/frontend/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/frontend/vendors/linericon/style.css">
    <link rel="stylesheet" href="/assets/frontend/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/frontend/vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/frontend/css/magnific-popup.css">
    <link rel="stylesheet" href="/assets/frontend/vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="/assets/frontend/vendors/animate-css/animate.css">
    <link rel="stylesheet" href="/assets/frontend/vendors/flaticon/flaticon.css">
    <link rel="stylesheet" href="/assets/frontend/css/style.css">
</head>

<body>

<header class="header_area">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand logo_h" href="/">
                    <img src="/assets/img/logo.png" alt="" style="height:70px">
                </a>
                <button class="navbar-toggler"
                        type="button"
                        data-toggle="collapse"
                        data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent"
                        aria-expanded="false"
                        aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav justify-content-center">
                        <li class="nav-item active"><a class="nav-link" href="/">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="/#features">Features</a></li>
                        <li class="nav-item"><a class="nav-link" href="/#demo">Demo</a></li>
                        <li class="nav-item"><a class="nav-link" href="/#pricing">Pricing</a></li>
                        <li class="nav-item"><a class="nav-link" href="/#contact">Contact</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item"><a href="/login" class="primary_btn text-uppercase">Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>


<?php if(!empty($this->session->flashdata('error'))) : ?>
    <div style="max-width:500px;margin:0 auto">
        <div class="alert alert-danger alert-dismissable">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    </div>
<?php endif; ?>
<?php if(!empty($this->session->flashdata('type')) || !empty($this->session->flashdata('message'))) : ?>
<div style="max-width:500px;margin:0 auto">
    <?php echo $this->session->flashdata('message'); ?>
</div>
<?php endif; ?>