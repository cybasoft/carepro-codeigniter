<div class="row">
	<div class="col-lg-4 col-md-4 col-xs-12">
		<div class="box">
			<div class="box-body">
				<table class="table">
					<tr>
						<td>SSN:</td>
						<td><?php echo $this->conf->decrypt($child->ssn); ?></td>
					</tr>
					<tr>
						<td>Gender:</td>
						<td><?php echo $child->gender ==1? 'male': 'female'; ?></td>
					</tr>
					<tr>
						<td>Blood type:</td>
						<td><?php echo $child->blood_type; ?></td>
					</tr>
					<tr>
						<td>Enrolled on:</td>
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
				<div class="box-title">Alerts</div>
			</div>
			<div class="box-body">
				<table class="table">
					<tr>
						<td>SSN:</td>
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
				<div class="box-title">Upcoming events</div>
			</div>
			<div class="box-body">

			</div>
		</div>
	</div>
</div>