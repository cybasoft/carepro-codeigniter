<div class="modal fade" id="newIncidentModal" tabindex="-1" role="dialog" aria-labelledby="newIncidentLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id=newIncidentLabel"><?php echo lang('incident_report'); ?></h4>

                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only"><?php echo lang('close'); ?></span></button>
            </div>
            <?php echo form_open_multipart('notes/createIncident'); ?>
            <?php echo form_hidden('child_id', $child->id); ?>
            <div class="modal-body">
                <?php
                echo form_label(lang('title'));
                echo form_input('title', set_value('title'), ['class' => 'form-control', 'required' => '']);
                //
                echo '<div class="row">';
                echo '<div class="col-md-6">';
                echo form_label(lang('date'));
                echo form_date('date', set_value('date',date('Y-m-d')), ['class' => 'form-control', 'required' => '']);
                echo '</div>';
                echo '<div class="col-md-6">';
                echo form_label(lang('time'));
                echo form_time('time', set_value('time',date('H:i')), ['class' => 'form-control', 'required' => '']);
                echo '</div>';
                echo '</div>';
                //
                echo '<div class="row">';
                echo '<div class="col-md-6">';
                echo form_label(lang('location'));
                echo form_input('location', set_value('location'), ['class' => 'form-control', 'required' => '']);
                echo '</div>';
                echo '<div class="col-md-6">';
                echo form_label(lang('incident_type'));
                echo form_input('incident_type', set_value('incident_type'), ['class' => 'form-control', 'required' => '']);
                echo '</div>';
                echo '</div>';
                //
                echo form_label(lang('Actions taken'));
                echo form_textarea('actions_taken', set_value('actions_taken'), ['class' => 'form-control']);
                echo form_label(lang('Description'));
                echo form_textarea('description', htmlspecialchars_decode(set_value('description')), ['class' => 'form-control editor']);
                echo form_label(lang('Witntesses'));
                echo form_textarea('witnesses', set_value('witnesses'), ['class' => 'form-control','required'=>'']);
                echo form_label(lang('Remarks'));
                echo form_input('remarks', set_value('remarks'), ['class' => 'form-control']);
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
