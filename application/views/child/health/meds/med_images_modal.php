<div class="modal fade" id="medImagesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><?php echo lang('Medication images'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only"><?php echo lang('close'); ?></span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('meds/uploadMedPhoto'); ?>
                <span class="field_required">*</span>
                <?php echo form_input('med_name', NULL, ['class' => 'form-control', 'placeholder' => lang('Medication name'), 'required' => '']); ?>
                <br/>
                <span class="field_required">*</span>
                <?php echo form_upload('photo', ['class' => 'form-control', 'required' => 'required']); ?>
                <br/>
                <?php echo form_button(['type' => 'submit'], lang('Submit'), ['class' => 'btn btn-primary']); ?>
                <?php echo form_close(); ?>

                <hr/>
                <div class="row">
                    <?php foreach ($medImages as $medImg): ?>
                        <div class="col-xs-2 text-center">
                            <img style="width:200px;height:150px;" src="<?php echo base_url('assets/uploads/meds/'.$medImg->photo); ?>"/>
                            <br/>
                            <?php echo $medImg->name; ?>
                            <a class="delete" href="../../meds/deleteMedicationPhoto/<?php echo $medImg->id; ?>"><i
                                        class="fa fa-trash-alt text-danger"></i> </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="modal-footer">
                <?php
                echo form_button(
                    [
                        'data-dismiss' => 'modal',
                        'class' => 'btn btn-default',
                    ], lang('close'));
                ?>
            </div>
        </div>
    </div>
</div>