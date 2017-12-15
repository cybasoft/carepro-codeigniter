<div class="row">
	<div class="col-sm-6 col-md-6 col-sm-6 text-center">
		<?php echo form_open('users/delete/'.$user_id); ?>

		<?php if($user_id == $this->users->uid()): ?>
				<?php echo lang('user_is_self_warning'); ?>
		<?php else: ?>
			<div class="alert alert-danger h4">
				<?php echo lang('confirm_delete_user'); ?>
			</div>
			<div class="input-group">
			<span class="input-group-addon bg-red">
				<i class="fa fa-warning"></i>
				<strong><?php echo $this->users->user($user_id)->username; ?></strong>
			</span>
				<input type="text" name="confirm" value="" class="form-control"/>
			<span class="input-group-btn">
				<button class="btn btn-danger btn-flat"><?php echo lang('delete'); ?></button>
			</span>
			</div>
		<?php endif; ?>

		<?php echo form_close(); ?>
	</div>
</div>
