<?php echo form_open('child/addFoodPref'); ?>
<?php echo form_hidden('child_id', $child->id); ?>
<h2><?php echo lang('food_pref_header'); ?></h2>
<table class="table table-responsive no-border">
    <tr>
        <td><input class="form-control" type="text" name="food" placeholder="<?php echo lang('food'); ?>"/></td>
        <td>
            <select name="food_time" class="form-control" required>
                <option value="breakfast"><?php echo lang('breakfast'); ?></option>
                <option value="brunch"><?php echo lang('brunch'); ?></option>
                <option value="lunch"><?php echo lang('lunch'); ?></option>
                <option value="dinner"><?php echo lang('dinner'); ?></option>
                <option value="other"><?php echo lang('other'); ?></option>
            </select>
        </td>
        <td>
            <input type="text" name="comment" class="form-control" placeholder="<?php echo lang('comment'); ?>"/>
        </td>
        <td>
            <button class="btn btn-default">
                <span class="fa fa-plus"></span>
            </button>
        </td>
    </tr>
</table>
<?php echo form_close(); ?>

<table class="table table-hover">
    <th><?php echo lang('food_item'); ?></th>
    <th><?php echo lang('time'); ?></th>
    <th><?php echo lang('comment'); ?></th>
    <?php
    $foods = $this->db->where('child_id', $child->id)->get('child_foodpref');
    if ($foods->num_rows() > 0) {
        foreach ($foods->result() as $item) {
            ?>
            <tr>
                <td>
                    <?php echo $item->food; ?>
                </td>
                <td>
                    <?php echo $item->food_time; ?>
                </td>
                <td>
                    <?php echo $item->comment; ?>
                </td>
                <td>
                    <a class="delete" href="<?php echo site_url(); ?>child/deleteFoodPref/<?php echo $item->id; ?>">
                        <span class="fa fa-trash-o cursor"></span>
                </td>
            </tr>
            <?php
        }
    } else {
        echo '<div class="alert alert-warning h3">' . lang('nothing_to_display') . '</div>';
    }
    ?>
</table>
