<div class="modal fade" id="newNoteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"><?php echo lang('new_note'); ?></h4>
            </div>
            <?php echo form_open('child/' . $child->id . '/addNote'); ?>
            <div class="modal-body">
                <label><?php echo lang('title'); ?></label>
                <input type="text" name="title" required class="form-control"/>
                <label><?php echo lang('content'); ?></label>
                <textarea class="form-control editor-media" rows="5"  name="note-content"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('close'); ?></button>
                <button  class="btn btn-primary"><?php echo lang('submit'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>