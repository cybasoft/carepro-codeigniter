<?php
function blood_type($value,$type){
	if($type==$value)
		return "selected";
	return "";
}
?>
<?php echo form_open('child/'.$child->id); ?>
<?php echo form_hidden('child_id',$child->id); ?>
	<table class="table">
		<tr>
			<td><?php echo lang('first_name'); ?></td>
			<td>
				<input class="form-control" required="" type="text" name="fname"
					   value="<?php echo $child->fname; ?>"/>
			</td>
		</tr>
		<tr>
			<td><?php echo lang('last_name'); ?></td>
			<td><input class="form-control" required="" type="text" name="lname"
					   value="<?php echo $child->lname; ?>"/></td>
		</tr>
		<tr>
			<td><?php echo lang('birthday'); ?></td>
			<td><input class="form-control" id="bday" required="" type="date" name="bday"
					   value="<?php echo $child->bday; ?>"/></td>
		</tr>
		<tr>
			<td><?php echo lang('national_id'); ?></td>
			<td><input type="text" name="national_id" value="<?php echo decrypt($child->national_id); ?>" class="form-control"/></td>
		</tr>
		<tr>
			<td><?php echo lang('gender'); ?></td>
			<td>
				<select required="" class="form-control" name="gender">
					<option value="">--<?php echo lang('select'); ?>--</option>
					<option value="1" <?php echo selected_option($child->gender, 1); ?>>
						<?php echo lang('male'); ?>
					</option>
					<option value="2" <?php echo selected_option($child->gender, 2); ?>>
						<?php echo lang('female'); ?>
					</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Blood type</td>
			<td>
				<select name="blood_type" required="" class="form-control">
					<option value="unknown">--<?php echo lang('select'); ?>--</option>
					<option <?php echo blood_type("A-",$child->blood_type); ?> value="A-">A-</option>
					<option <?php echo blood_type("A+",$child->blood_type); ?> value="A+">A+</option>
					<option <?php echo blood_type("B-",$child->blood_type); ?> value="B-">B-</option>
					<option <?php echo blood_type("B+",$child->blood_type); ?> value="B+">B+</option>
					<option <?php echo blood_type("AB-",$child->blood_type); ?> value="AB-">AB-</option>
					<option <?php echo blood_type("AB+",$child->blood_type); ?> value="AB+">AB+</option>
					<option <?php echo blood_type("O-",$child->blood_type); ?> value="O-">O-</option>
					<option <?php echo blood_type("O+",$child->blood_type); ?> value="O+">O+</option>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php echo lang('status'); ?></td>
			<td>
				<select class="form-control" name="child_status" required="">
					<option value="">--<?php echo lang('select'); ?>--</option>
					<?php
					foreach($this->db->get('child_status')->result() as $s) {
						echo '<option value="' . $s->id . '" '
							. selected_option($child->status, $s->id) . '>'
							. lang($s->status_name) . '</option>';
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<button class="btn btn-primary"><?php echo lang('update'); ?></button>
			</td>
		</tr>
	</table>
<?php echo form_close(); ?>