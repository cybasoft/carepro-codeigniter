<div class="row">
	<div class="col-lg-6">

		<?php if($user_id == $this->user->uid()): ?>
			<?php echo lang('user_is_self_warning'); ?>
		<?php else: ?>

		<div class="callout callout-info">
			<h3><?php echo lang('deactivate_heading');?></h3>
			<p><?php echo sprintf(lang('deactivate_subheading'), $this->user->user($user_id)->last_name);?></p>
		</div>
		<?php echo form_open(uri_string());?>
		<p>
			<?php echo lang('deactivate_confirm_y_label', 'confirm');?>
			<input type="radio" name="confirm" value="yes" checked="checked" />
			<?php echo lang('deactivate_confirm_n_label', 'confirm');?>
			<input type="radio" name="confirm" value="no" />
		</p>
		<?php echo form_hidden(array('id'=>$user_id)); ?>

		<button class="btn btn-primary"><?php echo lang('deactivate_submit_btn'); ?></button>
		<?php echo form_close();?>

		<?php endif; ?>
	</div>
</div>