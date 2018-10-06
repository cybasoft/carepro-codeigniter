<div class="card">
	<div class="card-header">
		<h4 class="card-title">
            <?php if(is(['admin','manager'])): ?>
                <button type="button" class="btn btn-primary card-tools" data-toggle="modal" data-target="#newRoomModal">
                    <i class="fa fa-plus-circle"></i> <?php echo lang('Create new'); ?>
                </button>
            <?php endif; ?>
        </h4>

	</div>
	<div class="card-body">

        <div class="row">

            <?php foreach ($rooms as $room): ?>
                <div class="col-md-3 cursor"
                     onclick="window.location.href='<?php echo site_url('rooms/view/'.$room->id); ?>'"
                     id="<?php echo $room->id; ?>">

                    <div class="box box-solid box-warning">
                        <div class="box-header">
                            <h4 class="box-title">
                                <?php echo $room->name; ?></h4>
                        </div>
                        <div class="box-body">
                            <p style="font-size:12px;color:#ccc"><?php echo $room->description; ?></p>
                        </div>

                        <div class="card-footer">
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
	</div>
</div>

<div class="modal fade" id="newRoomModal" tabindex="-1" role="dialog" aria-labelledby="newRoomModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="newRoomModalLabel"><?php echo lang('New children room'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span  class="sr-only"><?php echo lang('close'); ?></span>
                </button>
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
