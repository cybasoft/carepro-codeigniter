<div class="modal show" id="parentsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><?php echo lang('Assign').' '.lang('Parent'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open('child/'.$child_id.'/assignParent'); ?>
            <div class="modal-body">                
                <div class="pull-left">
                    <select class="form-control" name="parent">
                        <option value="">--<?php echo ucwords(lang('select')); ?>--</option>
                        <?php
                        foreach ($this->parent->parents()->result() as $row): ?>
                            <option class="form-control"
                                    value="<?php echo $row->user_id; ?>"><?php echo $row->first_name.' '.$row->last_name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <br/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('Close'); ?></button>
                <button class="btn btn-primary"><?php echo lang('Assign'); ?></button>
            </div>
            <?php echo form_close(); ?>

        </div>
    </div>
</div>