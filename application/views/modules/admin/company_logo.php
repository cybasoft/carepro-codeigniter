<h3><?php echo lang('company') . ' ' . lang('logo'); ?></h3>

<img src="<?php echo base_url() . 'assets/img/' . $this->config->item('logo', 'company'); ?>"/>
<hr/>
<div class="alert alert-warning">
	<?php echo lang('logo_instructions'); ?>
</div>

<?php echo form_open_multipart('settings/upload_logo', 'class="input-group"'); ?>
<input class="form-control" type="file" required name="logo"/>
<span class="input-group-btn"><button class="btn btn-default"><?php echo lang('update'); ?></button></span>
<?php echo form_close(); ?>