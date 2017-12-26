<?php
$start = array(
    'name'  => 'start',
    'type'  => 'date',
    'class' => 'form-control',
    'id'    => 'start_date',
    'value' => date('Y-m-d'),
    'placeholder'=>'mm/dd/yyyy',
);
$start_time = array(
    'name'  => 'start_t',
    'type'  => 'time',
    'class' => 'form-control',
    'id'    => 'start_time',
    'value' => date('H:i'),
    'placeholder'=>'hh:mm ss',
);
$end = array(
    'name'  => 'end',
    'type'  => 'date',
    'class' => 'form-control',
    'id'    => 'end_date',
    'value' => date('Y-m-d'),
    'placeholder'=>'mm/dd/yyyy',
);
$end_time = array(
    'name'  => 'end_t',
    'type'  => 'time',
    'class' => 'form-control',
    'id'    => 'end_time',
    'value' => date('H:i'),
    'placeholder'=>'hh:mm ss',
);

$title = array(
    'name'  => 'title',
    'type'  => 'text',
    'value' => '',
	'class'=>'form-control',
    'id'=>'event_title',
    'required'=>'required'
);
?>

<div class="modal fade calendar-event-panel"
     id="new-event"
     tabindex="-1"
     role="dialog"
     aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span
                        class="sr-only"><?php echo lang('close'); ?></span></button>
                <h4 class="modal-title text-danger"><?php echo lang('new_event'); ?></h4>
            </div>
            <div class="modal-body">

                <?php echo form_open('calendar/addEvent'); ?>
                <table class="table table-hover table-responsive">
                    <tr>
                        <td class="text-right">
                            <span class="label-text text-info"><?php echo lang('title'); ?></span>
                        </td>
                        <td>
                            <?php echo form_input($title); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right">
                            <span class="label-text text-info"><?php echo lang('start'); ?></span>
                        </td>
                        <td class="input-group">
                            <?php echo form_input($start); ?>
                            <span class="input-group-addon"><?php echo lang('time'); ?></span>
                            <?php echo form_input($start_time); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right">
                            <span class="label-text text-info"><?php echo lang('end'); ?></span>
                        </td>
                        <td class="input-group">
                            <?php echo form_input($end); ?>
                            <span class="input-group-addon"><?php echo lang('time'); ?></span>
                            <?php echo form_input($end_time); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right">
                            <span class="label-text text-info"><?php echo lang('details'); ?></span>
                        </td>
                        <td>
							<textarea class="form-control editor" name="desc" rows="10"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('close'); ?></button>
                            <button class="btn btn-primary"><?php echo lang('update'); ?></button>
                        </td>
                    </tr>
                </table>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>