<ul class="nav nav-pills nav-stacked col-md-2">
    <li class="active"><a href="#settings" data-toggle="pill"><i class="fa fa-cogs"></i>
            <?php echo lang('settings'); ?></a></li>
    <li><a href="#paymentMethods" data-toggle="tab"><i class="fa fa-credit-card"></i>
            <?php echo lang('payment_method'); ?></a></li>
    <li><a href="#logo" data-toggle="tab"><i class="fa fa-circle-notch"></i>
            <?php echo lang('logo'); ?></a></li>
    <li><a href="#theme" data-toggle="tab"><i class="fa fa-th"></i>
            <?php echo lang('theme'); ?></a></li>
    <li><a href="#support" data-toggle="tab"><i class="fa fa-hands-helping"></i>
            <?php echo lang('support'); ?>
        </a></li>
</ul>

<div class="tab-content col-md-10">
    <div class="tab-pane active" id="settings">
        <h3><?php echo lang('settings'); ?></h3>
        <?php echo form_open('settings/update'); ?>
        <div class="row">
            <div class="col-md-6">
                <?php
                echo form_hidden('page','settings');
                echo form_label(lang('company_name'));
                echo form_input('company_name', get_option('company_name'), ['class' => 'form-control', 'required' => 'required']);
                echo form_label(lang('slogan'));
                echo form_input('slogan', get_option('slogan'), ['class' => 'form_control', 'required' => 'required']);
                echo "<br/>";
                echo form_label(lang('email'));
                echo form_input('email', get_option('email'), ['class' => 'form_control', 'required' => 'required']);
                echo form_label(lang('phone'));
                echo form_input('phone', get_option('phone'), ['class' => 'form_control', 'required' => 'required']);
                echo form_label(lang('fax'));
                echo form_input('fax', get_option('fax'), ['class' => 'form_control']);
                echo form_label(lang('street'));
                echo form_input('street', get_option('street'), ['class' => 'form_control', 'required' => 'required']);
                echo "<br/>";
                echo form_label(lang('street2'));
                echo form_input('street2', get_option('street2'), ['class' => 'form_control']);
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <?php
                        echo form_label(lang('city'));
                        echo form_input('city', get_option('city'), ['class' => 'form_control', 'required' => 'required']);
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?php
                        echo form_label(lang('state'));
                        echo form_input('state', get_option('state'), ['class' => 'form_control', 'required' => 'required']);
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?php
                        echo form_label(lang('postal_code'));
                        echo form_input('postal_code', get_option('postal_code'), ['class' => 'form_control', 'required' => 'required']);
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?php
                        echo form_label(lang('country'));
                        echo form_input('country', get_option('country'), ['class' => 'form_control', 'required' => 'required']);
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <?php
                echo form_label(lang('timezone'));
                echo form_input('timezone', get_option('timezone'), ['class' => 'form_control', 'required' => 'required']);

                echo form_label(lang('google_analytics'));
                echo form_input('google_analytics', get_option('google_analytics'), ['class' => 'form_control']);

                echo form_label(lang('currency_abbreviation'));
                echo form_input('currency_abbreviation', get_option('currency_abbreviation'), ['class' => 'form_control', 'required' => 'required']);
                echo form_label(lang('currency_symbol'));
                echo form_input('currency_symbol', get_option('currency_symbol'), ['class' => 'form_control', 'required' => 'required']);

                echo form_label(lang('date_format'));
                echo form_input('date_format', get_option('date_format'), ['class' => 'form_control', 'required' => 'required']);
                ?>
                <hr/>
                <div class="row">
                    <div class="col-md-1">
                        <?php echo form_hidden('allow_registration', 0); ?>
                        <?php echo form_checkbox('allow_registration', 1, get_option('allow_registration')); ?>
                    </div>
                    <div class="col-md-10"><?php echo lang('Allow registration'); ?></div>
                </div>
                <div class="row">
                    <div class="col-md-1">
                        <?php echo form_hidden('allow_reset_password', 0); ?>
                        <?php echo form_checkbox('allow_reset_password', 1, get_option('allow_reset_password')); ?>
                    </div>
                    <div class="col-md-10"><?php echo lang('Allow resetting password'); ?></div>
                </div>
                <div class="row">
                    <div class="col-md-1">
                        <?php echo form_hidden('enable_captcha', 0); ?>
                        <?php echo form_checkbox('enable_captcha', 1, get_option('enable_captcha')); ?>
                    </div>
                    <div class="col-md-10"><?php echo lang('Enable captcha'); ?></div>
                </div>
                <div class="row">
                    <div class="col-md-1">
                        <?php echo form_hidden('demo_mode', 0); ?>
                        <?php echo form_checkbox('demo_mode', 1, get_option('demo_mode')); ?>
                    </div>
                    <div class="col-md-10"><?php echo lang('Demo mode'); ?></div>
                </div>
                <div class="row">
                    <div class="col-md-1">
                        <?php echo form_hidden('maintenance_mode', 0); ?>
                        <?php echo form_checkbox('maintenance_mode', 1, get_option('maintenance_mode')); ?>
                    </div>
                    <div class="col-md-10"><?php echo lang('Maintenance mode'); ?></div>
                </div>
                <div class="row">
                    <div class="col-md-1">
                        <?php echo form_hidden('use_smtp', 0); ?>
                        <?php echo form_checkbox('use_smtp', 1, get_option('use_smtp')); ?>
                    </div>
                    <div class="col-md-10"><?php echo lang('Use SMTP'); ?>
                        <a class="cursor"
                           onclick="document.querySelector('.smtp-settings').classList.toggle('hidden');">
                            <?php echo lang('Update SMTP settings'); ?>
                        </a>
                        <div class="smtp-settings hidden">
                            <hr/>
                            <?php
                            echo form_label(lang('smtp_host'));
                            echo form_input('smtp_host', get_option('smtp_host'), ['class' => 'form_control']);

                            echo form_label(lang('smtp_user'));
                            echo form_input('smtp_user', get_option('smtp_user'), ['class' => 'form_control']);

                            echo form_label(lang('smtp_pass'));
                            echo form_password('smtp_pass', get_option('smtp_pass'), ['class' => 'form_control']);

                            echo form_label(lang('smtp_port'));
                            echo form_input('smtp_port', get_option('smtp_port'), ['class' => 'form_control']);
                            ?>
                        </div>

                    </div>
                </div>
                <hr/>
                <button class="btn btn-default"><?php echo lang('update'); ?></button>

            </div>
        </div>
        <hr/>

        <?php echo form_close(); ?>
    </div>
    <div class="tab-pane" id="paymentMethods">
        <h3><?php echo lang('payment_method'); ?></h3>
        <?php echo lang('Add a payment method'); ?>
        <div class="row">
            <div class="col-sm-6">
                <?php echo form_open('settings/paymentMethods'); ?>
                <div class="input-group">
                    <input type="text" name="title" class="form-control" required/>
                    <span class="input-group-btn">
                        <button class="btn btn-primary"><i class="fa fa-plus"></i>
                            <?php echo lang('add'); ?></button>
                    </span>
                </div>
                <?php echo form_close(); ?>
                <br/>
                <table class="table table-bordered">
                    <?php foreach ($payMethods as $payMethod): ?>
                        <tr>
                            <td>
                                <?php echo $payMethod->title; ?>
                            </td>
                            <td>
                                <a class="delete"
                                   href="<?php echo site_url('settings/deletePaymentMethod/'.$payMethod->id); ?>">
                                    <i class="fa fa-trash-alt text-danger"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
    <div class="tab-pane" id="logo">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-body">
                        <h3><?php echo lang('company_logo'); ?></h3>
                        <?php if(is_file(APPPATH.'../assets/img/'.get_option('logo'))): ?>
                            <img src="<?php echo base_url().'assets/img/'.get_option('logo'); ?>"/>
                        <?php endif; ?>
                        <hr/>
                        <div class="alert alert-warning">
                            <?php echo lang('logo_instructions'); ?>
                        </div>

                        <?php echo form_open_multipart('settings/upload_logo', 'class="input-group"'); ?>
                        <input class="form-control" type="file" required name="logo"/>
                        <span class="input-group-btn"><button
                                    class="btn btn-default"><?php echo lang('update'); ?></button></span>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-body">
                        <h3><?php echo lang('invoice logo'); ?></h3>
                        <?php if(is_file(APPPATH.'../assets/img/'.get_option('invoice_logo'))): ?>
                            <img src="<?php echo base_url().'assets/img/'.get_option('invoice_logo'); ?>"/>
                        <?php endif; ?>
                        <hr/>
                        <?php echo form_open_multipart('settings/upload_invoice_logo', 'class="input-group"'); ?>
                        <input class="form-control" type="file" required name="invoice_logo"/>
                        <span class="input-group-btn"><button
                                    class="btn btn-default"><?php echo lang('update'); ?></button></span>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="tab-pane" id="theme">
        <?php echo form_open('settings/update'); ?>
        <div class="row">
            <div class="col-md-4">
                <?php
                echo form_hidden('page','theme');
                echo form_label(lang('Top navigation background color'));
                echo form_input('top_nav_bg_color', get_option('top_nav_bg_color'), ['class' => 'form_control']);
                ?>
            </div>
            <div class="col-md-4">
                <?php
                echo form_label(lang('Left sidebar color'));
                echo form_input('left_sidebar_color', get_option('left_sidebar_color'), ['class' => 'form_control']);
                ?>
            </div>
            <div class="col-md-4">

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                echo form_label(lang('Custom CSS'));
                echo form_textarea('custom_css', get_option('custom_css'), ['class' => 'form-control code'])
                ?>
            </div>
        </div>
        <br/>
        <button class="btn btn-default"><?php echo lang('update'); ?></button>
        <?php
        echo form_close();
        ?>
    </div>
    <div class="tab-pane" id="support">
        <h3><?php echo lang('support'); ?></h3>
        <ul>
            <li><a href="https://github.com/amdtllc/daycarepro/wiki">Wiki</a></li>
            <li><a href="https://amdtcllc.com/support">Support tickets</a></li>
            <li><a href="https://github.com/amdtllc/daycarepro/wiki/Change-log">Change log</a></li>
            <li><a href="https://github.com/amdtllc/daycarepro/wiki/Configuration">Configuration</a></li>
            <li><a href="https://github.com/amdtllc/daycarepro/issues">Known issues</a></li>
            <li><a href="https://github.com/amdtllc/daycarepro/wiki/Licenses">Licenses</a></li>
        </ul>
        <div class="callout callout-info">
            <h3>Thank you for supporting this project!</h3>
            <p>Your donation helps us keep working on this script and make it available at a
                very affordable price and provide free support</p>
            <form action="https://www.paypal.com/cgi-bin/webscr" target="_blank" method="post">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="hosted_button_id" value="Q3N6CNB3RRJBJ">
                <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0"
                       name="submit" alt="PayPal - The safer, easier way to pay online!">
                <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
            </form>
        </div>

    </div>
</div><!-- tab content -->

<script>

</script>