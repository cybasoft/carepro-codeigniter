<div class="child-thumb" style="width:100%;position:relative">
    <img style="width:150px;height:150px;" src="<?php echo $this->child->photo($child->photo); ?>"
        class="img-square img-responsive img-thumbnail">

    <?php if (!is('parent')): ?>
    <div style="position:absolute;bottom:-5px;background:#ccc;width:100%;opacity:0.8;border-radius:0 0 5px 5px" class="text-center cursor"
        data-toggle="modal" data-target="#new-photo">
        <i class="material-icons md-18">edit</i>
    </div>
    <?php endif; ?>

</div>
<div class="modal fade" id="new-photo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">
                        <?php echo lang('close'); ?></span></button>
                <h4 class="modal-title" id="myModalLabel">
                    <?php echo lang('upload'); ?>
                    -
                    <?php echo $child->last_name . ', ' . $child->first_name; ?>
                </h4>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('child/' . $child->id . '/uploadPhoto', 'class="input-group"'); ?>

                <input class="form-control" type="file" name="userfile" size="20" />


                <span class="input-group-btn">
                    <button class="btn btn-info" type="submit">
                        <?php echo lang('upload'); ?></button>
                </span>

                <?php echo form_close(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <?php echo lang('cancel'); ?></button>

            </div>
        </div>
    </div>
</div>
