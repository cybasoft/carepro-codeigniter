<h4><?php echo lang('new_user_email_body'); ?></h4>
<table>
    <tr>
        <td><?php echo lang('name'); ?>:</td>
        <td><?php echo $data['first_name'] . ' ' . $data['last_name']; ?></td>
    </tr>
    <tr>
        <td><?php echo lang('email'); ?>:</td>
        <td><?php echo $data['email']; ?></td>
    </tr>
    <tr>
        <td><?php echo lang('ip_address'); ?></td>
        <td><?php echo $data['ip_address']; ?></td>
    </tr>
</table>