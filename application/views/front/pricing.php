<section class="price_area section_gap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="main_title">
                    <p class="top_title">Features Specifications</p>
                    <h2>Amazing Features That make it Awesome!</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                </div>
            </div>
        </div>
        <div class="price_inner row justify-content-center">
            <?php foreach ($plans as $plan) : ?>
                <div class="col-lg-4 col-md-6">
                    <form method="post" action="user/plan">
                        <input type="hidden" value="<?php echo $plan['price']; ?>" name="price">
                        <input type="hidden" value="<?php echo $plan['plan']; ?>" name="plan">


                        <div class="price_item">
                            <div class="price_head">
                                <h4><?php echo strtoupper($plan['plan']); ?></h4>
                            </div>
                            <div class="price_body">
                                <ul class="list" style="padding:40px;text-align: left">
                                    <li>
                                        <a href="#">
                                            <span><i class="fa fa-child"></i></span>
                                            <span><?php echo $plan['children'].' '.lang(' Children'); ?></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span><i class="fa fa-user"></i></span>
                                            <span><?php echo $plan['staff_members'].' '.lang(' Staff members'); ?></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span><i class="fa fa-calendar"></i></span>
                                            <span><?php echo $plan['calender_events'];
                                                echo lang(' Calender events'); ?></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span><i class="fa fa-newspaper-o"></i></span>
                                            <span><?php echo lang('News Module'); ?></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span><i class="fa fa-home"></i></span>
                                            <span><?php echo lang('Rooms'); ?></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span><i class="fa fa-money"></i></span>
                                            <span><?php echo $plan['invoices'].' '.lang(' Invoices'); ?></span>
                                        </a>
                                    </li>
                                    <!--                                    <li>-->
                                    <!--                                        <a href="#">-->
                                    <!--                                            <span><i class="fa fa-file-upload"></i></span>-->
                                    <!--                                            <span>-->
                                    <?php //echo lang('No Files'); ?><!--</span>-->
                                    <!--                                        </a>-->
                                    <!--                                    </li>-->
                                </ul>
                            </div>
                            <div class="price_footer">
                                <h3><span class="dlr">$</span> <?php echo $plan['price']; ?><span class="dlr">/mo</span>
                                </h3>
                                <button class="btn btn-purple"><span>Get Started</span></button>
                            </div>
                        </div>
                    </form>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>
