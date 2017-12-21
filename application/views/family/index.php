<div class="row">
	<div class="col-lg-4 col-md-4 col-xs-12">
		<div class="box">
			<div class="box-body">
				<table class="table">
					<tr>
						<td><?php echo lang('national_id'); ?></td>
						<td><?php echo decrypt($child->national_id); ?></td>
					</tr>
					<tr>
						<td><?php echo lang('gender'); ?>:</td>
						<td><?php echo $child->gender ==1? 'male': 'female'; ?></td>
					</tr>
					<tr>
						<td><?php echo lang('blood_type'); ?>:</td>
						<td><?php echo $child->blood_type; ?></td>
					</tr>
					<tr>
						<td><?php echo lang('enrolled_on'); ?>:</td>
						<td><?php echo date('d M Y',$child->enroll_date); ?></td>
					</tr>
				</table>
			</div>
			<div class="box-footer bg-aqua">
				<?php echo lang('update_child_notice'); ?>
			</div>
		</div>
	</div>

	<div class="col-lg-4 col-md-4 col-xs-12">
		<div class="box box-info box-solid">
			<div class="box-header">
				<div class="box-title"><?php echo lang('alerts'); ?></div>
			</div>
			<div class="box-body">
				<table class="table">
					<tr>
						<td><?php echo lang('national_id'); ?></td>
						<td></td>
					</tr>
					<tr>
						<td></td>
					</tr>
				</table>
			</div>
		</div>
	</div>


	<div class="col-lg-4 col-md-4 col-xs-12">
		<div class="box box-primary box-solid">
			<div class="box-header">
				<div class="box-title"><?php echo lang('upcoming_events'); ?></div>
			</div>
			<div class="box-body">

			</div>
		</div>
	</div>
</div>