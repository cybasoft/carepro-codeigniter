<div class="modal fade" id="childrenModal" tabindex="-1" role="dialog" aria-labelledby="childrenModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"
                    id="childrenModalLabel"><?php echo lang('select children to assign'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only"><?php echo lang('close'); ?></span>
                </button>
            </div>
            <?php echo form_open('rooms/assignChildren'); ?>
            <?php echo form_hidden('room_id', $room->id); ?>

            <div class="modal-body">

                <div id="room-children">
                    <div class="input-group">
                        <input class="search form-control" placeholder="Search"/>
                        <button class="sort btn btn-primary input-group-btn" data-sort="childname">
                            <?php echo lang('search'); ?>
                        </button>
                    </div>
                    <hr/>
                    <div class="list">
                        <?php foreach ($allChildren as $c): ?>
                            <label class="checkbox-inline">
                                    <input type="checkbox"
                                           name="child_id[]" <?php echo (related('child_room', 'child_id', $c->id, 'room_id', $room->id)) ? 'checked' : ''; ?>
                                           value="<?php echo $c->id; ?>"/>
                                <span class="childname"><?php echo $c->first_name.' '.$c->last_name; ?></span>
                            </label>
                            <br/>
                        <?php endforeach; ?>
                    </div>
                </div>

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