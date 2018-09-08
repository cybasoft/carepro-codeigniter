<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">
                    <?php echo lang('Edit room'); ?>
                </h4>
            </div>
            <?php echo form_open('rooms/update'); ?>
            <?php echo form_hidden('room_id', $room->id); ?>
            <div class="modal-body">
                <?php
                echo form_label(lang('name'), 'name');
                echo form_input('name', $room->name, ['class' => 'form-control']);

                echo form_label(lang('description'), 'descriptoin');
                echo form_input('description', $room->description, ['class' => 'form-control']);
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