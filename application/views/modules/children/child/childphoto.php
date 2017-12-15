<span class="pull-right">
	<?php echo lang('status'); ?>:
</span>

<div class="child-thumb" style="width:200px">
	<?php
	if($child->photo !== "") {
		echo '<img class="img-circle img-responsive img-thumbnail"
         src="' . base_url() . 'assets/companies/'.$this->company->company()->code.'/images/children/' . $child->photo . '"/>';
	} else {
		echo '<img class="img-circle img-responsive img-thumbnail"
         src="' . base_url() . 'assets/images/no-image.png"/>';
	}
	?>
</div>

<div class="text-center">
	<span class="label label-default" data-toggle="modal" data-target="#new-photo"><?php echo lang('change'); ?></span>
</div>

<div class="modal fade" id="new-photo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
						class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel"><?php echo lang('upload'); ?>
					for: <?php echo $child->lname . ', ' . $child->fname; ?></h4>
			</div>
			<div class="modal-body">
				<?php echo form_open_multipart('children/upload_photo/' . $child->id . '/children', 'class="input-group"'); ?>

				<input class="form-control" type="file" name="userfile" size="20"/>


                    <span class="input-group-btn">
                        <button class="btn btn-info" type="submit"><?php echo lang('upload'); ?></button>
                    </span>

				<?php echo form_close(); ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default"
						data-dismiss="modal"><?php echo lang('cancel'); ?></button>

			</div>
		</div>
	</div>
</div>