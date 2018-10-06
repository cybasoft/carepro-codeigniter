<div class="row">
	<div class="col-lg-12">
		<div class="callout callout-warning">
			<h4>
				<?php echo $this->conf->totalRecords('groups'); ?>
				<?php echo lang('groups') . ' ' . lang('found'); ?>
			</h4>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title"><?php echo lang('groups'); ?></h3>
			</div>
			<div class="card-body">
				<table class="table table-bordered table-hover table-striped">
					<thead>
					<tr align="center">
						<td>#</td>
						<td><?php echo lang('group_name'); ?></td>
						<td><?php echo lang('description'); ?></td>
						<td><?php echo lang('index_action_th'); ?></td>
					</tr>
					</thead>
					<?php
					$start = 1;
					foreach($groups as $g):?>
						<tr>
							<td>
								<?php echo $start; ?>
							</td>
							<td><?php echo $g->name; ?></td>
							<td><?php echo $g->description; ?></td>
							<td>
								<?php echo anchor("users/edit_group/" . $g->id, 'edit'); ?>
							</td>
						</tr>
						<?php
						$start++;
					endforeach;
					?>
				</table>
			</div>
		</div>
	</div>

	<div class="col-lg-6">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title"><?php echo lang('create_group_heading'); ?></h3>
			</div>
			<div class="card-body">
				<?php echo form_open("users/create_group"); ?>
				<table class="table no-border">
					<tr>
						<td><?php echo lang('group_name'); ?></td>
						<td><input type="text" name="group_name" class="form-control" required=""/></td>
					</tr>
					<tr>
						<td><?php echo lang('description'); ?></td>
						<td><input type="text" name="description" class="form-control" required=""/></td>
					</tr>
					<tr>
						<td></td>
						<td class="pull-right">
							<button class="btn btn-primary"><?php echo lang('submit'); ?></button>
						</td>
					</tr>
				</table>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>