<?php echo form_open('auth/reset/'.$code, ['id' => 'loginForm', 'class' => 'login100-form validate-form']); ?>
    <div class="text-center" style="position:absolute;top:0;right:150px">
        <a href="<?php echo site_url(); ?>">
            <img class="logo" src="<?php echo base_url(); ?>assets/uploads/content/<?php echo session('company_logo'); ?>"
                 alt="Logo">
        </a>
    </div>


    <span class="login100-form-title p-b-43"><?php echo lang('reset_password_heading'); ?></span>

    <div class="wrap-input100 validate-input" data-validate="<?php echo lang('This field is required'); ?>">
        <?php echo form_input([
            'name' => 'new',
            'id' => 'new',
            'type' => 'password',
            'class' => 'input100',
            'required' => 'required',
            'pattern' => '^.{8}.*$'
        ]); ?>
        <span class="focus-input100"></span>
        <span class="label-input100"><?php echo lang('reset_password_new_password_label'); ?></span>
    </div>

    <div class="wrap-input100 validate-input" data-validate="<?php echo lang('This field is required'); ?>">
    <?php echo form_input([
            'name' => 'new_confirm',
            'type' => 'password',
            'class' => 'input100',
            'id' => 'new_confirm',
            'required' => 'required',
            'pattern' => '^.{8}.*$'
        ]); ?>

        <span class="focus-input100"></span>
        <span class="label-input100"><?php echo lang('reset_password_new_password_confirm_label'); ?></span>
    </div>

<?php echo form_input($user_id); ?>
<?php echo form_hidden($csrf); ?>

    <div class="container-login100-form-btn">
        <button class="login100-form-btn">
            <?php echo lang('reset_password_submit_btn'); ?>
        </button>
    </div>

<?php if(session('company_allow_registration') == TRUE): ?>
    <div class="text-center p-t-46 p-b-20">
        <?php echo anchor('auth/login', '<span class="fa fa-user"></span> '.lang('Login'), ['class' => 'txt2']); ?>
    </div>

<?php endif; ?>

<?php echo form_close(); ?>