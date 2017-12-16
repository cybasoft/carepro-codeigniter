<?php
if ($this->ion_auth->logged_in()) {
    redirect('dashboard', 'refresh');
}

$identity = array(
    'name' => 'identity',
    'id' => 'identity',
    'type' => 'text',
    'value' => '',
    'class' => 'form-control form-control-danger',
    'placeholder' => lang('enter_email'),
    'required' => 'required'
);
$password = array(
    'name' => 'password',
    'id' => 'password',
    'type' => 'password',
    'class' => 'form-control form-control-danger',
    'placeholder' => lang('password'),
    'required' => 'required'
);
?>
<div id="app" class="login-wrapper">
    <div class="login-box  animation flipInX">
        <div class="logo-main">
            <a href="/">
                <img src="<?php echo base_url(); ?>assets/img/<?php echo $this->config->item('logo', 'company'); ?>"
                     alt="Laraspace Logo">
            </a>
        </div>
        <?php
        if (count(validation_errors())) :
            echo $this->session->flashdata('message');
        endif;
        ?>
        <form action="<?php echo site_url('auth/login'); ?>" id="loginForm" method="post">
            <div class="form-group">
                <?php echo form_input($identity); ?>
            </div>
            <div class="form-group">
                <?php echo form_input($password); ?>
            </div>
            <button class="btn btn-theme btn-full"><?php echo lang('login'); ?></button>
            <div class="other-actions row">
                <div class="col-6">
                    <?php echo anchor('forgot_password', '<span class="fa fa-link-intact"></span> '.lang('forgot_password_heading')); ?>
                </div>
            </div>
        </form>
        <div class="page-copyright">
            <p><?php echo lang('copyright'); ?></p>
        </div>
    </div>
</div>