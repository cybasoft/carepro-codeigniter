<div class="row">
	<div class="col-lg-6">
		<div class="callout callout-warning">
			<h4><?php echo lang('edit_group_heading');?></h4>
		</div>
		<?php echo form_open('users/update_group/'.$group->id);?>

		<p>
			<?php echo lang('edit_group_name_label', 'group_name');?> <br />
			<input type="text" name="group_name" value="<?php echo $group->name; ?>" class="form-control" required=""/>
		</p>

		<p>
			<?php echo lang('edit_group_desc_label', 'description');?> <br />
			<input type="text" name="group_description" value="<?php echo $group->description; ?>" class="form-control" required=""/>
		</p>

		<p>
			<button class="btn btn-primary"><?php echo lang('submit'); ?></button>
		</p>

		<?php echo form_close();?>
	</div>
</div>
