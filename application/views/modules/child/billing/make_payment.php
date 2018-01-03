<!-- Modal -->
<div class="modal fade" id="payModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only"><?php echo lang('close'); ?></span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo lang('make_payment'); ?></h4>
            </div>
            <div class="modal-body">
                <?php echo form_open('invoice/' . $invoice->id.'/makePayment'); ?>
                <table class="table table-responsive table-stripped">
                    <thead>
                    <tr class="table_header">
                        <th class="text-right"><?php echo lang('amount'); ?></th>
                        <th class="text-right"><?php echo lang('date'); ?></th>
                        <th class="text-right"><?php echo lang('payment_method'); ?></th>
                        <th class="text-right"><?php echo lang('remarks'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td style="width:10%">
                            <input name="amount" value="" class="form-control" required=""/>
                        </td>

                        <td style="width:160px">
                            <div class="form-group input-group date">
                                <input class="form-control" size="16" type="date" name="date_paid"
                                       required="" style="z-index: 3000" value="<?php echo date('Y-m-d'); ?>"/>
                            </div>
                        </td>
                        <td>
                            <select name="method" class="form-control">
                                <?php
                                foreach ($this->db->get('payment_methods')->result() as $row) {
                                    echo '<option value="' . $row->id . '">' . $row->title . '</option>';
                                }
                                ?>
                            </select>
                        </td>
                        <td style="width:40%">
                            <textarea name="remarks" class="form-control"></textarea>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('close'); ?></button>
                <button class="btn btn-primary"><?php echo lang('submit'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>