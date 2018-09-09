<ul class="nav nav-pills nav-stacked col-md-2 col-xs-2 col-sm-2">
    <li class="active"><a href="#home" data-toggle="tab"><i class="fa fa-cogs"></i>
            <span class="hidden-xs hidden-sm"><?php echo lang('settings'); ?></span>
        </a>
    </li>
    <li>
        <a href="#billing" data-toggle="tab"><i class="fa fa-credit-card"></i>
            <span class="hidden-xs hidden-sm"><?php echo lang('billing'); ?></span>
        </a>
    </li>
    <li>
        <a href="#logo" data-toggle="tab"><i class="fa fa-circle-notch"></i>
            <span class="hidden-xs hidden-sm"><?php echo lang('logo'); ?></span>
        </a>
    </li>
    <li>
        <a href="#theme" data-toggle="tab"><i class="fa fa-th"></i>
            <span class="hidden-xs hidden-sm"><?php echo lang('theme'); ?></span>
        </a>
    </li>
    <li>
        <a href="#integrations" data-toggle="tab"><i class="fa fa-link"></i>
            <span class="hidden-xs hidden-sm"><?php echo lang('Integrations'); ?></span>
        </a>
    </li>
    <li>
        <a href="#backup" data-toggle="tab"><i class="fa fa-database"></i>
            <span class="hidden-xs hidden-sm"><?php echo lang('Backup'); ?></span>
        </a>
    </li>
    <li>
        <a href="#support" data-toggle="tab"><i class="fa fa-hands-helping"></i>
            <span class="hidden-xs hidden-sm"><?php echo lang('support'); ?></span>
        </a>
    </li>

</ul>

