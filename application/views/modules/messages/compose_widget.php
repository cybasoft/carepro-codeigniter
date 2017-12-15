<div class="box">
	<div class="box-header ui-sortable-handle" style="cursor: move;">
		<i class="fa fa-envelope"></i>
		<h3 class="box-title">Quick Message</h3>
		<div class="pull-right box-tools">
			<button class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
			<button class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
		</div>
	</div>
	<?php echo form_open('mailbox/send'); ?>
	<div class="box-body no-padding">
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
				  rows="5"
				  name="message"
				  required=""><?php echo set_value
			('message'); ?></textarea>
	</div>
	<div class="box-footer text-black">
		<div class="row">
			<div class="col-sm-6">
				<button class="btn btn-primary">
					<span class="glyphicon glyphicon-envelope"></span> <?php echo lang('send'); ?>
				</button>
			</div>
		</div>
	</div>
	<?php echo form_close(); ?>
</div>