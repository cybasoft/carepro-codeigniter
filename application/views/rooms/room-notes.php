<div class="card">
    <div class="card-header">
        <h4 class="card-title"><?php echo lang('notes'); ?>
            <button class="btn btn-xs btn-default pull-right" data-toggle="modal" data-target="#noteModal">
                <i class="fa fa-plus-circle"></i>
                <?php echo lang('New note'); ?>
            </button>
        </h4>
    </div>

    <div class="card-body" id="room-notes">
        <input class="search form-control" placeholder="Search"/>
        <br/>
        <a class=" sort  cursor" data-sort="room-note-date">
            Sort by date
        </a>
        <div class="list list-group">
            <?php foreach ($room->notes as $note): ?>
                <div class="list-group-item">
                    <div class="media">
                        <div class="align-self-start mr-2">
                            <img style="width:50px;height:50px;margin-right:10px;-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;"
                                 src="<?php echo $this->user->photo($note->photo); ?>"
                                 class="">
                        </div>
                        <div class="media-body">
                            <p class="mb-1">
                                <a class="text-purple m-0"
                                   href="#"><?php echo $note->name; ?></a>
                                <small class="text-muted room-note-date"> <?php echo format_date($note->created_at, TRUE); ?></small>
                            </p>
                            <div class="text-sm room-note">
                                <?php echo $note->content; ?>
                            </div>
                        </div>
                        <div class="ml-auto">
                            <a class=" delete" href="/rooms/deleteNote/<?php echo $note->id; ?>">
                                <i class="fa fa-trash-alt text-danger"></i></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <ul class="pagination"></ul>
    </div>
</div>

<div class="modal fade" id="noteModal" tabindex="-1" role="dialog" aria-labelledby="noteModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="noteModalLabel"><?php echo lang('New note'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only"><?php echo lang('close'); ?></span>
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