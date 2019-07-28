<?php echo form_open("forgot", ['id' => 'loginForm', 'class' => 'login100-form validate-form']); ?>
<div class="text-center" style="position:absolute;top:0;right:150px">
    <a href="<?php echo site_url(); ?>">        
        <img class="logo" src="<?php echo base_url(); ?>assets/uploads/content/logo.png" alt="Logo">        
    </a>
</div>


<span class="login100-form-title p-b-43"><?php echo lang('reset_password_heading'); ?></span>
<?php if (!empty($this->session->flashdata('type'))) : ?>
    <div style="">
        <?php echo $this->session->flashdata('message'); ?>
    </div>
<?php endif; ?>

<div class="wrap-input100 validate-input" data-validate="<?php echo lang('Valid email is required'); ?>: ex@abc.xyz">
    <?php echo form_input(
        [
            'name' => 'email',
            'id' => 'email',
            'class' => 'input100',
            'required' => 'required'
        ]
    ); ?>
    <span class="focus-input100"></span>
    <span class="label-input100"><?php echo lang('Email'); ?></span>
</div>

<div class="container-login100-form-btn">
    <button class="login100-form-btn">
        <?php echo lang('reset_password_submit_btn'); ?>
    </button>
</div>
<div class="text-center p-t-46 p-b-20">
    <?php echo anchor('login', '<span class="fa fa-user"></span> ' . lang('Login'), ['class' => 'txt2']); ?>
</div>


<?php echo form_close(); ?>