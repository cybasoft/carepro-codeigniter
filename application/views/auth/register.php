<?php
if ($this->ion_auth->logged_in()) {
    redirect('dashboard', 'refresh');
}

?>
<div id="app" class="login-wrapper">
    <div class="login-box  animation flipInX">
        <div class="logo-main">
            <a href="<?php echo site_url(); ?>">
                <img src="<?php echo base_url(); ?>assets/img/<?php echo $this->config->item('logo', 'company'); ?>"
                     alt="Laraspace Logo">
            </a>
        </div>
        <h3 class="text-center">
            <?php echo lang('register_form_header'); ?>
        </h3>

        <div class="text-center">
            <?php echo lang('register_form_notice'); ?>
        </div>
        <?php echo form_open('auth/register', ['id' => 'loginForm']); ?>
        <div class="form-group">
            <?php echo form_input($data['email']); ?>
        </div>
        <div class="form-group">
            <?php echo form_input($data['password']); ?>
        </div>
        <div class="form-group">
            <?php echo form_input($data['password_confirm']); ?>
        </div>
        <div class="form-group">
            <?php echo form_input($data['first_name']); ?>
        </div>
        <div class="form-group">
            <?php echo form_input($data['last_name']); ?>
        </div>
        <div class="form-group">
            <?php echo form_textarea($data['address']); ?>
        </div>
        <div class="form-group">
            <?php echo form_input($data['phone']); ?>
        </div>

        <?php if (config_item('enable_captcha')): ?>
            <div class="form-group">
                <?php echo $data['captcha_image']; ?>
                <?php echo form_input($data['captcha']); ?>
            </div>
        <?php endif; ?>

        <button class="btn btn-theme btn-full"><?php echo lang('register'); ?></button>
        <div class="other-actions" style="text-align:center">

            <?php if (config_item('allow_registration') == TRUE): ?>
                <?php echo anchor('login', '<span class="fa fa-user"></span> ' . lang('login')); ?>
            <?php endif; ?>
        </div>
        <?php echo form_close(); ?>
        <div class="page-copyright">
            <p><?php echo lang('powered by'); ?> <?php echo lang('copyright'); ?></p>
        </div>
    </div>
</div>