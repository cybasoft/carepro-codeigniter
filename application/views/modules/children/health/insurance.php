<?php echo form_open('health/add_insurance'); ?>
<table>
	<tr>
		<td><input name="p_name" type="text" class="form-control" placeholder="Company name" required=""/></td>
		<td><input name="p_num" type="text" class="form-control" placeholder="Policy number" required=""/></td>
		<td><input name="g_num" type="text" class="form-control" placeholder="Group number" required=""/></td>
		<td class="input-group">
			<input name="expiry" type="date" class="form-control" placeholder="Expiry"/>
			<span class="input-group-btn">
			<button class="btn btn-primary"><?php echo lang('add'); ?></button> </span>
		</td>

	</tr>
</table>
<?php echo form_close(); ?>

<table class="table">
	<th>Policy name</th>
	<th>Policy number</th>
	<th>Group number</th>
	<th>Expiry</th>
	<th>Actions</th>
<?php $query =$this->db->where('child_id',$this->children->getID())->get('child_insurance');
foreach($query->result() as $row): ?>
<tr>
	<td><?php echo $row->p_name; ?></td>
	<td><?php echo $row->p_num; ?></td>
	<td><?php echo $row->g_num; ?></td>
	<td><?php echo date('d M y',strtotime($row->expiry)); ?></td>
	<td>
		<a href="<?php echo site_url('health/delete_insurance/'.$row->id); ?>">
			<i class="fa fa-trash-o"></i>
		</a>
	</td>
</tr>
<?php endforeach; ?>
</table>
