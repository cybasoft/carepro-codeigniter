<?php

if ($this->ion_auth->logged_in()) {
    redirect('dashboard', 'refresh');
}

$identity = array('name' => 'identity',
    'id' => 'identity',
    'type' => 'text',
    'value' => '',
    'class' => 'form-control',
    'placeholder' => 'Username/Email',
    'required' => 'required'
);
$password = array('name' => 'password',
    'id' => 'password',
    'type' => 'password',
    'class' => 'form-control',
    'placeholder' => 'Password',
    'required' => 'required'
);
?>

<div class="container" style="margin-top: 45px">

    <div class="row">
        <div class="col-sm-4 col-sm-offset-2">

            <?php
            if(count(validation_errors())):
                echo $this->session->flashdata('message');
            endif;
            ?>

            <div class="well well-form">
                <img style="width:100%" src="<?php echo base_url(); ?>assets/images/logo.png" class="logo">
                <hr/>
                <h3>Login</h3>

                <form action="<?php echo site_url('auth/login'); ?>" method="post">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <span class="add-on"><i class="glyphicon glyphicon-user"></i></span>
                        </div>
                        <?php echo form_input($identity); ?>
                    </div>

                    <br/>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <span class="add-on"><i class="glyphicon glyphicon-lock"></i></span>
                        </div>
                        <?php echo form_input($password); ?>
                    </div>
                    <br/>

                    <button class="btn btn-primary" type="submit">Sign In</button>
                    <?php echo anchor('forgot_password', '<i class="glyphicon glyphicon-link"></i> Forgot password', 'class="" style="float:right"'); ?>
                </form>

                <hr/>
                &copy; <?php echo date('Y'); ?> <a href="http://amdtllc.com" target="_blank">A&M Digital
                    Technologies</a>
            </div>
        </div>
    </div>
</div>
