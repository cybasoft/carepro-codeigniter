<table class="">
    <tr>
        <td class="wrapper">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <h3><?php echo sprintf(lang('email_forgot_password_heading'), $identity); ?></h3>
                        <?php echo sprintf(lang('email_forgot_password_message'), $identity); ?>

                        <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                            <tbody>
                            <tr>
                                <td align="left">
                                    <table border="0" cellpadding="0" cellspacing="0">
                                        <tbody>
                                        <tr>
                                            <td>
                                                <?php echo anchor('auth/reset/' . $forgotten_password_code, lang('email_forgot_password_link')); ?>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <p>
                            <?php echo lang('If the above link doesn\'t work, copy and paste this to your browser'); ?>
                            <?php echo site_url('auth/reset/'.$forgotten_password_code); ?>
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>