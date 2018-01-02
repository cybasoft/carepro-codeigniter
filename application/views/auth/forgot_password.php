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
            <a href="/">
                <img src="<?php echo base_url(); ?>assets/img/<?php echo $this->config->item('logo', 'company'); ?>"
                     alt="Laraspace Logo">
            </a>
        </div>
        <?php
        if (!empty(validation_errors())) :
            echo $this->session->flashdata('message');
        endif;
        ?>
        <?php echo form_open("password/forgot", ['id' => 'loginForm']); ?>
        <div class="form-group">
            <?php echo form_input($email); ?>
        </div>
        <button class="btn btn-theme btn-full"><?php echo lang('submit'); ?></button>
        <div class="other-actions row">
            <div class="col-6">
                <?php echo anchor('login', '<span class="fa fa-key"></span> '.lang('login')); ?>
            </div>
        </div>
        <?php echo form_close(); ?>
        <div class="page-copyright">
            <p><?php echo lang('copyright'); ?></p>
        </div>
    </div>
</div>