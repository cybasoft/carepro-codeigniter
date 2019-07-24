
<div class="modal fade" id="newMedModal" tabindex="-1" role="dialog" aria-labelledby="newMedModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="newMedModalLabel"><?php echo lang('New medication'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span  class="sr-only"><?php echo lang('close'); ?></span>
                </button>
            </div>
            <?php echo form_open_multipart('meds/addMedicationToChild'); ?>
            <div class="modal-body">
                <?php echo form_hidden('child_id', '');
                echo form_label(lang('medication'), 'med_name' , ['class' => 'required']);
                echo form_input('med_name', null, ['class' => 'form-control','required'=>'','id' => 'med_name']);
                echo form_label(lang('notes'), 'med_notes');
                echo form_input('med_notes', null, ['class' => 'form-control']);
                echo form_label(lang('Medication photo'), 'photo');
                ?>
                <select name="photo_id" class="form-control">
                    <option><?php echo lang('select'); ?></option>
                    <?php foreach ($medImages as $image): ?>
                        <option value="<?php echo $image->id; ?>"><?php echo $image->name; ?></option>
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