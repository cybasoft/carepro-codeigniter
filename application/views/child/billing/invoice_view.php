<?php $this->load->view('child/nav'); ?>
<div class="row">
    <div class="col-sm-2 col-lg-2 col-md-2 ">
        <?php $this->load->view('child/sidebar'); ?>
    </div>
    <div class="col-sm-10 col-lg-10 col-md-10">
        <div class="card">


            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active show" href="#home" aria-controls="home" role="tab" data-toggle="tab">
                        <i class="fa fa-money"></i>
                        <?php echo lang('invoice').' #: '.$invoice[0]->id; ?>
                    </a>
                </li>
                <li class="nav-item" role="tab">
                    <a class="nav-link" href="#history" aria-controls="history" role="tab" data-toggle="tab">
                        <i class="fa fa-history"></i>
                        <?php echo lang('Payment history'); ?>
                    </a>
                </li>
            </ul>
            <div class="tab-content tabcontent-border">
                <div role="tabpanel" class="tab-pane fade in active show" id="home">

                    <div class="card">
                        <div class="card-header">
                            <?php if(!is('parent') && $invoice[0]->invoice_status !== "paid"): ?>
                                <a class="btn btn-default btn-sm card-tools" data-toggle="modal"
                                   data-target="#newItemModal">
                                    <i class="fa fa-plus"></i> <?php echo lang('add_item'); ?>
                                </a>
                            <?php endif; ?>
                            <a href="<?php echo site_url('invoice/'.$invoice[0]->id.'/preview'); ?>"
                               target="_blank"
                               class="btn btn-default btn-sm card-tools">
                                <i class="fa fa-print"></i> <?php echo lang('print'); ?>
                            </a>
                            <?php if(!is('parent') && $invoice[0]->invoice_status !== "paid"): ?>
                                <a class="btn btn-default btn-sm card-tools" data-toggle="modal"
                                   data-target="#payModal">
                                    <span class="fa fa-credit-card"></span>
                                    <?php echo lang('manual_pay'); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h4>
                                        <strong><?php echo lang('invoice').'#: '; ?></strong>
                                        <?php echo $invoice[0]->id; ?>
                                    </h4>
                                    <h4>
                                        <strong><?php echo lang('status'); ?></strong>
                                        <?php echo lang($invoice[0]->invoice_status); ?>
                                    </h4>
                                    <h4>
                                        <strong><?php echo lang('date'); ?>:</strong>
                                        <?php echo format_date($invoice[0]->created_at, FALSE); ?>
                                    </h4>
                                    <h4>
                                        <strong><?php echo lang('due'); ?>:</strong>
                                        <?php echo format_date($invoice[0]->date_due, FALSE); ?>
                                    </h4>
                                </div>
                                <div class="col-sm-8">
                                    <?php if(!is('parent')): ?>
                                        <div class="input-group col-sm-6 pull-right">
                                            <span class="input-group-addon"><?php echo lang('change_status'); ?></span>
                                            <select id="<?php echo $invoice[0]->id; ?>"
                                                    class="form-control invoice_change_status"
                                                    name="invoice_change_status">
                                                <option <?php echo selected_option('paid', $invoice[0]->invoice_status); ?>
                                                        value="paid"><?php echo lang('paid'); ?></option>
                                                <option <?php echo selected_option('due', $invoice[0]->invoice_status); ?>
                                                        value="due"><?php echo lang('due'); ?></option>
                                                <option <?php echo selected_option('cancelled', $invoice[0]->invoice_status); ?>
                                                        value="cancelled"><?php echo lang('cancelled'); ?></option>
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
                                        <?php foreach ($invoice as $item): ?>
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
                                                           name="qty[]"
                                                           value="<?php echo $item->qty; ?>"/>
                                                </td>
                                                <td class="text-right">
                                                    <input disabled
                                                           class="form-control text-right"
                                                           name="price[]"
                                                           value="<?php echo $item->price; ?>"/>
                                                </td>

                                                <td class="text-right">
                                                    <input disabled
                                                           class="form-control text-right"
                                                           readonly
                                                           name="item_sub_total"
                                                           value="<?php echo moneyFormat($item->qty * $item->price, TRUE); ?>"/>
                                                </td>
                                                <?php if(!is('parent')): ?>
                                                    <td>
                                                        <a href="<?php echo site_url('invoice/'.$invoice[0]->id.'/deleteItem/'.$item->id); ?>"
                                                           class="delete">
                                                            <span class="fa fa-trash-alt text-danger cursor"></span>
                                                        </a>
                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                        <tr class="text-right">
                                            <td colspan="4" class="no-border"> <?php echo lang('sub_total'); ?> :</td>
                                            <td><?php echo moneyFormat($subTotal, TRUE); ?></td>
                                        </tr>
                                        <tr class="text-right text-success">
                                            <td colspan="4" class="no-border"><?php echo lang('amount_paid'); ?> :</td>
                                            <td><?php echo $amountPaid > 0 ? moneyFormat($amountPaid, TRUE) : "0.00" ?></td>
                                        </tr>
                                        <tr class="text-right text-danger">
                                            <td colspan="4" class="no-border "> <?php echo lang('amount_due'); ?> :</td>
                                            <td>
                                                <?php if($amountDue < 0): ?>
                                                    <span class="label label-success"><?php echo lang('refund'); ?></span>
                                                <?php endif; ?>
                                                <?php echo moneyFormat($amountDue, TRUE); ?>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12">

                                    <?php if((int)$amountDue > 0):
                                        if(!empty(session('company_stripe_sk_live') || !empty(session('company_stripe_sk_test')))): ?>
                                            <?php $this->load->view('child/billing/payment_stripe'); ?>
                                            <hr/>
                                        <?php endif; ?>

                                        <?php if(!empty(session('company_paypal_email'))): ?>
                                        <div style="border:solid 1px #CCCCCC;padding:10px">
                                            <h4>PayPal</h4>
                                            <a href="<?php echo site_url('invoice/'.$invoice[0]->id.'/paypal'); ?>"
                                               class="btn btn-primary">
                                                <img src="<?php echo assets('img/content/paypal.svg'); ?>"
                                                     style="width:16px;"/>
                                                <?php echo sprintf(lang('pay_with'), 'PayPal'); ?></a>
                                        </div>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="load"></div>
                        </div>
                        <div class="card-footer">
                            <h4><?php echo lang('invoice_terms'); ?></h4>
                            <?php echo $invoice[0]->invoice_terms; ?>
                        </div>
                    </div>

                </div>
                <div role="tabpanel" class="tab-pane fade" id="history">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><?php echo lang('Payment history'); ?></h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <tr>
                                    <th><?php echo lang('date'); ?></th>
                                    <th><?php echo lang('amount'); ?></th>
                                    <th><?php echo lang('payment_method'); ?></th>
                                    <th><?php echo lang('remarks'); ?></th>
                                </tr>
                                <?php foreach ($this->invoice->payments(NULL, $invoice[0]->id)->result() as $payment): ?>
                                    <tr>
                                        <td><?php echo format_date($payment->created_at, FALSE); ?></td>
                                        <td><?php echo moneyFormat($payment->amount, TRUE); ?></td>
                                        <td><?php echo $payment->method; ?></td>
                                        <td><?php echo $payment->remarks; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view($this->module.'invoice_item_create'); ?>
<?php $this->load->view($this->module.'payment_create'); ?>

<script type="text/javascript">
    $(document).ready(function () {
        //change status
        $("select[name=invoice_change_status]").change(function () {
            var status = $(this).val();
            var id = $(this).attr('id');
            var url = site_url+'invoice/' + id + '/updateStatus';
            var fData = {invoice_status: status, id: id};
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
            var id = '<?php echo $this->uri->segment(3); ?>';
            var fData = {invoice_terms: terms, id: id};
            $.ajax({
                url: site_url+'invoice/update_terms/'+ id,
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