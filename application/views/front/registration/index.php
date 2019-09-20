<?php $this->load->view("front/header"); ?>

<div class="loading_div">
</div>
<div class="section-empty section-item">
    <div class="container content">
        <div class="row">
            <div class="col-sm-6 offset-sm-3 card">
                <div class="text-center">
                    <h2 style="padding-bottom:15px;">Register</h2>
                </div>
                <?php if(!empty($this->session->flashdata('verify_email_error'))) : ?>
                    <div class="alert alert-danger alert-dismissable">
                        <?php echo $this->session->flashdata('verify_email_error'); ?>
                    </div>
                <?php endif; ?>
                <?php echo form_open('user/create', ['class' => 'form-box user_register']); ?>
                <div class="row">
                    <div class="col-sm-12">
                        <p>Name *</p>
                        <input class="form-control form-value" placeholder="Your name" required="" name="name" type="text"
                               value="<?php echo set_value('name'); ?>">
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-sm-12">
                        <p>E-Mail Address *</p>
                        <input name="email" type="email" placeholder="Your email" class="form-control form-value" required=""
                               value="<?php echo set_value('email'); ?>">
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-sm-6">
                        <p>Password *</p>
                        <input required="" name="password" type="password" placeholder="Password" class="form-control form-value" value="">
                    </div>
                    <div class="col-sm-6">
                        <p>Confirm Password *</p>
                        <input type="password" required="" name="password_confirm" placeholder="Confirm password" class="form-control form-value"
                               value="">
                    </div>
                </div>

                <hr class="space xs"/>
                <button class="btn-sm btn-purple" type="submit" id="user_register">Register</button>
                <a href="../auth/login" style="float:right;margin-top:14px">Already have an account?</a>
                <?php echo form_close(); ?>
                <p style="padding-top: 40px;" class="text-center">By registering your account, you agree to the <a
                            href="https://stripe.com/us/connect-account/legal" class="btn-text stripe_connect"
                            target="_blank">Terms and condition</a>.</p>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('front/footer'); ?>
<script src="<?php echo base_url(); ?>assets/js/user_register/script.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/extras/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/daycare.js"></script>
<script>
    $(document).ready(function () {
        $('.user_register').submit(function (e) {
            e.target.checkValidity();
            $('.loading_div').show();
        });
    });
</script>