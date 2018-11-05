<?php if(is(['admin', 'manager'])): ?>
    <button type="button" class="btn btn-primary card-tools" data-toggle="modal" data-target="#newRoomModal">
        <i class="fa fa-plus-circle"></i> <?php echo lang('Create new'); ?>
    </button>

    <div class="modal fade" id="newRoomModal" tabindex="-1" role="dialog" aria-labelledby="newRoomModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="newRoomModalLabel"><?php echo lang('New children room'); ?></h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only"><?php echo lang('close'); ?></span>
                    </button>
                </div>
                <?php echo form_open('rooms/store'); ?>
                <div class="modal-body">
                    <?php
                    echo form_label(lang('name'), 'name');
                    echo form_input('name', NULL, ['class' => 'form-control', 'required' => 'required']);

                    echo form_label(lang('description'), 'description');
                    echo form_input('description', NULL, ['class' => 'form-control']);
                    ?>
                </div>
                <div class="modal-footer">
                    <?php
                    echo form_button(
                        [
                            'type' => 'submit',
                            'class' => 'btn btn-primary',
                        ], lang('submit'));
                    echo form_button(
                        [
                            'data-dismiss' => 'modal',
                            'class' => 'btn btn-default',
                        ], lang('close'));
                    ?>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

<?php endif; ?>