<div class="tab-content col-md-10 col-xs-10 col-sm-10">

    <div class="tab-pane active" id="home">
        <h3><?php echo lang('settings'); ?></h3>
        <hr/>
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
                echo form_label(lang('Lockscreen timer (mins)'));
                echo form_input(['type' => 'number', 'step' => 'any', 'name' => 'lockscreen_timer'], $option['lockscreen_timer'], ['class' => 'form-control']);
                ?>
                <hr/>
                <div class="row">
                    <div class="col-md-1">
                        <?php echo form_hidden('daily_checkin', 0); ?>
                        <?php echo form_checkbox('daily_checkin', 1, $option['daily_checkin']); ?>
                    </div>
                    <div class="col-md-10"><?php echo lang('Restrict to daily checkin'); ?>
                        <i class="fa fa-question-circle text-warning show-tip"
                           data-toggle="tooltip"
                           title="<?php echo lang('Uncheck to calculate time accross days instead of just daily'); ?>"></i>
                    </div>
                </div>
                <div class="row">
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
                </div>
                <div class="row">
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
                </div>
                <div class="row">
                    <div class="col-md-1">
                        <?php echo form_hidden('maintenance_mode', 0); ?>
                        <?php echo form_checkbox('maintenance_mode', 1, $option['maintenance_mode']); ?>
                    </div>
                    <div class="col-md-10"><?php echo lang('Maintenance mode'); ?></div>
                </div>
                <div class="row">
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
                            if(session('demo_mode') == 0) {
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
                </div>
                <hr/>
                <button class="btn btn-default"><?php echo lang('update'); ?></button>

            </div>
        </div>
        <hr/>

        <?php echo form_close('demo'); ?>
    </div>
    <div class="tab-pane" id="billing">
        <h3><?php echo lang('billing'); ?></h3>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                <div class="box box-default box-solid">
                    <div class="box-header">
                        <h4 class="box-title">
                            <?php echo lang('Currency'); ?>
                        </h4>
                    </div>
                    <div class="box-body">
                        <?php
                        echo form_open('settings/update', ['class' => 'settings', 'demo' => 1]);
                        echo form_label(lang('currency_abbreviation'));
                        echo form_input('currency_abbreviation', $option['currency_abbreviation'], ['class' => 'form-control', 'required' => 'required']);
                        echo form_label(lang('currency_symbol'));
                        echo form_input('currency_symbol', $option['currency_symbol'], ['class' => 'form-control', 'required' => 'required']);
                        echo '<br/>';
                        echo form_button(['type' => 'submit', 'class' => 'btn btn-primary'], lang('Update'));
                        echo form_close('demo');
                        ?>
                    </div>
                </div>

                <div class="box box-default box-solid">
                    <div class="box-header">
                        <h4 class="box-title">
                            <?php echo lang('PayPal'); ?>

                            <i class="fa fa-question-circle show-tip" data-toggle="tooltip"
                               title="<?php echo lang('Leave fields blank to deactivate'); ?>"></i>
                        </h4>
                    </div>
                    <div class="box-body">
                        <?php
                        echo form_open('settings/update', ['class' => 'settings', 'demo' => 1]);
                        echo form_label(lang('PayPal locale'));
                        echo form_input('paypal_locale', $option['paypal_locale'], ['class' => 'form-control']);
                        echo form_label(lang('PayPal  email'));
                        echo form_input('paypal_email', $option['paypal_email'], ['class' => 'form-control']);
                        echo '<br/>';
                        echo form_button(['type' => 'submit', 'class' => 'btn btn-primary'], lang('Update'));
                        echo form_close('demo'); ?>
                    </div>
                </div>

                <div class="box box-default box-solid">
                    <div class="box-header">
                        <h4 class="box-title">
                            <?php echo lang('Stripe'); ?>

                            <i class="fa fa-question-circle show-tip" data-toggle="tooltip"
                               title="<?php echo lang('Leave fields blank to deactivate'); ?>"></i>
                        </h4>
                    </div>
                    <div class="box-body">
                        <?php
                        if(session('demo_mode') == 0) {
                            echo form_open('settings/update', ['class' => 'settings']);
                            echo form_label(lang('Stripe test public key'));
                            echo form_input('stripe_pk_test', $option['stripe_pk_test'], ['class' => 'form-control']);
                            echo form_label(lang('Stripe test secret key'));
                            echo form_password('stripe_sk_test', $option['stripe_sk_test'], ['class' => 'form-control']);
                            echo "<br/>";
                            echo form_label(lang('Stripe live public key'));
                            echo form_input('stripe_pk_live', $option['stripe_pk_live'], ['class' => 'form-control']);
                            echo form_label(lang('Stripe live secret key'));
                            echo form_password('stripe_sk_live', $option['stripe_sk_live'], ['class' => 'form-control']);
                            echo '<br/>';
                            echo form_button(['type' => 'submit', 'class' => 'btn btn-primary'], lang('Update'));
                            echo form_close('demo');
                        } else {
                            echo '<div class="alert alert-danger">'.lang('feature_disabled_in_demo').'</div>';
                        } ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">

                <div class="box box-default box-solid">
                    <div class="box-header">
                        <h4 class="box-title">
                            <?php echo lang('Payment methods'); ?>
                        </h4>
                    </div>
                    <div class="box-body">
                        <?php echo lang('Add a payment method'); ?>
                        <?php echo form_open('settings/paymentMethods', ['class' => 'settings', 'demo' => 1]);
                        echo '<div class="input-group">';
                        echo form_input('title', NULL, ['class' => 'form-control', 'required' => '']);
                        echo '<span class="input-group-btn">';
                        echo form_button(['type' => 'submit', 'class' => 'btn btn-primary'], '<i class="fa fa-plus"></i> '.lang('Add'));
                        echo '</span></div>';
                        echo form_close('demo'); ?>
                        <br/>
                        <table class="table table-bordered">
                            <?php foreach ($payMethods as $payMethod): ?>
                                <tr>
                                    <td class="col-md-11">
                                        <?php echo $payMethod->title; ?>
                                    </td>
                                    <td class="col-md-1">
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

                <div class="box box-default box-solid">
                    <div class="box-header">
                        <h4 class="box-title">
                            <?php echo lang('Invoice'); ?>
                        </h4>
                    </div>
                    <div class="box-body">
                        <?php
                        echo form_open('settings/update', ['class' => 'settings']);
                        echo form_label(lang('Invoice terms'), 'invoice_terms');
                        echo form_textarea('invoice_terms', $option['invoice_terms'], ['class' => 'form-control']);
                        //                        echo form_label(lang('Invoice notes'), 'invoice_notes');
                        //                        echo form_textarea('invoice_notes',$option['invoice_notes'], ['class' => 'form-control']);
                        echo '<br/>';
                        echo form_button(['type' => 'submit', 'class' => 'btn btn-primary'], lang('submit'));
                        echo form_close(); ?>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <div class="tab-pane" id="logo">
        <h3><?php echo lang('logo'); ?></h3>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                <div class="box box-default">
                    <div class="box-body">
                        <h3><?php echo lang('logo'); ?></h3>

                        <?php if(is_file(APPPATH.'../assets/uploads/content/'.session('logo'))): ?>
                            <img src="<?php echo base_url().'assets/uploads/content/'.session('logo'); ?>"/>
                        <?php endif; ?>
                        <hr/>

                        <div class="alert alert-warning">
                            <?php echo lang('logo_instructions'); ?>
                        </div>

                        <?php echo form_open_multipart('settings/upload_logo', 'class="input-group"'); ?>
                        <input class="form-control" type="file" required name="logo"/>
                        <span class="input-group-btn">
                            <button class="btn btn-default">
                                <?php echo lang('update'); ?>
                            </button>
                        </span>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box box-default">
                    <div class="box-body">
                        <h3><?php echo lang('invoice logo'); ?></h3>
                        <?php if(is_file(APPPATH.'../assets/uploads/content/'.session('invoice_logo'))): ?>
                            <img src="<?php echo base_url().'assets/uploads/content/'.session('invoice_logo'); ?>"/>
                        <?php endif;
                        echo '<hr/>';
                        echo form_open_multipart('settings/upload_invoice_logo', 'class="input-group"');
                        echo form_input(['type' => 'file', 'name' => 'invoice_logo', 'required' => '', 'class' => 'form-control']);
                        echo '<span class="input-group-btn">';
                        echo form_button(['type' => 'submit', 'class' => 'btn btn-primary'], lang('Update'));
                        echo '</span>';
                        echo form_close();
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="tab-pane" id="theme">
        <h3><?php echo lang('theme'); ?></h3>
        <hr/>

        <?php
        echo form_open('settings/update', ['class' => 'settings', 'demo' => 1]);
        ?>
        <h3><?php echo lang('Login background image'); ?>
            <i class="fa fa-question-circle show-tip pull-right" data-toggle="tooltip"
               title="<?php echo lang('Login background notice'); ?>"></i>
        </h3>

        <div class="row">
            <div class="col-sm-6">
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
    <div class="tab-pane" id="integrations">
        <div class="row">
            <?php echo form_open('settings/update', ['class' => 'settings', 'demo' => 1]); ?>
            <div class="col-sm-6">
                <?php echo form_label('Tawk.to '.lang('Embed URL'));
                echo anchor('https://dashboard.tawk.to/#/admin', ' '.lang('get link'), ['target' => '_blank']);
                echo form_input('tawkto_embed_url', $option['tawkto_embed_url'], ['class' => 'form-control',
                    'placeholder' => 'https://embed.tawk.to/xxxxx/xxxxxx']);
                echo '<br/>';
                ?>
            </div>
        </div>
        <?php
        echo form_button(['type' => 'submit', 'class' => 'btn btn-primary'], lang('Update'));
        echo form_close('demo');
        ?>
    </div>
    <div class="tab-pane" id="backup">
        <?php $this->load->view($this->module.'backup'); ?>
    </div>
    <div class="tab-pane" id="support">
        <h3><?php echo lang('support'); ?></h3>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                <ul>
                    <li><a href="https://github.com/amdtllc/daycarepro/wiki">Wiki</a></li>
                    <li><a href="https://amdtcllc.com/support">Support tickets</a></li>
                    <li><a href="https://github.com/amdtllc/daycarepro/wiki/Change-log">Change log</a></li>
                    <li><a href="https://github.com/amdtllc/daycarepro/wiki/Configuration">Configuration</a></li>
                    <li><a href="https://github.com/amdtllc/daycarepro/issues">Known issues</a></li>
                    <li><a href="https://github.com/amdtllc/daycarepro/wiki/Licenses">Licenses</a></li>
                </ul>
            </div>
            <div class="col-md-6">
                <div class="callout callout-info">
                    <h3>Thank you for supporting this project!</h3>
                    <p>Your donation helps us keep working on this script and make it available at a
                        very affordable price and provide free support</p>
                    <form action="https://www.paypal.com/cgi-bin/webscr" target="_blank" method="post">
                        <input type="hidden" name="cmd" value="_s-xclick">
                        <input type="hidden" name="hosted_button_id" value="Q3N6CNB3RRJBJ">
                        <input type="image"
                               src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif"
                               name="submit" alt="PayPal - The safer, easier way to pay online!">
                        <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1"
                             height="1">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('.settings').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            data: $(this).serialize(),
            type: 'POST',
            success: function (response) {
                swal({type: 'success', 'title': ''})
                setTimeout(function () {
                    window.location.reload();
                }, 2000)
            },
            error: function (error) {
                swal({type: 'error', 'title': ''})
            }
        });
    });
    $("input[name=login_bg_image]").click(function () {
        var img = $(this).val();
        $('.currentLoginImg').attr('src', '<?php echo base_url(); ?>' + 'assets/uploads/content/login/' + img)
    })
</script>