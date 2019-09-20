<?php $this->load->view('front/header'); ?>

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