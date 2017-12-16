<div class="row">
	<div class="col-sm-3 col-md-3 col-lg-3">
		<?php $this->load->view($this->module . 'sidebar'); ?>
	</div>
	<div class="col-sm-9 col-md-9 col-lg-9">
		<div class="compose-modal"></div>
		<div class="box box-primary">
			<div class="box-header bg-gray text-bold">
				<div style="height: 22px; padding:0 5px 0 5px">
						<?php echo $this->user->user($msg->sender)->last_name; ?>
						<em class="pull-right"> <?php echo date('H:iA d M y', $msg->date_sent); ?></em>
				</div>
			</div>
			<div class="box-body">
				<p class="h4"><?php echo $msg->subject; ?></p>
				<p><?php echo $msg->message; ?></p>
			</div>
			<div class="box-footer">
				<div class="actionbox">
					<button class="btn btn-primary btn-xs" id="<?php echo $msg->msg_id; ?>" data="inbox">
						<span class="fa fa-unchecked"></span> <?php echo lang('mark_as_unread'); ?>
					</button>
					<button class="btn btn-info msg-star btn-xs" id="<?php echo $msg->msg_id; ?>" data="starred">
						<span class="fa fa-star"></span> <?php echo lang('mark_with_star'); ?>
					</button>
					<button class="btn btn-warning btn-xs" id="<?php echo $msg->msg_id; ?>" data="important">
						<span class="fa fa-bookmark"></span> <?php echo lang('important'); ?>
					</button>

					<!--button class="btn btn-danger btn-xs" id="<?php echo $msg->msg_id; ?>" data="trash">
						<span class="fa fa-trash-o"></span> <?php echo lang('trash'); ?>
					</button-->
					<!--button class="btn btn-danger btn-xs" id="<?php echo $msg->msg_id; ?>" data="purge">
						<span class="fa fa-remove"></span> <?php echo lang('purge'); ?>
					</button-->
				</div>

			</div>
			<hr/>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-9 pull-right">
		<?php foreach($this->mail->getReplies($msg->msg_id) as $row): ?>
		<div class="box box-warning">
			<div class="box-header bg-gray text-bold" style="height: 22px; padding:0 5px 0 5px">
					<?php echo $this->user->user($row->sender)->last_name; ?>
				 <em class="pull-right"><?php echo date('H:iA d M y',$row->date_sent); ?></em>
		</div>
			<div class="box-body">
				<?php echo $row->message; ?>
			</div>

			<div class="box-footer">
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>

<hr/>
<div class="row">

	<div class="col-sm-9 pull-right">
		<div class="box box-success">
			<div class="box-header">
				<div class="box-title"><?php echo lang('reply'); ?></div>
			</div>
			<?php echo form_open('mailbox/sendReply/' . $msg->msg_id, 'id="reply"'); ?>
			<div class="box-body">
				<textarea class="form-control textarea" required="" id="editor" rows="5"
						  name="message" required=""></textarea>
			</div>
			<div class="box-footer">
				<button class="btn btn-dark">
					<span class="fa fa-envelope"></span> <?php echo lang('reply'); ?>
				</button>
			</div>
			<?php echo form_close(); ?>
		</div>

	</div>
</div>

<script>
	$(document).ready(function () {
		$('.actionbox button').click(function () {
			var msg_id = $(this).attr('id');
			var move_to = $(this).attr('data');
			request = $.ajax({
				url: '<?php echo site_url('mailbox/move_to'); ?>',
				type: "post",
				data: 'msg_id=' + msg_id + '&location=' + move_to
			});
			request.done(function (response, textStatus, jqXHR) {
				location.href = '<?php echo site_url('mailbox'); ?>';
			});
			request.fail(function (jqXHR, textStatus, errorThrown) {
				alert('<?php echo lang('request_error'); ?>');
			});
		});
		$('.sent-purge').click(function () {
			var msg_id = $(this).attr('id');
			request = $.ajax({
				url: '<?php echo site_url('mailbox/sent_purge'); ?>',
				type: "post",
				data: 'msg_id=' + msg_id
			});
			request.done(function (response, textStatus, jqXHR) {
				location.href = '<?php echo site_url('mailbox'); ?>';
			});
			request.fail(function (jqXHR, textStatus, errorThrown) {
				alert('<?php echo lang('request_error'); ?>');
			});
		});
	})
</script>