<section class="section_gap big_features" id="contact">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <div class="main_title">
                    <p class="top_title">We would <i class="fa fa-heart text-danger"></i> to hear from you</p>
                    <h2>Contact us</h2>
                    <p></p>
                </div>
            </div>
        </div>
        <div class="row features_content">
            <div class="col-lg-4 offset-lg-1">
                <div class="big_f_left">
                    <img class="img-fluid" src="/assets/frontend/img/contact.png" alt="">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="contact_info">
                                <div class="info_item">
                                    <i class="lnr lnr-home"></i>
                                    <h6><?php echo config('company', [
                                            'city',
                                            'state',
                                        ], ','); ?></h6>
                                    <p><?php echo config('company', 'country'); ?></p>
                                </div>
                                <div class="info_item">
                                    <i class="lnr lnr-phone-handset"></i>
                                    <h6><?php echo config('company', 'phone'); ?></h6>
                                    <p></p>
                                </div>
                                <div class="info_item">
                                    <i class="lnr lnr-envelope"></i>
                                    <h6><?php echo config('company', 'email'); ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-2">
                <div class="common_style">
                    <form method="post" class="contact_form" id="contactForm" action="/contact">
                        <div>
                            <label>Name</label>
                            <input type="text" class="form-control" required name="name" placeholder="Your name"/>
                        </div>
                        <div class="mt-2">
                           <div class="row">
                               <div class="col-sm-6">
                                   <label>Email</label>
                                   <input type="email" name="email" class="form-control" required placeholder="Your email"/>
                               </div>
                               <div class="col-sm-6">
                                   <label>Phone</label>
                                   <input type="number" name="phone" class="form-control" required placeholder="Your Phone"/>
                               </div>
                           </div>
                        </div>
                        <div class="mt-2">
                            <label>Message</label>
                            <textarea name="message" class="form-control" placeholder="Your message"
                                      required></textarea>
                        </div>

                        <div class="row col-4 mt-2">
                            <label>Captcha</label>
                            <input type="hidden" id="captcha_valid" value="11" name="captcha_valid"/>
                            <input type="number" name="captcha" class="form-control" required placeholder="9+2=?"/>
                        </div>
                        <br/>
                        <button class="primary_btn">Send</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>