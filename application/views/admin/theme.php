<div class="card">
    <div class="card-header">
        <h3><?php echo lang('Login background image'); ?>
            <i class="fa fa-question-circle show-tip pull-right" data-toggle="tooltip"
               data-placement="bottom"
               title="<?php echo lang('Login background notice'); ?>"></i>
        </h3>
    </div>
    <div class="card-body">

        <?php
        echo form_open('settings/update', ['class' => 'settings', 'demo' => 1]);
        ?>


        <div class="row">
            <div class="col-sm-6">
                <div class="row">
                    <?php
                    $files = scandir(APPPATH.'../assets/uploads/content/login');
                    $pcount = 1;
                    foreach ($files as $file => $value): if(!in_array($value, [".", ".."])): ?>
                        <div class="col-xs-3">
                            <div class="i-check">
                                <label for="check-<?php echo $pcount; ?>">
                                    <input type="radio" id="check-<?php echo $pcount; ?>" name="login_bg_image"
                                           value="<?php echo $value; ?>"
                                           data-keeper-edited="yes" data-keeper-should-not-overwrite="true">
                                    <div class="front-end i-check-box"
                                         style="background-image:url('<?php echo assets('uploads/content/login/'.$value); ?>')">
                                    </div>
                                </label>
                            </div>
                        </div>
                        <?php $pcount++; endif; endforeach; ?>
                </div>
            </div>
            <div class="col-sm-6">
                <img class="currentLoginImg img-responsive" style="width:100%"
                     src="<?php echo assets('uploads/content/login/'.session('company_login_bg_image', 'login-bg-02.jpg')); ?>"/>
            </div>
        </div>
        <hr/>
        <h3><?php echo lang('Custom CSS'); ?></h3>
        <?php echo form_textarea('custom_css', $option['custom_css'], ['class' => 'form-control code', 'rows' => 6]); ?>

        <?php
        echo '<br/>';
        echo form_button(['type' => 'submit', 'class' => 'btn btn-primary'], lang('Update'));
        echo form_close('demo');
        ?>
    </div>
</div>