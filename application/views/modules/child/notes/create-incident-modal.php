<div class="modal fade" id="newIncidentModal" tabindex="-1" role="dialog" aria-labelledby="newIncidentLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id=newIncidentLabel"><?php echo lang('incident_report'); ?></h4>
            </div>
            <?php echo form_open_multipart('notes/createIncident'); ?>
            <?php echo form_hidden('child_id', $child->id); ?>
            <div class="modal-body">
                <?php
                echo form_label(lang('title'));
                echo form_input('title', null, ['class' => 'form-control', 'required' => '']);
                //
                echo '<div class="row">';
                echo '<div class="col-md-6">';
                echo form_label(lang('date'));
                echo form_date('date', date('Y-m-d'), ['class' => 'form-control', 'required' => '']);
                echo '</div>';
                echo '<div class="col-md-6">';
                echo form_label(lang('time'));
                echo form_time('time', date('H:i'), ['class' => 'form-control', 'required' => '']);
                echo '</div>';
                echo '</div>';
                //
                echo '<div class="row">';
                echo '<div class="col-md-6">';
                echo form_label(lang('location'));
                echo form_input('location', '', ['class' => 'form-control', 'required' => '']);
                echo '</div>';
                echo '<div class="col-md-6">';
                echo form_label(lang('incident_type'));
                echo form_input('incident_type', '', ['class' => 'form-control', 'required' => '']);
                echo '</div>';
                echo '</div>';
                //
                echo form_label(lang('Actions taken'));
                echo form_textarea('actions_taken', null, ['class' => 'form-control']);
                echo form_label(lang('Description'));
                echo form_textarea('description', null, ['class' => 'form-control editor-media']);
                echo form_label(lang('Witntesses'));
                echo form_textarea('witnesses', null, ['class' => 'form-control']);
                echo form_label(lang('Remarks'));
                echo form_input('remarks', null, ['class' => 'form-control']);
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('close'); ?></button>
                <button class="btn btn-primary"><?php echo lang('submit'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
