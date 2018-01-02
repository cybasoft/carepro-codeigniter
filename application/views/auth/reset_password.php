<div id="app" class="login-wrapper">
    <div class="login-box  animation flipInX">
        <div class="logo-main">
            <a href="/">
                <img src="<?php echo base_url(); ?>assets/img/<?php echo $this->config->item('logo', 'company'); ?>"
                     alt="Laraspace Logo">
            </a>
        </div>

        <h3 class="text-center"><?php echo lang('reset_password_heading'); ?></h3>
        <hr/>
        <?php echo form_open('password/reset/' . $code, ['id' => 'loginForm']); ?>
        <div class="form-group">
            <?php echo sprintf(lang('reset_password_new_password_label'), $min_password_length); ?>
            <?php echo form_input($new_password); ?>
        </div>
        <div class="form-group">
            <?php echo lang('reset_password_new_password_confirm_label', 'new_password_confirm'); ?>
            <?php echo form_input($new_password_confirm); ?>
        </div>
        <div class="form-group">
            <?php echo form_input($user_id); ?>
            <?php echo form_hidden($csrf); ?>
        </div>

        <button class="btn btn-theme btn-full">
            <?php echo lang('reset_password_submit_btn'); ?>
        </button>
        <div class="other-actions row">
            <div class="col-6">
                <?php echo anchor('login', '<span class="fa fa-key"></span> ' . lang('login')); ?>
            </div>
        </div>
        <?php echo form_close(); ?>
        <div class="page-copyright">
            <p><?php echo lang('copyright'); ?></p>
        </div>
    </div>
</div>
