<div class="modal fade" id="medImagesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"><?php echo lang('Medication images'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="callout callout-info">
                    <?php echo form_open_multipart('meds/uploadMedPhoto'); ?>
                    <div class="row">
                        <div class="col-xs-5">
                            <?php echo form_input('med_name', null, ['class' => 'form-control', 'placeholder' => lang('Medication name')]); ?>
                        </div>
                        <div class="col-xs-5">
                            <?php echo form_upload('photo', null, ['class' => 'form-control', 'required' => 'required']); ?>
                        </div>
                        <div class="col-xs-2">
                            <?php echo form_button(['type' => 'submit'], lang('Submit'), ['class' => 'btn btn-primary']); ?>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
                <div class="row">
                    <?php foreach ($this->db->get('med_photos')->result() as $medImg): ?>
                        <div class="col-xs-2 text-center">
                            <img src="<?php echo base_url('assets/uploads/meds/'.$medImg->photo); ?>"/>
                            <br/>
                            <?php echo $medImg->name; ?>
                            <a class="delete" href="/meds/deleteMedicationPhoto/<?php echo $medImg->id; ?>"><i
                                        class="fa fa-trash-alt text-danger"></i> </a>
                        </div>
                    <?php endforeach; ?>
                </div>
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
        </div>
    </div>
</div>