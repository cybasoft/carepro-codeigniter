<?php
$email = array(
	'name' => 'email',
	'id' => 'email',
	'class' => 'form-control',
	'placeholder' => 'Email address',
	'required'=>'required'
);
?>
<div id="content">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="well well-form txt-lefty">
                    <h3>Reset password</h3>
                    <hr/><?php echo validation_errors('<p class="alert alert-danger">'); ?>
					<?php echo form_open("auth/forgot_password"); ?>
                        <div class="control-group">
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="glyphicons-user"></i></span>
									<?php echo form_input($email); ?>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit"><?php echo lang('submit'); ?></button>

                    <?php echo form_close(); ?>
                    <hr/>
					<?php echo anchor('login','<i class="glyphicons-step_backward"></i> Back','class="btn btn-warning"'); ?>
                </div>
            </div>
        </div>
    </div>
</div>