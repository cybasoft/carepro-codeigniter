<div class="child-thumb text-center" style="width:100%;position:relative;background:#fff;">
    <img style="width:150px;height:150px;" src="<?php echo $this->child->photo($child->photo); ?>"
         class="">

    <?php if(!is('parent')): ?>
        <div style="position:absolute;bottom:-5px;background:#333;width:100%;opacity:0.8;"
             class="text-center cursor"
             data-toggle="modal" data-target="#new-photo">
            <i class="fa fa-pencil-alt" style="color:#fff"></i>
        </div>
    <?php endif; ?>
</div>
<br/>
<div class="modal fade" id="new-photo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">
                    <?php echo lang('upload'); ?>
                    -
                    <?php echo $child->last_name.', '.$child->first_name; ?>
                </h4>

                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">
                        <?php echo lang('close'); ?></span></button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('child/'.$child->id.'/uploadPhoto', 'class="input-group"'); ?>
                <span class="field_required mr-1">*</span>
                <input class="form-control" type="file" name="userfile" size="20"/>
                <button class="btn btn-info input-group-btn" type="submit">
                    <?php echo lang('upload'); ?></button>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
