<?php $this->load->view('modules/child/nav'); ?>
<div class="row">
    <div class="col-sm-2 col-lg-2 col-md-2 table-responsive">
        <?php $this->load->view('modules/child/sidebar'); ?>
    </div>
    <div class="col-sm-10 col-lg-10 col-md-10">

        <div class="box box-default box-solid">
            <div class="box-header">
                <h3 class="box-title">
                    <i class="fa fa-money"></i>
                    <?php echo lang('invoice') . ' #: ' . $invoice->id; ?>
                </h3>
                <div class="box-tools pull-right">
                    <?php if (!is('parent')): ?>
                        <button class="btn bg-black btn-flat btn-box-tool" data-toggle="modal"
                                data-target="#newItemModal">
                            <i class="fa fa-plus"></i> <?php echo lang('add_item'); ?>
                        </button>
                        <button class="btn bg-black btn-flat btn-box-tool" data-toggle="modal" data-target="#payModal">
                            <span class="fa fa-credit-card"></span>
                            <?php echo lang('pay'); ?>
                        </button>
                    <?php endif; ?>
                    <a href="<?php echo site_url('invoice/' . $invoice->id . '/preview'); ?>"
                       target="_blank"
                       class="btn bg-black btn-flat btn-box-tool">
                        <i class="fa fa-print"></i> <?php echo lang('print'); ?>
                    </a>
                </div>
            </div>
            <div class="box-body">

                <div class="row">
                    <div class="col-sm-4">
                        <h4>
                            <strong><?php echo lang('status'); ?></strong>
                            <?php echo $this->invoice->status($invoice->invoice_status); ?>
                        </h4>
                        <h4>
                            <strong><?php echo lang('date'); ?>:</strong>
                            <?php echo format_date($invoice->created_at, false); ?>
                        </h4>
                        <h4>
                            <strong><?php echo lang('due'); ?>:</strong>
                            <?php echo format_date($invoice->date_due, false); ?>
                        </h4>
                    </div>

                    <div class="col-sm-8">

                        <?php if (!is('parent')): ?>
                            <div class="input-group col-sm-6 pull-right">
                                <span class="input-group-addon"><?php echo lang('change_status'); ?>: </span>
                                <select id="<?php echo $invoice->id; ?>" class="form-control invoice_change_status"
                                        name="invoice_change_status">
                                    <option <?php echo selected_option(1, $invoice->invoice_status); ?>
                                            value="1"><?php echo lang('paid'); ?></option>
                                    <option <?php echo selected_option(2, $invoice->invoice_status); ?>
                                            value="2"><?php echo lang('due'); ?></option>
                                    <option <?php echo selected_option(3, $invoice->invoice_status); ?>
                                            value="3"><?php echo lang('cancelled'); ?></option>
                                </select>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <table id="item_table" class="table table-bordered">
                            <thead>
                            <tr class="table_header">
                                <th><?php echo lang('item'); ?></th>
                                <th><?php echo lang('description'); ?></th>
                                <th><?php echo lang('quantity'); ?></i></th>
                                <th class="text-right"><?php echo lang('amount'); ?></th>
                                <th class="text-right"><?php echo lang('sub_total'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($invoice_items as $item) {
                                ?>
                                <tr id="new_item">
                                    <td>
                                        <input disabled name="item_name[]"
                                               value="<?php echo $item->item_name; ?>"
                                               class="form-control"/>
                                    </td>
                                    <td><textarea disabled name="description[]"
                                                  class="form-control"><?php echo $item->description; ?></textarea>
                                    </td>

                                    <td>
                                        <input disabled class="form-control"
                                               onchange="javascript: calculateInvoiceAmounts();"
                                               name="qty[]"
                                               value="<?php echo $item->qty; ?>"/>
                                    </td>
                                    <td class="text-right">
                                        <input disabled
                                               class="form-control text-right"
                                               onchange="javascript: calculateInvoiceAmounts();"
                                               name="price[]"
                                               value="<?php echo $item->price; ?>"/>
                                    </td>

                                    <td class="text-right">
                                        <input disabled
                                               class="form-control text-right"
                                               readonly
                                               name="item_sub_total"
                                               value="<?php echo(($item->qty * $item->price)); ?>"/>
                                    </td>
                                    <?php if (!is('parent')): ?>
                                        <td>
                                            <a href="<?php echo site_url('invoice/' . $invoice->id . '/deleteItem/' . $item->id); ?>"
                                               class="delete">
                                                <span class="fa fa-trash-o text-danger cursor"></span>
                                            </a>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <?php
                                $subTotal = $this->invoice->invoice_subtotal($invoice->id);
                            }
                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <table class="table table-bordered">
                            <tbody>
                            <tr class="text-right">
                                <td colspan="6" class="no-border"> <?php echo lang('sub_total'); ?> :</td>
                                <td><?php echo $this->config->item('currency_symbol', 'company');
                                    echo number_format($subTotal, 2); ?></td>
                            </tr>
                            <tr class="text-right text-success">
                                <td colspan="6" class="no-border"><?php echo lang('amount_paid'); ?> :</td>
                                <td>
                                    <?php
                                    echo $this->config->item('currency_symbol', 'company');
                                    $totalPaid = $this->invoice->amount_paid($invoice->id);

                                    echo($totalPaid > 0 ? $totalPaid : "0.00"); ?>
                                </td>
                                <td class="no-border"></td>
                            </tr>
                            <tr class="text-right text-danger">
                                <td colspan="6" class="no-border "> <?php echo lang('amount_due'); ?> :</td>
                                <td>
                                    <?php

                                    $totalDue = (float)$subTotal - (float)$totalPaid;
                                    if ($totalDue > 0) {
                                        echo $this->config->item('currency_symbol', 'company') . $totalDue;
                                    } else {
                                        echo '<span class="label label-success">' . lang('refund') . '</span> ' . $this->config->item('currency_symbol', 'company') . $totalDue;
                                    }
                                    ?>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="load"></div>

            </div>
            <div class="box-footer">
                <h4><?php echo lang('invoice_terms'); ?></h4>
                <?php echo $invoice->invoice_terms; ?>
            </div>
        </div>

    </div>

</div>

<div class="modal fade" id="newItemModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"><?php echo lang('new_item'); ?></h4>
            </div>
            <?php echo form_open('invoice/' . $invoice->id . '/addItem'); ?>
            <div class="modal-body">
                <label><?php echo lang('item_name'); ?></label>
                <input type="text" name="item_name" class="form-control" required/>
                <label><?php echo lang('description'); ?></label>
                <input type="text" name="description" class="form-control" required/>
                <label><?php echo lang('price'); ?></label>
                <input type="text" name="price" class="form-control" required/>
                <label><?php echo lang('quantity'); ?></label>
                <input type="number" name="qty" class="form-control" required/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('close'); ?></button>
                <button class="btn btn-primary"><?php echo lang('submit'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<?php $this->load->view($this->module . 'make_payment'); ?>

<script type="text/javascript">
    $(document).ready(function () {
        //change status
        $("select[name=invoice_change_status]").change(function () {
            var status = $(this).val();
            var id = $(this).attr('id');
            var url = '<?php echo site_url(); ?>invoice/' + id + '/updateStatus';
            var fData = {invoice_status: status, invoice_id: id};
            $.ajax({
                url: url,
                type: "POST",
                data: fData,
                success: function (data, textStatus, jqXHR) {
                    //data - response from server
                    location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    location.reload();
                }
            });
        });

        //update terms
        $('#invoice_terms_btn').click(function () {
            var terms = $('textarea[name=invoice_terms]').val();
            var invoice_id = '<?php echo $this->uri->segment(3); ?>';
            var fData = {invoice_terms: terms, invoice_id: invoice_id};
            $.ajax({
                url: "<?php echo site_url('invoice/update_terms'); ?>/" + invoice_id,
                type: "POST",
                data: fData,
                success: function (data, textStatus, jqXHR) {
                    //data - response from server
                    location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    location.reload();
                }
            });
        });
    });
</script>

