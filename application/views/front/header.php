<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="/assets/img/thumb.png" type="image/png">
    <title><?php echo config('company', 'name'); ?></title>
    <link rel="stylesheet" href="/assets/frontend/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo assets('fonts/linericon/style.css'); ?>">
    <link rel="stylesheet" href="/assets/frontend/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/frontend/vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/frontend/css/magnific-popup.css">
    <link rel="stylesheet" href="/assets/frontend/vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="/assets/frontend/vendors/animate-css/animate.css">
    <link rel="stylesheet" href="<?php echo assets('fonts/flaticon/flaticon.css'); ?>">
    <link rel="stylesheet" href="/assets/frontend/css/style.css">

    <link rel="apple-touch-icon" sizes="180x180" href="/assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="/assets/favicon/site.webmanifest">
    <link rel="mask-icon" href="/assets/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/assets/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="/assets/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <meta name="apple-mobile-web-app-title" content="CarePRO">
    <meta name="application-name" content="CarePRO">
    <meta name="msapplication-TileColor" content="#3C366B">
    <meta name="msapplication-config" content="/img/browserconfig.xml">
    <meta name="theme-color" content="#3C366B">

    <meta name="description"
          content="A daycare management software for busy daycare owners who want a simple yet powerfull tool to manage their daycare">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@careproapp">
    <meta name="twitter:title" content="Daycare management software - careproapp.com">
    <meta name="twitter:description" content="Take your daycare to the cloud and manage it with ease - careproapp">
    <meta name="twitter:image" content="/img/content/card.png">
    <meta name="twitter:creator" content="@careproapp">
    <meta property="og:url" content="https://careproapp.com/"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="Daycare management software - careproapp.com"/>
    <meta property="og:description" content="Take your daycare to the cloud and manage it with ease - careproapp"/>
    <meta property="og:image" content="/img/content/card.png"/>
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

<?php
if(!empty($this->session->flashdata('type')) || !empty($this->session->flashdata('notice'))) {
    echo $this->session->flashdata('notice');
}
?>