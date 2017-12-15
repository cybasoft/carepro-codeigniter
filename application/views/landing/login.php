<?php

if ($this->ion_auth->logged_in()) {
	redirect('dashboard', 'refresh');
}

$identity = array('name' => 'identity',
				  'id' => 'identity',
				  'type' => 'text',
				  'value' => '',
				  'class' => 'span3',
				  'placeholder' => 'Username/Email',
				  'required'=>'required'
);
$password = array('name' => 'password',
				  'id' => 'password',
				  'type' => 'password',
				  'class' => 'span3',
				  'placeholder' => 'Password',
				  'required'=>'required'
);
?>
<div id="content">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="well well-form txt-lefty">
                    <h3>Sign In</h3>
                    <hr/>
                    <form action="<?php echo site_url('auth/login'); ?>" method="post">
                        <div class="control-group">
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="glyphicons-user"></i></span>
									<?php echo form_input($identity); ?>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="glyphicons-lock"></i></span>
									<?php echo form_input($password); ?>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Sign In</button>

                    </form>
                    <hr/>
					<?php echo anchor('forgot_password','<i class="glyphicons-unlock"></i> Forgot password','class="btn btn-warning"'); ?>

                </div>
            </div>
        </div>
    </div>
</div>