<div class="modal fade" id="newIncidentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"><?php echo lang('incident_report'); ?></h4>
            </div>
            <?php echo form_open_multipart('child/' . $child->id . '/incident'); ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <label><?php echo lang('date'); ?></label>
                        <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" required/>
                    </div>
                    <div class="col-sm-6">
                        <label><?php echo lang('time'); ?></label>
                        <input type="time" name="time" value="<?php echo date('H:i'); ?>" class="form-control" required/>
                    </div>
                </div>

                <label><?php echo lang('title'); ?></label>
                <input type="text" name="title" class="form-control" required/>

                <label><?php echo lang('location'); ?> <em>(<?php echo lang('incident_location_help'); ?>)</em></label>
                <input type="text" name="location" class="form-control" required/>

                <label><?php echo lang('incident_type'); ?></label>
                <em>(<?php echo lang('incident_type_help'); ?></em>
                <input type="text" name="incident_type" class="form-control" required/>

                <label><?php echo lang('actions_taken'); ?></label>
                <textarea name="actions_taken" class="form-control editor"></textarea>

                <label><?php echo lang('description'); ?></label>
                <textarea name="description" class="form-control editor"></textarea>

                <label><?php echo lang('witnesses'); ?></label>
                <textarea name="witnesses" class="form-control" rows="3"></textarea>

                <label><?php echo lang('remarks'); ?></label>
                <textarea name="remarks" class="form-control editor"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('close'); ?></button>
                <button class="btn btn-primary"><?php echo lang('submit'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>