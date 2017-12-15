<ol class="breadcrumb alert-success">
    <li class="active"><?php echo lang('register') . ' ' . lang('child'); ?></li>
</ol>
<?php echo form_open('children/add_child'); ?>
<div class="input-group col-sm-4">
    <span class="input-group-addon"><?php echo lang('first_name'); ?> </span>
    <input class="form-control" type="text" name="fname" value="" required=""/>
</div>
<hr/>
<div class="input-group col-sm-4">
    <span class="input-group-addon"><?php echo lang('last_name'); ?>: </span>
    <input class="form-control" type="text" name="lname" value="" required=""/>
</div>
<hr/>
<div class="input-group col-sm-4">
    <span class="input-group-addon"><?php echo lang('birthday'); ?></span>
    <input class="form-control" id="bday" type="date" name="bday" value="" required="" placeholder="mm/dd/yyyy"/>
</div>
<hr/>
<div class="input-group col-sm-4">
    <span class="input-group-addon"><?php echo lang('social_security_number'); ?> </span>
    <input class="form-control" type="text" name="ssn" value="" required=""/>
</div>
<hr/>
<div class="input-group col-sm-4">
    <span class="input-group-addon"><?php echo lang('gender'); ?></span>
    <select class="form-control" name="gender" required="">
        <option value="">--<?php echo lang('select'); ?>--</option>
        <option value="1"><?php echo lang('male'); ?></option>
        <option value="2"><?php echo lang('female'); ?></option>
    </select>
</div>
<hr/>

<button class="btn btn-primary"><?php echo lang('submit'); ?></button>
<?php echo form_close(); ?>

<script>
    $("#bday").mask("99/99/9999");
</script>
