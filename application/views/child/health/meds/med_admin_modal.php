<div class="modal fade" id="medAdminModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">
                    <?php echo lang('Medication administration'); ?>
                </h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span  class="sr-only"><?php echo lang('close'); ?></span>
                </button>
            </div>
            <?php echo form_open('meds/administer'); ?>
            <?php echo form_hidden('child_id', $child->id); ?>
            <?php echo form_hidden('med_id', ''); ?>
            <div class="modal-body">
                <h4 class="medName"></h4>
                <p class="medNotes"></p>
                <div class="row">
                    <div class="col-sm-6">
                        <?php echo form_label(lang('Date'), 'date');
                        echo form_date('date', date('Y-m-d'), ['class' => 'form-control']);
                        ?>
                    </div>
                    <div class="col-sm-6">
                        <?php
                        echo form_label(lang('Time'), 'time');
                        echo form_time('time', date('H:i'), ['class' => 'form-control']);
                        ?>
                    </div>
                </div>

                <?php
                echo form_label(lang('Remarks'), 'remarks');
                echo form_textarea('remarks', null, ['class' => 'form-control']);
                ?>
                <label>
                    <?php echo form_radio('staff_only',1); ?>
                    <?php echo lang('Staff only'); ?>
                </label>
            </div>
            <div class="modal-footer">
                <?php
                echo form_button(
                    [
                        'type' => 'submit',
                        'class' => 'btn btn-primary'
                    ], lang('submit'));
                ?>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>