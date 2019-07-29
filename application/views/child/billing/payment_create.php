<!-- Modal -->
<div class="modal fade" id="payModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><?php echo lang('Manual payment entry'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span  class="sr-only"><?php echo lang('close'); ?></span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open('invoice/' . $invoice[0]->id.'/makePayment'); ?>
                <div class="row">
                    <div class="col-sm-6">
                        <?php echo lang('amount'); ?><span class="field_required"> *</span>
                    </div>
                    <div class="col-sm-6">
                        <input type="number" step="0.01" name="amount" value="" class="form-control" required=""/>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-sm-6"><?php echo lang('date'); ?></div>
                    <div class="col-sm-6">
                        <input class="form-control" size="16" type="date" name="date_paid"
                               required="" style="z-index: 3000" value="<?php echo date('Y-m-d'); ?>"/>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-sm-6"><?php echo lang('payment_method'); ?></div>
                    <div class="col-sm-6">
                        <select name="method" class="form-control">
                            <?php
                            foreach ($this->db->get('payment_methods')->result() as $row) {
                                echo '<option value="' . $row->title . '">' . $row->title . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <label><?php echo lang('remarks'); ?></label>
                        <br/>
                        <textarea name="remarks" class="form-control"></textarea>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button class="btn btn-primary"><?php echo lang('submit'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>