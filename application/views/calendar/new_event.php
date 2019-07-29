<div class="modal fade calendar-event-panel" id="new-event" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo lang('new_event'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span  class="sr-only"><?php echo lang('close'); ?></span>
                </button>
            </div>
            <?php echo form_open('calendar/addEvent'); ?>
            <div class="modal-body">
                <table class="table  no-border">
                    <tr>
                        <td class="text-right">
                            <span class="label-text text-info"><?php echo lang('title'); ?></span><span class="field_required"> *</span>
                        </td>
                        <td>
                            <?php echo form_input(
                                [
                                    'name' => 'title',
                                    'type' => 'text',
                                    'value' => '',
                                    'class' => 'form-control',
                                    'id' => 'event_title',
                                    'required' => 'required'
                                ]
                            ); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right">
                            <span class="label-text text-info"><?php echo lang('start'); ?></span><span class="field_required"> *</span>
                        </td>
                        <td class="input-group">
                            <?php echo form_input(
                                [
                                    'name' => 'start',
                                    'type' => 'date',
                                    'class' => 'form-control',
                                    'id' => 'start_date',
                                    'value' => date('Y-m-d'),
                                    'placeholder' => 'mm/dd/yyyy',
                                ]
                            ); ?>
                            <span class="input-group-addon"><?php echo lang('time'); ?></span>
                            <?php echo form_input(
                                [
                                    'name' => 'start_t',
                                    'type' => 'time',
                                    'class' => 'form-control',
                                    'id' => 'start_time',
                                    'value' => date('H:i'),
                                    'placeholder' => 'hh:mm ss',
                                ]
                            ); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right">
                            <span class="label-text text-info"><?php echo lang('end'); ?></span><span class="field_required"> *</span>
                        </td>
                        <td class="input-group">
                            <?php echo form_input(
                                [
                                    'name' => 'end',
                                    'type' => 'date',
                                    'class' => 'form-control',
                                    'id' => 'end_date',
                                    'value' => date('Y-m-d'),
                                    'placeholder' => 'mm/dd/yyyy',
                                ]
                            ); ?>
                            <span class="input-group-addon"><?php echo lang('time'); ?></span>
                            <?php echo form_input(
                                [
                                    'name' => 'end_t',
                                    'type' => 'time',
                                    'class' => 'form-control',
                                    'id' => 'end_time',
                                    'value' => date('H:i'),
                                    'placeholder' => 'hh:mm ss',
                                ]
                            ); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right">
                            <span class="label-text text-info"><?php echo lang('details'); ?></span><span class="field_required"> *</span>
                        </td>
                        <td>
                            <?php echo form_textarea('desc',set_value('desc'),['class'=>'form-control']); ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <?php
                echo form_button(
                    [
                        'type' => 'submit',
                        'class' => 'btn btn-primary'
                    ], lang('submit'));

                ?>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>