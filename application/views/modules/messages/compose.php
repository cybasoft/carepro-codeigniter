<div class="modal show" id="compose">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<span class="glyphicon glyphicon-envelope"></span> <?php echo lang('compose'); ?>
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
			</div>
			<div class="modal-body">
				<?php echo form_open('mailbox/send'); ?>
				<div class="box-body">
					<div class="input-group">
						<label class="input-group-addon" style="width:85px; text-align: right"><?php echo lang('to'); ?>
							:</label>
						<select class="form-control" name="receiver" required="">
							<option value="">--select</option>
							<?php
							foreach($this->users->users()->result() as $rc) {
								echo '<option value="' . $rc->id . '">' . $rc->username . '</option>';
							}
							?>
						</select>
					</div>
					<br/>

					<div class="input-group col-lg-12">
						<label class="input-group-addon text-right"
							   style="width: 85px; text-align: right"><?php echo lang('subject'); ?>:</label>
						<input type="text"
							   class="form-control"
							   value="<?php echo set_value('subject'); ?>"
							   name="subject" placeholder="<?php echo lang('subject'); ?>">
					</div>
					<label class="label label-default"><?php echo lang('message'); ?>:</label>
					<textarea class="form-control textarea"
							  id="editor"
							  rows="10"
							  name="message"
							  required=""><?php echo set_value
						('message'); ?></textarea>
				</div>
				<div class="box-footer">
					<button class="btn btn-primary">
						<span class="glyphicon glyphicon-envelope"></span> <?php echo lang('send'); ?>
					</button>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>