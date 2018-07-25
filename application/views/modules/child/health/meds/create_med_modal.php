
<div class="modal fade" id="newMedModal" tabindex="-1" role="dialog" aria-labelledby="newMedModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="newMedModalLabel"><?php echo lang('New medication'); ?></h4>
            </div>
            <?php echo form_open_multipart('meds/addMedicationToChild'); ?>
            <div class="modal-body">
                <?php echo form_hidden('child_id', $child->id);
                echo form_label(lang('medication'), 'med_name');
                echo form_input('med_name', null, ['class' => 'form-control','required'=>'']);
                echo form_label(lang('notes'), 'med_notes');
                echo form_input('med_notes', null, ['class' => 'form-control']);
                echo form_label(lang('Medication photo'), 'photo');
                ?>
                <select name="photo_id" class="form-control">
                    <option><?php echo lang('select'); ?></option>
                    <?php foreach ($this->db->get('med_photos')->result() as $photo): ?>
                        <option value="<?php echo $photo->id; ?>"><?php echo $photo->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="modal-footer">
                <?php
                echo form_button(
                    [
                        'type' => 'submit',
                        'class' => 'btn btn-primary'
                    ], lang('submit'));
                echo form_button(
                    [
                        'data-dismiss' => 'modal',
                        'class' => 'btn btn-default'
                    ], lang('close'));
                ?>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>