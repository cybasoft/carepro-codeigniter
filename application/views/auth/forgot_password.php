<?php
$email = array(
    'name' => 'email',
    'id' => 'email',
    'class' => 'form-control',
    'placeholder' => 'Email address',
    'required' => 'required'
);
?>
<div class="container" style="margin-top: 45px">

        <div class="row">
            <div class="col-sm-4 col-sm-offset-2">

                <?php
                if (count(validation_errors())) :
                    echo $this->session->flashdata('message');
                endif;
                ?>
                <div class="well well-form">
                    <img style="width: 100%;" src="<?php echo base_url(); ?>assets/img/logo.png" class="logo">
                    <hr/>
                    <h3>Reset password</h3>
                    <?php echo form_open("auth/forgot_password"); ?>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <?php echo form_input($email); ?>
                        <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit"><?php echo lang('submit'); ?></button>
                        </span>
                    </div>
                    <br/>
                    <?php echo anchor('login', '<i class="glyphicon glyphicon-link"></i>login', 'style="float:right"'); ?>
                    <?php echo form_close(); ?>
                    <hr/>
                    &copy; <?php echo date('Y'); ?> <?php echo $this->config->item('copyright'); ?>
                </div>
            </div>
        </div>
    </div>
