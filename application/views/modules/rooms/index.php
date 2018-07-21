<?php $rooms = $this->db->get('child_rooms'); ?>
<?php if(is('admin') || is('manager')): ?>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newRoomModal">
        <i class="fa fa-plus-circle"></i> <?php echo lang('Create new'); ?>
    </button>
    <hr/>

    <div class="modal fade" id="newRoomModal" tabindex="-1" role="dialog" aria-labelledby="newRoomModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="newRoomModalLabel"><?php echo lang('New children room'); ?></h4>
                </div>
                <?php echo form_open('rooms/store'); ?>
                <div class="modal-body">
                    <?php
                    echo form_label(lang('name'), 'name');
                    echo form_input('name', null, ['class' => 'form-control', 'required' => 'required']);

                    echo form_label(lang('description'), 'description');
                    echo form_input('description', null, ['class' => 'form-control']);
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
<?php endif; ?>

<div class="row">

    <?php foreach ($rooms->result() as $room): ?>

        <div class="col-md-3 cursor"
             onclick="window.location.href='<?php echo site_url('rooms/view/'.$room->id); ?>'"
             id="<?php echo $room->id; ?>">

            <div class="box box-info">
                <div class="box-body">
                    <?php echo $room->name; ?>
                    <p style="font-size:12px;color:#ccc"><?php echo $room->description; ?></p>
                </div>

                <div class="box-footer">
                    <div class="row text-sm">
                        <div class="col-md-6">
                            <span class="label label-success"><?php echo $this->child->roomCount($room->id, 'staff'); ?></span>
                            <?php echo lang('staff'); ?>
                        </div>
                        <div class="col-md-6">
                            <i class="label label-success"><?php echo $this->child->roomCount($room->id, 'children'); ?></i>
                            <?php echo lang('children'); ?>
                        </div>
                    </div>

                    <?php if(isset($_GET['room']) && $_GET['room'] == $room->id): ?>
                        <span class="arrow-right"></span>
                    <?php endif; ?>
                </div>
            </div>

        </div>

    <?php endforeach; ?>
</div>

