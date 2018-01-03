<?php if (!is('parent')): ?>
    <?php echo form_open('child/' . $child->id); ?>
    <?php echo form_hidden('child_id', $child->id); ?>
<?php endif; ?>
<table class="table">
    <tr>
        <td><?php echo lang('first_name'); ?></td>
        <td>
            <input class="form-control" required="" type="text" name="first_name"
                   value="<?php echo $child->first_name; ?>"/>
        </td>
    </tr>
    <tr>
        <td><?php echo lang('last_name'); ?></td>
        <td><input class="form-control" required="" type="text" name="last_name"
                   value="<?php echo $child->last_name; ?>"/></td>
    </tr>
    <tr>
        <td><?php echo lang('birthday'); ?></td>
        <td><input class="form-control" id="bday" required="" type="date" name="bday"
                   value="<?php echo date('Y-m-d', strtotime($child->bday)); ?>"/></td>
    </tr>
    <tr>
        <td><?php echo lang('national_id'); ?></td>
        <td><input type="text" name="national_id" required value="<?php echo decrypt($child->national_id); ?>"
                   class="form-control"/></td>
    </tr>
    <tr>
        <td><?php echo lang('gender'); ?></td>
        <td>
            <select required class="form-control" name="gender">
                <option value="">--<?php echo lang('select'); ?>--</option>
                <option value="male" <?php echo selected_option($child->gender, 'male'); ?>>
                    <?php echo lang('male'); ?>
                </option>
                <option value="female" <?php echo selected_option($child->gender, 'female'); ?>>
                    <?php echo lang('female'); ?>
                </option>
                <option value="other" <?php echo selected_option($child->gender, 'other'); ?>>
                    <?php echo lang('other'); ?>
                </option>
            </select>
        </td>
    </tr>
    <tr>
        <td><?php echo lang('blood_type'); ?></td>
        <td>
            <select name="blood_type" required="" class="form-control">
                <option value="unknown">--<?php echo lang('select'); ?>--</option>
                <option <?php echo selected_option("A-", $child->blood_type); ?> value="A-">A-</option>
                <option <?php echo selected_option("A+", $child->blood_type); ?> value="A+">A+</option>
                <option <?php echo selected_option("B-", $child->blood_type); ?> value="B-">B-</option>
                <option <?php echo selected_option("B+", $child->blood_type); ?> value="B+">B+</option>
                <option <?php echo selected_option("AB-", $child->blood_type); ?> value="AB-">AB-</option>
                <option <?php echo selected_option("AB+", $child->blood_type); ?> value="AB+">AB+</option>
                <option <?php echo selected_option("O-", $child->blood_type); ?> value="O-">O-</option>
                <option <?php echo selected_option("O+", $child->blood_type); ?> value="O+">O+</option>
            </select>
        </td>
    </tr>
    <tr>
        <td><?php echo lang('status'); ?></td>
        <td>
            <select class="form-control" name="status" required>
                <option <?php echo selected_option($child->status, 1); ?> value="1">
                    <?php echo lang('active'); ?>
                </option>
                <option <?php echo selected_option($child->status, 2); ?> value="2">
                    <?php echo lang('inactive'); ?>
                </option>
            </select>
        </td>
    </tr>
    <?php if (!is('parent')): ?>
        <tr>
            <td></td>
            <td>
                <button class="btn btn-primary"><?php echo lang('update'); ?></button>
            </td>
        </tr>
    <?php endif; ?>
</table>
<?php if (!is('parent')): ?>
    <?php echo form_close(); ?>
<?php endif; ?>
