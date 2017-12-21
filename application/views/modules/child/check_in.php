<div class="modal show" id="check-in">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
						class="sr-only"><?php echo lang('close'); ?></span></button>
				<h2 class="modal-title" id="myModalLabel"><?php echo lang('check_in'); ?></h2>
			</div>
			<div class="modal-body">
				<div class="alert alert-info"><?php echo lang('check_in_out_notice'); ?></div>
				<table class="table table-hover">
					<?php foreach($parents as $p): ?>
						<tr>
							<td style="width:100px">
								<?php $this->user->getPhoto($p->user_id); ?>
							</td>
							<td>
								<span class="h3"><?php echo $p->first_name . ' ' . $p->last_name; ?></span>
								<?php echo form_open('child/' . $child_id.'/checkIn'); ?>
								<input type="hidden" name="parent_id" value="<?php echo $p->user_id; ?>"/>

								<div class="input-group">
									<span class="input-group-addon"><?php echo lang('pin'); ?>:</span>
									<input type="password" name="pin" class="form-control" required=""/>
                                    <span class="input-group-btn">
                                        <button class="btn btn-success"><?php echo lang('check_in'); ?></button>
                                    </span>
								</div>
								<?php echo form_close(); ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</table>
			</div>
		</div>
	</div>
</div>