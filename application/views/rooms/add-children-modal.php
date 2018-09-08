
<div class="modal fade" id="childrenModal" tabindex="-1" role="dialog" aria-labelledby="childrenModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"
                    id="childrenModalLabel"><?php echo lang('select children to assign'); ?></h4>
            </div>
            <?php echo form_open('rooms/assignChildren'); ?>
            <?php echo form_hidden('room_id', $room->id); ?>

            <div class="modal-body">

                <div id="children">
                    <input class="search" placeholder="Search"/>
                    <button class="sort" data-sort="childname">
                        <?php echo lang('search'); ?>
                    </button>
                    <div class="list">
                        <?php foreach ($allChildren as $c): ?>
                            <label class="checkbox-inline">
                                <input type="checkbox"
                                       name="child_id[]"
                                    <?php echo (related('child_room', 'child_id', $c->id, 'room_id', $room->id)) ? 'checked' : ''; ?>
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
<script>
    var childrenOpts = {
        valueNames: ['childname']
    };

    new List('children', childrenOpts);
</script>