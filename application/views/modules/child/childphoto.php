<div class="child-thumb" style="width:100%;position:relative">
    <span style="position:absolute;right:0" class="label label-default cursor" data-toggle="modal" data-target="#new-photo">
       <i class="fa fa-pencil fa-2x" aria-hidden="true"></i>
    </span>
	<?php
if (!empty($child->photo)) {
	echo '<img class="img-square img-responsive img-thumbnail"
         src="' . base_url() . 'assets/img/users/children/' . $child->photo . '"/>';
} else {
	echo '<img class="img-circle img-responsive img-thumbnail"
         src="' . base_url() . 'assets/img/content/no-image.png"/>';
}
?>
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
				<?php echo form_open_multipart('child/' . $child->id.'/uploadPhoto', 'class="input-group"'); ?>

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