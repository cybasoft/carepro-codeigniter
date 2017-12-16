<div class="row">
<div class="col-md-6">
	<!-- Custom Tabs (Pulled to the right) -->
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="pull-left header"><i class="fa fa-th"></i><?php echo lang('health'); ?></li>

			<li class="active"><a href="#allergies" data-toggle="tab"><?php echo lang('allergies'); ?></a></li>
			<li><a href="#meds" data-toggle="tab"><?php echo lang('medications'); ?></a></li>
			<li><a href="#food" data-toggle="tab"><?php echo lang('food'); ?></a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="allergies">
				<div class="box box-warning">
					<div class="box-body">

						<?php echo form_open('health/add_allergy/', 'class="new-allergy"'); ?>
						<div class="col-xs-4">
							<input class="form-control" type="text" name="allergy"
								   placeholder="<?php echo lang('new') . ' ' . lang('allergy'); ?>"/>
						</div>
						<div class="col-xs-6">
							<input class="form-control" type="text" name="reaction" placeholder="<?php echo lang('reaction'); ?>"/>
						</div>
						<div class="col-xs-2">
							<button class="btn btn-default">
								<span class="fa fa-plus"></span>
							</button>
						</div>
						<?php echo form_close(); ?>

						<table class="table">
							<th><?php echo lang('allergy'); ?></th>
							<th><?php echo lang('reaction'); ?></th>
							<th><?php echo lang('notes'); ?></th>
							<?php foreach($allergies as $row): ?>
								<tr>
									<td><?php echo $row->allergy; ?></td>
									<td><?php echo $row->reaction; ?></td>
									<td><?php echo $row->notes; ?></td>
								</tr>
							<?php endforeach; ?>
						</table>

					</div>
				</div>
			</div>
			<div class="tab-pane" id="meds">
				<div class="box box-info">
					<div class="box-body">

							<?php echo form_open('health/add_med/' . $child->id, 'class="new-med"'); ?>
						<div class="col-xs-4">
							<input class="form-control" type="text" name="med_name" placeholder="<?php echo lang('medication'); ?>"/>
						</div>
						<div class="col-xs-6">
							<input class="form-control" type="text" name="med_notes" placeholder="<?php echo lang('notes'); ?>"/>
						</div>
						<div class="col-xs-2">
							<button class="btn btn-default">
								<span class="fa fa-plus"></span>
								<?php echo lang('add'); ?>
							</button>
						</div>
						<?php echo form_close(); ?>

						<table class="table">
							<th>Medication</th>
							<th>Instructions</th>
							<?php foreach($meds as $med): ?>
								<tr>
									<td><?php echo $med->med_name; ?></td>
									<td><?php echo $med->med_notes; ?></td>
								</tr>
							<?php endforeach; ?>
						</table>

					</div>
				</div>
			</div>
			<div class="tab-pane" id="food">
				<div class="box box-warning">
					<div class="box-body">

							<?php echo form_open('health/add_foodpref/', 'class="new-foodpref "'); ?>
						<div class="col-xs-3">
							<input class="form-control" type="text" name="food" placeholder="<?php echo lang('food'); ?>"/>
						</div>
						<div class="col-xs-3">
							<select name="food_time" class="form-control">
								<option>--<?php echo lang('select'); ?>--</option>
								<option value="breakfast"><?php echo lang('breakfast'); ?></option>
								<option value="brunch"><?php echo lang('brunch'); ?></option>
								<option value="lunch"><?php echo lang('lunch'); ?></option>
								<option value="dinner"><?php echo lang('dinner'); ?></option>
								<option value="other"><?php echo lang('other'); ?></option>
							</select>
						</div>
						<div class="col-xs-4">
							<input type="text" name="comment" class="form-control" placeholder="<?php echo lang('comment'); ?>"/>
						</div>

						<div class="col-xs-2">
							<button class="btn btn-default">
								<span class="fa fa-plus"></span>
							</button>
						</div>
						<?php echo form_close(); ?>

						<table class="table">
							<th>Food item</th>
							<th>Time</th>
							<th>Notes</th>
							<?php foreach($foods as $food): ?>
								<tr>
									<td><?php echo $food->food; ?></td>
									<td><?php echo $food->food_time; ?></td>
									<td><?php echo $food->comment; ?></td>
								</tr>
							<?php endforeach; ?>
						</table>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	<div class="col-md-6">
		<div class="box box-warning">
			<div class="box-header"><div class="box-title"><?php echo lang('insurance'); ?></div> </div>
			<div class="box-body">
				<table class="table">
					<th>Policy name</th>
					<th>Policy number</th>
					<th>Group number</th>
					<?php foreach($insurance as $ins): ?>
						<tr>
							<td><?php echo $ins->p_name; ?></td>
							<td><?php echo $ins->p_num; ?></td>
							<td><?php echo $ins->g_num; ?></td>
						</tr>
					<?php endforeach; ?>
				</table>

			</div>
		</div>
	</div>
</div>