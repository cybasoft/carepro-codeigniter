<div class="modal fade" id="newChildModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"><?php echo lang('register_child'); ?></h4>
            </div>
            <?php echo form_open('child/register'); ?>
            <div class="modal-body">
                <label><?php echo lang('first_name'); ?></label>
                <input class="form-control" type="text" name="first_name" value="" required=""/>

                <label><?php echo lang('last_name'); ?></label>
                <input class="form-control" type="text" name="last_name" value="" required=""/>

                <label><?php echo lang('birthday'); ?></label>
                <input class="form-control" id="bday" type="date" name="bday" value="" required=""
                       placeholder="mm/dd/yyyy"/>
                <label><?php echo lang('national_id'); ?> </label>
                <input class="form-control" type="text" name="national_id" value="" required=""/>
                <label><?php echo lang('gender'); ?></label>
                <select class="form-control" name="gender" required="">
                    <option value="">--<?php echo lang('select'); ?>--</option>
                    <option value="1"><?php echo lang('male'); ?></option>
                    <option value="2"><?php echo lang('female'); ?></option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('close'); ?></button>
                <button class="btn btn-primary"><?php echo lang('submit'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>