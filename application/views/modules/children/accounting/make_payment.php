<!-- Modal -->
<div class="modal fade" id="make_payment" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo lang('make_payment'); ?></h4>
            </div>
            <div class="modal-body">
                <?php echo form_open('invoice/make_payment/' . $this->uri->segment(3)); ?>
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
                            <input name="amount_paid" value="" class="form-control" required=""/>
                        </td>

                        <td style="width:160px">
							<div class="form-group input-group date">
								<input class="datepicker1 form-control" size="16" type="text" name="date_paid"
									   readonly required="" style="z-index: 3000" value="<?php echo date('m/d/Y'); ?>"/>
                         <span class="input-group-addon add-on">
                             <i class="glyphicon glyphicon-calendar" style="display: inline"></i>
                         </span>
							</div>
                        </td>
                        <td>
                            <select name="payment_method" class="form-control">
                                <?php
                                echo '<option>--' . lang('select') . '--</option>';
                                foreach ($this->db->get('accnt_pay_methods')->result() as $row) {
                                    echo '<option value="' . $row->id . '">' . $row->name . '</option>';
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
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button class="btn btn-primary">Save</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<script>
	$('.datepicker1').datepicker({autoclose: true, startDate: '-30d', format: 'dd-mm-yyyy'});

</script>