<h2><?php echo lang('medications'); ?>
    <button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#newMedModal">
        <span class="fa fa-plus"></span>
        <?php echo lang('add'); ?>
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
                    <div class="info-box-icon">

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
                        <div class="info-box-more">
                            <a href="#"><?php echo lang('Administer'); ?></a> |
                            <a href="#"><?php echo lang('View history'); ?></a> |
                            <a href="#"><?php echo lang('Print history'); ?></a>
                        </div>
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
            <?php echo form_open('child/addMedication'); ?>
            <div class="modal-body">
                <?php echo form_hidden('child_id', $child->id);
                echo form_label(lang('medication'), 'med_name');
                echo form_input('med_name', null, ['class' => 'form-control']);
                echo form_label(lang('notes'), 'med_notes');
                echo form_input('med_notes', null, ['class' => 'form-control']);
                ?>
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