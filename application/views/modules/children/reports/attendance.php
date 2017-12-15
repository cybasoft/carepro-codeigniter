<?php $this->load->view($this->module . 'nav'); ?>

<div class="row">
	<div class="col-sm-6 col-md-6 col-lg-6">
		<div class="box box-solid box-primary">
			<div class="box-header bg-purple-gradient">
				<div class="box-title">
					<?php echo lang('attendance_report'); ?>
				</div>
			</div>
			<div class="box-body">
				<table class="table table-stripped">
					<?php
					$cnt = 1;
					?>
					<th>#</th>
					<th><?php echo lang('date'); ?></th>
					<th><?php echo lang('time_in'); ?></th>
					<th><?php echo lang('time_out'); ?></th>
					<?php foreach($attendance->result() as $row): ?>
						<tr>
							<td>
								<?php echo $cnt; ?>
							</td>
							<td><?php echo date('m/d/y', $row->time_in); ?></td>
							<td><?php if($row->time_in !== NULL) {
									echo date('H:i:s', $row->time_in);
								} ?></td>
							<td>
								<?php
								echo($row->time_out !== NULL ? date('H:i:s', $row->time_out) : '<span class="label label-danger">' . lang('pending_pickup') . '</span>');
								?>
							</td>

						</tr>
						<?php $cnt++; endforeach; ?>
				</table>
			</div>
		</div>
	</div>
</div>
