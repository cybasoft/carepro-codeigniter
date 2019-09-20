<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="/assets/frontend/img/favicon.png" type="image/png">
    <title><?php echo config_item('app.name'); ?></title>
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
                        <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                        <li class="nav-item"><a class="nav-link" href="#demo">Demo</a></li>
                        <li class="nav-item"><a class="nav-link" href="#pricing">Pricing</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item"><a href="/login" class="primary_btn text-uppercase">Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>

<section class="home_banner_area">
    <div class="banner_inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="banner_content">
                        <h2>
                            Manage your <br>
                            <span style="">daycare</span> like a PRO
                        </h2>
                        <p>
                            From tracking attendace, invoicing, calendar, to tracking child's
                            medications, allergies, food intake and developmental activities
                        </p>
                        <div class="d-flex align-items-center">
                            <a class="primary_btn" href="#pricing">
                                <span>Get Started</span>
                            </a>
                            <!--                            <a id="play-home-video" class="video-play-button"-->
                            <!--                               href="https://www.youtube.com/watch?time_continue=2&v=J9YzcEe29d0">-->
                            <!--                                <span></span>-->
                            <!--                            </a>-->
                            <!--                            <div class="watch_video text-uppercase">-->
                            <!--                                watch the video-->
                            <!--                            </div>-->
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="home_right_img">
                        <img class="img-fluid" src="/assets/frontend/img/banner/home-right.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->

<!--Features-->
<?php $this->load->view('front/features'); ?>

<?php //$this->load->view('front/more-features'); ?>

<!--Pricing-->
<?php $this->load->view('front/pricing'); ?>

<!--Testimonials-->
<?php //$this->load->view('front/testimonials'); ?>

<!--Customers-->
<?php //$this->load->view('front/customers'); ?>
<?php $this->load->view('front/contact'); ?>


<section class="impress_area" id="demo">
    <div class="container">
        <div class="impress_inner">
            <h2>Want to see it in action?</h2>
            <p></p>
            <a class="primary_btn" href="#demo"><span>Request Free Demo</span></a>
        </div>
    </div>
</section>

<!--Footer-->
<?php $this->load->view('front/footer'); ?>

</body>

</html>