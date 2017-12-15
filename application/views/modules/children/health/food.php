
	<?php echo form_open('health/add_foodpref/'); ?>
	<table>
		<tr>
			<td><input class="form-control" type="text" name="food" placeholder="<?php echo lang('food'); ?>"/></td>
			<td>
				<select name="food_time" class="form-control">
					<option>--<?php echo lang('select'); ?>--</option>
					<option value="breakfast"><?php echo lang('breakfast'); ?></option>
					<option value="brunch"><?php echo lang('brunch'); ?></option>
					<option value="lunch"><?php echo lang('lunch'); ?></option>
					<option value="dinner"><?php echo lang('dinner'); ?></option>
					<option value="other"><?php echo lang('other'); ?></option>
				</select>
			</td>
			<td><input type="text" name="comment" class="form-control" placeholder="<?php echo lang('comment'); ?>"/></td>
			<td>
				<button class="btn btn-default">
					<span class="glyphicon glyphicon-plus-sign"></span>
				</button>
			</td>
		</tr>
	</table>
	<?php echo form_close(); ?>

<table class="table table-hover">
	<th><?php echo lang('food_item'); ?></th>
	<th><?php echo lang('time'); ?></th>
	<th><?php echo lang('comment'); ?></th>
	<th><?php echo lang('actions'); ?></th>
	<?php
	$this->db->where('child_id', $this->child->getID());
	$foods = $this->db->get('child_foodpref');
	if($foods->num_rows() > 0) {
		foreach($foods->result() as $item) {
			?>
			<tr>
				<td><?php echo $item->food; ?></td>
				<td><?php echo $item->food_time; ?></td>
				<td><?php echo $item->comment; ?></td>
				<td><span class="glyphicon glyphicon-trash pull-right cursor"
						  onclick="deleteFood('<?php echo $item->id; ?>','delete_food');"></span></td>
			</tr>
		<?php
		}
	} else {
		echo '<div class="alert alert-warning h3">' . lang('nothing_to_display') . '</div>';
	}
	?>
</table>

<script type="text/javascript">
	function deleteFood(id, path) {
		if (confirm('<?php echo lang('confirm_delete_item'); ?>')) {
			window.location.href = '<?php echo site_url(); ?>health/' + path + '/' + id;
		}
	}
</script>