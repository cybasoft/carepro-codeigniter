<h3><?php echo lang('register').' '.lang('child'); ?></h3>
<div class="alert alert-info">
<?php echo lang('parent_child_registration_notice'); ?>

</div>
<?php
$fname = array(
    'name'        => 'fname',
    'type'        => 'text',
    'value'       => $this->form_validation->set_value('fname'),
    'placeholder' => lang('first_name'),
);
$lname = array(
    'name'        => 'lname',
    'type'        => 'text',
    'value'       => $this->form_validation->set_value('lname'),
    'placeholder' => lang('last_name'),
);
$bday = array(
    'name'        => 'bday',
    'type'        => 'date',
    'value'       => $this->form_validation->set_value('bday'),
    'placeholder' => lang('birthday'),
);
$ssn = array(
    'name'        => 'ssn',
    'type'        => 'text',
    'value'       => $this->form_validation->set_value('ssn'),
    'placeholder' => lang('social_security_number'),
);

?>
<?php
echo form_open(uri_string(), 'class="col-sm-4"');
echo form_input($fname);
echo form_input($lname);
echo form_password($ssn);
echo '<div class="input-group">';
echo '<span class="input-group-addon"'.lang('birthday').' </span>';
echo form_input($bday);
echo '</div>';
?>
<div class="input-group">
    <span class="input-group-addon"><?php echo lang('gender'); ?> </span>
    <select class="form-control" name="gender" required="">
        <option value="">--<?php echo lang('select'); ?>--</option>
        <option value="1"><?php echo lang('male'); ?></option>
        <option value="2"><?php echo lang('female'); ?></option>
    </select>
</div>
<br/>
<button class="btn btn-primary"><?php echo lang('submit'); ?></button>
<?php echo form_close(); ?>