<h2><?php echo lang('medications'); ?>
    <button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#newMedModal">
        <span class="fa fa-plus"></span>
        <?php echo lang('add'); ?>
    </button>
    <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#medImagesModal">
        <span class="fa fa-plus"></span>
        <?php echo lang('Medication images'); ?>
    </button>
</h2>

<hr/>

<div class="row">
    <div class="col-lg-12">
        <?php
        $this->db->where('child_id', $child->id);
        $meds = $this->db->get('child_meds');
        ?>
        <?php if($meds->num_rows()>0): ?>
            <?php foreach ($meds->result() as $med) {
                ?>
                <div class="info-box">
                    <div class="info-box-icon"
                         style="background:#fff url('<?php echo $this->health->medPhoto($med->photo_id); ?>');background-size: 64px;
                                 background-repeat: no-repeat;">
                    </div>
                    <div class="info-box-content">
                        <span class="info-box-text text-warning"><?php echo $med->med_name; ?></span>
                        <?php echo $med->med_notes; ?>
                        <?php if(!is('parent')): ?>
                            <a href="<?php echo site_url('child/deleteMedication/'.$med->id); ?>"
                               class="delete pull-right">
                                <span class="fa fa-trash-alt cursor"></span>
                            </a>
                        <?php endif; ?>
                        <!--div class="info-box-more">
                            <a href="#"><?php echo lang('Administer'); ?></a> |
                            <a href="#"><?php echo lang('View history'); ?></a> |
                            <a href="#"><?php echo lang('Print history'); ?></a>
                        </div-->
                    </div>
                </div>
                <?php
            }
            ?>

        <?php else: ?>
            <h3 class="alert alert-warning"><?php echo lang('nothing_to_display'); ?></h3>
        <?php endif; ?>
    </div>
</div>

<div class="modal fade" id="newMedModal" tabindex="-1" role="dialog" aria-labelledby="newMedModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="newMedModalLabel"><?php echo lang('New medication'); ?></h4>
            </div>
            <?php echo form_open_multipart('child/addMedication'); ?>
            <div class="modal-body">
                <?php echo form_hidden('child_id', $child->id);
                echo form_label(lang('medication'), 'med_name');
                echo form_input('med_name', null, ['class' => 'form-control']);
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
            <?php
                echo form_open_multipart('health/addMedicationPhoto'); ?>
                <div class="row">
                <div class="col-xs-5">
                  <?php
                  echo form_input('med_name',null,['class'=>'form-control','placeholder'=>lang('Medication name')]);
                ?>
                </div>
                <div class="col-xs-5">
                 <?php
                echo form_upload('photo',null,['class'=>'form-control','required'=>'required']);
                ?>
                </div>
                <div class="col-xs-2">
                  <?php
                echo form_button(['type'=>'submit'],lang('Submit'),['class'=>'btn btn-primary']);
                ?>
                </div>
                </div>

             <?php
                echo form_close();
                 ?>
                 </div>
                <div class="row">
                    <?php foreach ($this->db->get('med_photos')->result() as $medImg): ?>
                        <div class="col-xs-2 text-center">
                            <img src="<?php echo base_url('assets/uploads/meds/'.$medImg->photo); ?>"/>
                            <br/>
                            <?php echo $medImg->name; ?>
                            <a class="delete" href="/health/deleteMedicationPhoto/<?php echo $medImg->id; ?>"><i
                                        class="fa fa-trash-alt text-danger"></i> </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>