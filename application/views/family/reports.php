<div class="row">
	<div class="col-md-12">
		<!-- Custom Tabs (Pulled to the right) -->
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="pull-left header"><i class="fa fa-th"></i><?php echo lang('reports'); ?></li>

				<li class="active"><a href="#1-1" data-toggle="tab"><?php echo lang('attendance'); ?></a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="1-1">
					<div class="box box-warning">
						<div class="box-body">
							<table class="table table-stripped">
								<?php
								$cnt = 1;
								?>
								<th>#</th>
								<th><?php echo lang('date'); ?></th>
								<th><?php echo lang('time_in'); ?></th>
								<th><?php echo lang('time_out'); ?></th>
								<?php foreach($attendance as $row): ?>
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
		</div>
	</div>
</div>