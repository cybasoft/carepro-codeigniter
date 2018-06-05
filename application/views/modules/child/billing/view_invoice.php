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
                    <?php echo lang('invoice').' #: '.$invoice->id; ?>
                </h3>
                <div class="box-tools pull-right">
                    <?php if(!is('parent') && $invoice->invoice_status !=="paid"): ?>
                        <button class="btn bg-black btn-flat btn-box-tool" data-toggle="modal"
                                data-target="#newItemModal">
                            <i class="fa fa-plus"></i> <?php echo lang('add_item'); ?>
                        </button>
                        <button class="btn bg-black btn-flat btn-box-tool" data-toggle="modal" data-target="#payModal">
                            <span class="fa fa-credit-card"></span>
                            <?php echo lang('manual_pay'); ?>
                        </button>
                    <?php endif; ?>
                    <a href="<?php echo site_url('invoice/'.$invoice->id.'/preview'); ?>"
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
                            <?php echo lang($invoice->invoice_status); ?>
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

                        <?php if(!is('parent') && $invoice->invoice_status !=="paid"): ?>
                            <div class="input-group col-sm-6 pull-right">
                                <span class="input-group-addon"><?php echo lang('change_status'); ?>: </span>
                                <select id="<?php echo $invoice->id; ?>" class="form-control invoice_change_status"
                                        name="invoice_change_status">
                                    <option <?php echo selected_option('paid', $invoice->invoice_status); ?>
                                            value="paid"><?php echo lang('paid'); ?></option>
                                    <option <?php echo selected_option('due', $invoice->invoice_status); ?>
                                            value="due"><?php echo lang('due'); ?></option>
                                    <option <?php echo selected_option('cancelled', $invoice->invoice_status); ?>
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
                            <?php foreach ($invoice_items as $item): ?>
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
                                               value="<?php echo number_format($item->price, 2); ?>"/>
                                    </td>

                                    <td class="text-right">
                                        <input disabled
                                               class="form-control text-right"
                                               readonly
                                               name="item_sub_total"
                                               value="<?php echo moneyFormat($item->qty * $item->price); ?>"/>
                                    </td>
                                    <?php  if(!is('parent') && (int)$totalDue >0): ?>
                                        <td>
                                            <a href="<?php echo site_url('invoice/'.$invoice->id.'/deleteItem/'.$item->id); ?>"
                                               class="delete">
                                                <span class="fa fa-trash-o text-danger cursor"></span>
                                            </a>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                            <tr class="text-right">
                                <td colspan="4" class="no-border"> <?php echo lang('sub_total'); ?> :</td>
                                <td><?php echo moneyFormat($subTotal); ?></td>
                            </tr>
                            <tr class="text-right text-success">
                                <td colspan="4" class="no-border"><?php echo lang('amount_paid'); ?> :</td>
                                <td><?php echo moneyFormat((int)$totalPaid>0 ? $totalPaid : "0.00") ?></td>
                            </tr>
                            <tr class="text-right text-danger">
                                <td colspan="4" class="no-border "> <?php echo lang('amount_due'); ?> :</td>
                                <td>
                                    <?php if((int)$totalDue<0): ?>
                                        <span class="label label-success"><?php echo lang('refund'); ?></span>
                                    <?php endif; ?>
                                    <?php echo moneyFormat($totalDue); ?>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">

                        <?php if((int)$totalDue>0): ?>

                            <script src="https://js.stripe.com/v3/"></script>

                            <form action="<?php echo site_url('invoice/'.$invoice->id.'/stripe-pay'); ?>"
                                  style="border:solid 1px #CCCCCC;padding:10px"
                                  method="post" id="payment-form">
                                <h4><?php echo lang('payment'); ?></h4>
                                <p><?php echo lang('payment_due_note'); ?></p>
                                <hr/>
                                <div class="form-row">
                                    <label for="card-element"><?php echo lang('Credit or debit card'); ?></label>
                                    <div id="card-element"></div>
                                    <div id="card-errors" role="alert"></div>
                                </div>
                                <br/>
                                <button class="btn btn-primary submit-pay"><?php echo sprintf(lang('pay_with'), 'Stripe'); ?></button>
                            </form>

                            <script>
                                $('.submit-pay').click(function () {
                                    $(this).remove()
                                });
                                var stripe = Stripe("<?php  echo (ENVIRONMENT == 'production') ? config_item('stripe')['pk_live'] : $stripeKey = config_item('stripe')['pk_test']; ?>");
                                var elements = stripe.elements();
                                var style = {
                                    base: {
                                        color: '#32325d',
                                        lineHeight: '18px',
                                        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                                        fontSmoothing: 'antialiased',
                                        fontSize: '16px',
                                        '::placeholder': {
                                            color: '#aab7c4'
                                        }
                                    },
                                    invalid: {
                                        color: '#fa755a',
                                        iconColor: '#fa755a'
                                    }
                                };

                                var card = elements.create('card', {style: style});
                                card.mount('#card-element');
                                card.addEventListener('change', function (event) {
                                    var displayError = document.getElementById('card-errors');
                                    if (event.error) {
                                        displayError.textContent = event.error.message;
                                    } else {
                                        displayError.textContent = '';
                                    }
                                });

                                var form = document.getElementById('payment-form');
                                form.addEventListener('submit', function (event) {
                                    event.preventDefault();
                                    stripe.createToken(card).then(function (result) {
                                        if (result.error) {
                                            var errorElement = document.getElementById('card-errors');
                                            errorElement.textContent = result.error.message;
                                        } else {
                                            stripeTokenHandler(result.token);
                                        }
                                    });
                                });

                                function stripeTokenHandler(token) {
                                    // Insert the token ID into the form so it gets submitted to the server
                                    var form = document.getElementById('payment-form');
                                    var hiddenInput = document.createElement('input');
                                    hiddenInput.setAttribute('type', 'hidden');
                                    hiddenInput.setAttribute('name', 'stripeToken');
                                    hiddenInput.setAttribute('value', token.id);
                                    form.appendChild(hiddenInput);

                                    // Submit the form
                                    form.submit();
                                }
                            </script>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="load"></div>
            </div>
            <div class="box-footer">
                <h4><?php echo lang('invoice_terms'); ?></h4>
                <?php echo $invoice->invoice_terms; ?>
            </div>
        </div>

        <h3><?php echo lang('Payment history'); ?></h3>
        <table class="table table-striped">
            <tr>
                <th><?php echo lang('date'); ?></th>
                <th><?php echo lang('amount'); ?></th>
                <th><?php echo lang('payment_method'); ?></th>
                <th><?php echo lang('remarks'); ?></th>
            </tr>
            <?php foreach ($this->invoice->payments(null, $invoice->id)->result() as $payment): ?>
                <tr>
                    <td><?php echo format_date($payment->created_at, false); ?></td>
                    <td><?php echo moneyFormat($payment->amount); ?></td>
                    <td><?php echo $payment->method; ?></td>
                    <td><?php echo $payment->remarks; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
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
            <?php echo form_open('invoice/'.$invoice->id.'/addItem'); ?>
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
<?php $this->load->view($this->module.'make_payment'); ?>

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

