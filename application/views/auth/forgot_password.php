<?php
$email = array(
    'name' => 'email',
    'id' => 'email',
    'class' => 'form-control',
    'placeholder' => lang('email'),
    'required' => 'required'
);
?>

<div id="app" class="login-wrapper">
    <div class="login-box  animation flipInX">
        <div class="logo-main">
            <a href="<?php echo site_url(); ?>">
                <img src="<?php echo base_url(); ?>assets/uploads/content/<?php echo get_option('logo'); ?>" alt="Logo">
            </a>
        </div>
        <?php echo form_open("auth/forgot", ['id' => 'loginForm']); ?>
        <div class="form-group">
            <?php echo form_input($email); ?>
        </div>
        <button class="btn btn-theme btn-full"><?php echo lang('submit'); ?></button>
        <div class="other-actions row">
            <div class="col-6">
                <?php echo anchor('auth/login', '<span class="fa fa-key"></span> '.lang('login')); ?>
            </div>
        </div>
        <?php echo form_close(); ?>
        <div class="page-copyright">
            <p><?php echo lang('powered by'); ?> <?php echo lang('copyright'); ?></p>
        </div>
    </div>
</div>