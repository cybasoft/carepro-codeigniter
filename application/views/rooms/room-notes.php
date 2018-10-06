<div class="card">
    <div class="card-header">
        <h4 class="card-title"><?php echo lang('notes'); ?>
            <button class="btn btn-xs btn-default pull-right" data-toggle="modal" data-target="#noteModal">
                <i class="fa fa-plus-circle"></i>
                <?php echo lang('New note'); ?>
            </button>
        </h4>

    </div>
    <div class="card-body">
        <?php foreach ($notes as $note): ?>
            <div class="info-box">
                <div class="info-box-img">
                    <img style="width:40px;margin-right:10px;" src="<?php echo $this->user->photo($note->user_id); ?>"
                         class="pull-left">
                </div>
                <div class="info-box-text">
                    <a href="#"><?php echo $this->user->get($note->user_id, 'name'); ?></a>
                    <span class="small pull-right"><?php echo format_date($note->created_at, true); ?>
                        <a class=" delete" href="/rooms/deleteNote/<?php echo $note->id; ?>">
                            <i class="fa fa-trash-alt text-danger"></i>
                        </a>
                    </span>
                </div>
                <div class="info-box-notes">
                    <?php echo $note->content; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="modal fade" id="noteModal" tabindex="-1" role="dialog" aria-labelledby="noteModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="noteModalLabel"><?php echo lang('New note'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span  class="sr-only"><?php echo lang('close'); ?></span>
                </button>
            </div>
            <?php echo form_open('rooms/addNote'); ?>
            <?php echo form_hidden('room_id', $room->id); ?>
            <div class="modal-body">
                <?php echo form_label(lang('Notes'));
                echo form_textarea('notes', '', ['class' => 'form-control']);
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