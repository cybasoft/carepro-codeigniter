<div class="modal fade" id="newIncidentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"><?php echo lang('incident_report'); ?></h4>
            </div>
            <?php echo form_open_multipart('child/'.$child->id.'/incident'); ?>
            <div class="modal-body">
                <?php echo form_label(lang('title'));
                echo form_input('title', null, ['class' => 'form-control', 'required' => '']);
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <?php
                        echo form_label(lang('date'));
                        echo form_date('date', date('Y-m-d'), ['class' => 'form-control', 'required' => '']);
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo form_label(lang('time'));
                        echo form_time('time', date('H:i'), ['class' => 'form-control', 'required' => '']);
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?php
                        echo form_label(lang('location'));
                        echo form_input('location', '', ['class' => 'form-control', 'required' => '']);
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo form_label(lang('incident_type'));
                        echo form_input('incident_type', '', ['class' => 'form-control', 'required' => '']);
                        ?>
                    </div>
                </div>
                <label><?php echo lang('actions_taken'); ?></label>
                <textarea name="actions_taken" class="form-control editor"></textarea>
                <label><?php echo lang('description'); ?></label>
                <textarea name="description" class="form-control editor-media"></textarea>
                <label><?php echo lang('witnesses'); ?></label>
                <textarea name="witnesses" class="form-control editor" rows="3"></textarea>
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
