<?php echo $this->company->logo(); ?>
<hr/>
<div class="alert alert-warning">
	Logo dimensions should be 500px x 112px or lower
</div>
<div class="alert alert-warning">
	Logo size should be 2MB (2048kb) lower
</div>
<?php echo form_open_multipart('settings/upload_logo', 'class="input-group"'); ?>
<input class="form-control" type="file" name="company_logo"/>
<span class="input-group-btn"><button class="btn btn-default"><?php echo lang('update'); ?></button></span>
<?php echo form_close(); ?>