<form action="<?php echo site_url('auth/login'); ?>" id="loginForm" method="post" class="login100-form validate-form">

    <div class="text-center" style="position:absolute;top:0;right:150px">
        <a href="<?php echo site_url(); ?>">
            <img class="logo" src="<?php echo base_url(); ?>assets/uploads/content/<?php echo session('company_logo'); ?>"
                 alt="Logo">
        </a>
    </div>

    <span class="login100-form-title p-b-43"><?php echo lang('Login'); ?></span>

    <?php if(!empty($this->session->flashdata('type'))) : ?>
        <div style="">
            <?php echo $this->session->flashdata('message'); ?>
        </div>
    <?php endif; ?>

    <div class="wrap-input100 validate-input"
         data-validate="<?php echo lang('Valid email is required'); ?>: ex@abc.xyz">
        <?php echo form_input([
            'name' => 'email',
            'type' => 'email',
            'class' => 'input100',
            'required' => 'required'
        ]); ?>
        <span class="focus-input100"></span>
        <span class="label-input100"><?php echo lang('Email'); ?></span>
    </div>


    <div class="wrap-input100 validate-input" data-validate="<?php echo lang('Password is required'); ?>">
        <?php echo form_input([
            'name' => 'password',
            'type' => 'password',
            'class' => 'input100',
            'required' => 'required'
        ]); ?>
        <span class="focus-input100"></span>
        <span class="label-input100"><?php echo lang('Password'); ?></span>
    </div>

    <?php if(session('company_enable_captcha')): ?>
        <div class="flex-sb-m w-full p-t-3 p-b-32">
            <div class="contact100-form-checkbox">
                <?php echo $data['captcha_image']; ?>
            </div>
            <?php if(session('company_allow_reset_password')): ?>
                <div>
                    <?php echo form_input($data['captcha']); ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="flex-sb-m w-full p-t-3 p-b-32">
        <div class="contact100-form-checkbox">

        </div>
        <?php if(session('company_allow_reset_password')): ?>
            <div>
                <?php echo anchor('auth/forgot', '<span class="fa fa-key"></span> '.lang('forgot_password_heading'), ['class' => 'txt1']); ?>
            </div>
        <?php endif; ?>
    </div>


    <div class="container-login100-form-btn">
        <button class="login100-form-btn">
            <?php echo lang('Login'); ?>
        </button>
    </div>

    <?php if(session('company_allow_registration') == TRUE): ?>
        <div class="text-center p-t-46 p-b-20">
            <?php echo anchor('auth/register', '<span class="fa fa-user"></span> '.lang('register'), ['class' => 'txt2']); ?>
        </div>

    <?php endif; ?>

</form>
