<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo lang('new_charge'); ?></h4>
            </div>
            <div class="modal-body">
                <?php echo form_open('invoice/add_charge/' . $this->uri->segment(3)); ?>
                <table class="table table-responsive table-stripped">
                    <thead>
                    <tr class="table_header">
                        <th><?php echo lang('item'); ?></th>
                        <th><?php echo lang('description'); ?></th>
                        <th><?php echo lang('quantity'); ?></i></th>
                        <th class="text-right"><?php echo lang('amount'); ?></th>
                        <th class="text-right"><?php echo lang('discount'); ?></th>
                        <th class="text-right"><?php echo lang('sub_total'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td style="width:20%">
                            <input name="item_name[]" value="" class="form-control" required=""/>
                        </td>
                        <td><textarea name="item_description[]" class="form-control" required=""></textarea>
                        </td>

                        <td style="width:5%">
                            <input class="form-control" onchange="javascript: calculateInvoiceAmounts();"
                                   name="item_quantity[]" required="" value=""/>
                        </td>
                        <td class="text-right" style="width:10%">
                            <input
                                class="form-control text-right"
                                onchange="javascript: calculateInvoiceAmounts();" name="item_price[]"  required=""
                                value=""/>
                        </td>
                        <td class="text-right" style="width:10%">
                            <input
                                class="form-control text-right"
                                onchange="javascript: calculateInvoiceAmounts();"
                                name="item_discount[]" value=""/>
                        </td>
                        <td class="text-right" style="width:10%">
                            <input
                                class="form-control text-right" readonly name="item_sub_total[]"  required=""
                                value=""/>
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