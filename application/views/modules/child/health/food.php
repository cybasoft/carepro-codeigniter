<h2><?php echo lang('food_pref_header'); ?>

    <button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#myModal">
        <i class="fa fa-plus-circle"></i> <?php echo lang('Add new'); ?>
    </button>

</h2>

<table class="table table-hover">
    <th><?php echo lang('food_item'); ?></th>
    <th><?php echo lang('time'); ?></th>
    <th><?php echo lang('comment'); ?></th>
    <?php
    $foods = $this->db->where('child_id', $child->id)->get('child_foodpref');
    if($foods->num_rows()>0) {
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
                    <?php if(!is('parent')): ?>
                    <a class="delete" href="<?php echo site_url('child/deleteFoodPref/'.$item->id); ?>">
                        <span class="fa fa-trash-alt cursor"></span>
                        <?php endif; ?>
                </td>
            </tr>
            <?php
        }
    } else {
        echo '<div class="alert alert-warning h3">'.lang('nothing_to_display').'</div>';
    }
    ?>
</table>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    <?php echo lang('New food preference'); ?>
                </h4>
            </div>

            <?php echo form_open('child/addFoodPref'); ?>
            <?php echo form_hidden('child_id', $child->id); ?>

            <div class="modal-body">
                <?php
                echo form_label(lang('Food name'));
                echo form_input('food', null, ['class' => 'form-control', 'required' => '']);

                echo form_label(lang('Meal time'));
                echo form_dropdown('food_time',
                    [
                        'breakfast' => lang('breakfast'),
                        'brunch' => lang('brunch'),
                        'lunch' => lang('lunch'),
                        'dinner' => lang('dinner'),
                        'other' => lang('other')
                    ], null,
                    [
                        'class' => 'form-control'
                    ]
                );

                echo form_label(lang('comment'));
                echo form_input('comment', null, ['class' => 'form-control']);
                ?>
            </div>
            <div class="modal-footer">
                <?php
                echo form_button(
                    [
                        'type' => 'submit',
                        'class' => 'btn btn-primary'
                    ], lang('submit'));
                echo form_button(
                    [
                        'data-dismiss' => 'modal',
                        'class' => 'btn btn-default'
                    ], lang('close'));
                ?>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>