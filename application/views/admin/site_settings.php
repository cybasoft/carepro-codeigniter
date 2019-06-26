<div class="card">
    <div class="card-header">
        <div class="card-title">
            <?php echo lang('settings'); ?>
        </div>
    </div>
    <div class="card-body">
        <?php echo form_open('settings/update', ['class' => 'settings', 'demo' => 1]); ?>
        <div class="row">
            <div class="col-md-6">
                <?php
                echo form_label(lang('name'));
                echo form_input('name', $option['name'], ['class' => 'form-control', 'required' => 'required']);
                echo form_label(lang('slogan'));
                echo form_input('slogan', $option['slogan'], ['class' => 'form-control', 'required' => 'required']);
                echo form_label(lang('Facility ID'), 'facility_id');
                echo form_input('facility_id', $option['facility_id'], ['class' => 'form-control']);
                echo form_label(lang('Tax ID'), 'facility_id');
                echo form_input('tax_id', $option['tax_id'], ['class' => 'form-control']);
                echo form_label(lang('Daycare ID'));
                echo form_input('daycare_id', "", ['class' => 'form-control','readonly'=>'true']);
                echo "<hr/>";
                echo form_label(lang('email'));
                echo form_input('email', $option['email'], ['class' => 'form-control', 'required' => 'required']);
                echo form_label(lang('phone'));
                echo form_input('phone', $option['phone'], ['class' => 'form-control', 'required' => 'required']);
                echo form_label(lang('fax'));
                echo form_input('fax', $option['fax'], ['class' => 'form-control']);
                echo form_label(lang('street'));
                echo form_input('street', $option['street'], ['class' => 'form-control', 'required' => 'required']);
                echo "<br/>";
                echo form_label(lang('street2'));
                echo form_input('street2', $option['street2'], ['class' => 'form-control']);
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <?php
                        echo form_label(lang('city'));
                        echo form_input('city', $option['city'], ['class' => 'form-control', 'required' => 'required']);
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?php
                        echo form_label(lang('state'));
                        echo form_input('state', $option['state'], ['class' => 'form-control', 'required' => 'required']);
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?php
                        echo form_label(lang('postal_code'));
                        echo form_input('postal_code', $option['postal_code'], ['class' => 'form-control', 'required' => 'required']);
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?php
                        echo form_label(lang('country'));
                        echo form_input('country', $option['country'], ['class' => 'form-control', 'required' => 'required']);
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <?php
                echo form_label(lang('timezone'));
                echo form_input('timezone', $option['timezone'], ['class' => 'form-control', 'required' => 'required']);
                echo form_label(lang('google_analytics'));
                echo form_input('google_analytics', $option['google_analytics'], ['class' => 'form-control']);
                echo form_label(lang('date_format'));
                echo form_input('date_format', $option['date_format'], ['class' => 'form-control', 'required' => 'required']);
                // echo form_label(lang('Lockscreen timer (mins)'));
                // echo form_input(['type' => 'number', 'step' => 'any', 'name' => 'lockscreen_timer'], $option['lockscreen_timer'], ['class' => 'form-control']);
                echo form_label(lang('Business hours'), 'hours_start');

                ?>
                <div class="row">
                    <div class="col-sm-6">
                        <?php
                        echo form_label('Start time');
                        echo form_time('hours_start', $option['hours_start'], ['class' => 'form-control']);
                        ?>
                    </div>
                    <div class="col-sm-6">
                        <?php
                        echo form_label('End time');
                        echo form_time('hours_end', $option['hours_end'], ['class' => 'form-control']);
                        ?>
                    </div>
                </div>
                <hr/>
                <!-- <div class="row">
                    <div class="col-md-1">
                        <?php echo form_hidden('daily_checkin', 0); ?>
                        <?php echo form_checkbox('daily_checkin', 1, $option['daily_checkin']); ?>
                    </div>
                    <div class="col-md-10"><?php echo lang('Restrict to daily checkin'); ?>
                        <i class="fa fa-question-circle text-warning show-tip"
                           data-toggle="tooltip"
                           title="<?php echo lang('Uncheck to calculate time accross days instead of just daily'); ?>"></i>
                    </div>
                </div> -->
                <!-- <div class="row">
                    <div class="col-md-1">
                        <?php echo form_hidden('allow_registration', 0); ?>
                        <?php echo form_checkbox('allow_registration', 1, $option['allow_registration']); ?>
                    </div>
                    <div class="col-md-10"><?php echo lang('Allow registration'); ?></div>
                </div>
                <div class="row">
                    <div class="col-md-1">
                        <?php echo form_hidden('allow_reset_password', 0); ?>
                        <?php echo form_checkbox('allow_reset_password', 1, $option['allow_reset_password']); ?>
                    </div>
                    <div class="col-md-10"><?php echo lang('Allow resetting password'); ?></div>
                </div> -->
                <!-- <div class="row">
                    <div class="col-md-1">
                        <?php echo form_hidden('enable_captcha', 0); ?>
                        <?php echo form_checkbox('enable_captcha', 1, $option['enable_captcha']); ?>
                    </div>
                    <div class="col-md-10"><?php echo lang('Enable captcha'); ?></div>
                </div>
                <div class="row">
                    <div class="col-md-1">
                        <?php echo form_hidden('demo_mode', 0); ?>
                        <?php echo form_checkbox('demo_mode', 1, $option['demo_mode']); ?>
                    </div>
                    <div class="col-md-10"><?php echo lang('Demo mode'); ?></div>
                </div> -->
                <!-- <div class="row">
                    <div class="col-md-1">
                        <?php echo form_hidden('maintenance_mode', 0); ?>
                        <?php echo form_checkbox('maintenance_mode', 1, $option['maintenance_mode']); ?>
                    </div>
                    <div class="col-md-10"><?php echo lang('Maintenance mode'); ?></div>
                </div> -->
                <!-- <div class="row">
                    <div class="col-md-1">
                        <?php echo form_hidden('use_smtp', 0); ?>
                        <?php echo form_checkbox('use_smtp', 1, $option['use_smtp']); ?>
                    </div>
                    <div class="col-md-10"><?php echo lang('Use SMTP'); ?>
                        <a class="cursor"
                           onclick="document.querySelector('.smtp-settings').classList.toggle('hidden');">
                            <?php echo lang('Update SMTP settings'); ?>
                        </a>
                        <div class="smtp-settings hidden">
                            <hr/>
                            <?php
                            if(session('company_demo_mode') == 0) {
                                echo form_label(lang('smtp_host'));
                                echo form_input('smtp_host', $option['smtp_host'], ['class' => 'form-control']);

                                echo form_label(lang('smtp_user'));
                                echo form_input('smtp_user', $option['smtp_user'], ['class' => 'form-control']);

                                echo form_label(lang('smtp_pass'));
                                echo form_password('smtp_pass', $option['smtp_pass'], ['class' => 'form-control']);

                                echo form_label(lang('smtp_port'));
                                echo form_input('smtp_port', $option['smtp_port'], ['class' => 'form-control']);
                            } else {
                                echo '<div class="alert alert-danger">'.lang('feature_disabled_in_demo').'</div>';
                            }
                            ?>
                        </div>

                    </div>
                </div> -->
                <hr/>
                <button class="btn btn-default"><?php echo lang('update'); ?></button>

            </div>
        </div>
        <hr/>

        <?php echo form_close('demo'); ?>
    </div>
</div>