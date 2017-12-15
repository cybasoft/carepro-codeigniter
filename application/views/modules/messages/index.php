<?php
function is_read($read)
{
	if($read == 0) {
		return 'bg-info';
	}
	return '';
}

?>
<div class="row">
	<div class="col-sm-3 col-md-3 col-lg-3">
		<?php $this->load->view($this->module . 'sidebar'); ?>
	</div>

	<div class="col-sm-9 col-md-9 col-lg-9">
		<div class="compose-modal"></div>
		<table class="table">
			<thead class="text-bold">
			<tr>
				<td>
				</td>
				<td class="text-left"><?php echo lang('sender'); ?></td>
				<td class="text-left"><?php echo lang('message'); ?></td>
				<td class="text-right"><?php echo lang('date_sent'); ?></td>
			</tr>
			</thead>
			<tbody>
			<?php foreach($messages as $row): ?>
				<?php if($row->sender == $this->users->uid() && $row->sender_read == 0): ?>
					<tr class="bg-info">
				<?php elseif($row->receiver == $this->users->uid() && $row->receiver_read == 0): ?>
					<tr class="bg-info">
				<?php endif; ?>
				<td>
					<?php if($row->location=="starred"): ?>
					<i class="fa fa-star"></i>
						<?php elseif($row->location=="important"): ?>
						<i class="fa fa-exclamation"></i>
					<?php else: ?>
					<?php endif; ?>
				</td>
				<td>
					<?php echo $this->user->user($row->sender)->username !== "" ? $this->user->user($row->sender)->username : 'unknown'; ?>
				</td>
				<td>
					<a href="<?php echo site_url('mailbox/read/' . $row->msg_id); ?>">
						<span><?php echo $row->subject; ?></span>
					</a>
				</td>
				<td>
					<small class="pull-right ">
						<?php echo date($this->company->company()->date_format . ' H:iA', $row->date_sent); ?>
					</small>
				</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>