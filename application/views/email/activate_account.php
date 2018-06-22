<h3><?php echo sprintf(lang('email_activate_heading'), $identity);?></h3>

<table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
    <tbody>
    <tr>
        <td align="left">
            <table border="0" cellpadding="0" cellspacing="0">
                <tbody>
                <tr>
                    <td>
                        <?php echo anchor('activate/'. $id .'/'. $activation, lang('email_activate_link')); ?>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
<p>
    <?php echo lang('copy_paste_link_if_not_working'); ?>
    <?php echo site_url('activate/'. $id .'/'. $activation); ?>
</p>