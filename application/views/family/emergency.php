<div class="row">
	<div class="col-sm-8 col-md-8 col-lg-8">
		<div class="box box-solid box-danger">
			<div class="box-header bg-maroon">
				<div class="box-title"><?php echo lang('emergency_contact'); ?></div>
			</div>
			<div class="box-body">
				<table class="table table-responsive table-striped">
					<th><?php echo lang('name'); ?></th>
					<th><?php echo lang('cellphone'); ?></th>
					<th><?php echo lang('other_phone'); ?></th>
					<th><?php echo lang('address'); ?></th>
					<th><?php echo lang('relation'); ?></th>
					<th></th>

					<?php foreach($eContact as $ec): ?>
						<tr>
							<td class="col-sm-3"><?php echo $ec->lname . ', ' . $ec->fname; ?></td>
							<td><?php echo $ec->cell; ?></td>
							<td><?php echo $ec->other_phone; ?></td>
							<td class="col-sm-4"><?php echo $ec->address; ?></td>
							<td><?php echo $ec->relation; ?></td>
							<td>
							<span class="glyphicon glyphicon-trash cursor"
								  onclick="deleteEmer('<?php echo $ec->id; ?>');"></span>
							</td>
						</tr>
					<?php endforeach; ?>
				</table>
			</div>
		</div>
	</div>

	<div class="col-sm-4 col-md-4 col-lg-4">
		<div class="box box-solid">
			<div class="box-header bg-maroon"><h3 class="box-title"><?php echo lang('add'); ?></h3></div>
			<div class="box-body">
				<?php echo form_open('emergency/add_contact/' .$this->children->child()->id); ?>
				<input class="form-control" type="text" name="fname" placeholder="<?php echo lang('first_name'); ?>"
					   required=""/>
				<input class="form-control" type="text" name="lname" placeholder="<?php echo lang('last_name'); ?>"
					   required=""/>
				<input class="form-control" type="text" name="cell" placeholder="<?php echo lang('cellphone'); ?>"
					   required=""/>
				<input class="form-control" type="text" name="other_phone"
					   placeholder="<?php echo lang('other_phone'); ?>"/>

				<input class="form-control" type="text" name="relation"
					   placeholder="<?php echo lang('relation'); ?>" required=""/>

				<textarea class="form-control" name="address" placeholder="Address"></textarea>
				<button class="btn bg-maroon"><?php echo lang('submit'); ?></button>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function deleteEmer(id) {
		if (confirm('Are you sure you want to delete this entry?')) {
			window.location.href = '<?php echo site_url('emergency/delete_contact'); ?>/' + id;
		}
	}
</script>