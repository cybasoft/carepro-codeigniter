<?php $this->load->view('child/nav'); ?>
<div class="row">
    <div class="col-sm-2">
        <?php $this->load->view('child/sidebar'); ?>
    </div>
    <div class="col-sm-10">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title btn-block"><?php echo lang('Invoices'); ?>
                    <?php if (is('admin') || is('manager')):?>
                        <a href="<?php echo site_url('child/' . $child->id . '/newInvoice'); ?>" class="btn btn-info btn-sm card-tools">
                            <i class="fa fa-plus"></i>
                            <?php echo lang('new_Invoice'); ?>
                        </a>
                    <?php endif; ?>
                </h4>
            </div>
            <div class="card-body">

                <table class="table table-striped" id="datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo lang('status'); ?></th>
                            <th><?php echo lang('amount'); ?></th>
                            <th><?php echo lang('paid'); ?></th>
                            <th><?php echo lang('due'); ?></th>
                            <th><?php echo lang('due_date'); ?></th>
                            <th data-sortable="false"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($invoices as $invoice) : ?>
                            <tr>
                                <td><?php echo anchor('invoice/' . $invoice->id . '/view', ($invoice->id < 10) ? '000' . $invoice->id : $invoice->id); ?></td>
                                <td><?php echo lang($invoice->invoice_status); ?></td>
                                <td><?php echo moneyFormat($invoice->amount, TRUE); ?></td>
                                <td><?php echo moneyFormat($invoice->totalPaid, TRUE); ?></td>
                                <td class="text-danger"><?php echo moneyFormat($invoice->totalDue, TRUE); ?></td>
                                <td><?php echo format_date($invoice->date_due, FALSE); ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo lang('Actions'); ?>
                                        </button>
                                        <div class="dropdown-menu">
                                            <?php echo anchor('invoice/' . $invoice->id . '/view', icon('folder-open') . ' ' . lang('Open'), 'class="dropdown-item"'); ?>
                                            <?php echo anchor('invoice/' . $invoice->id . '/download?dl', icon('file-pdf') . ' ' . lang('Download'), 'class="dropdown-item"'); ?>
                                            <?php if(!is('parent')): echo anchor('invoice/' . $invoice->id . '/download?send', icon('envelope') . ' ' . lang('send_to_parent'), 'class="dropdown-item"'); endif;?>
                                            <?php echo anchor('invoice/' . $invoice->id . '/preview', icon('print') . ' ' . lang('Print'), 'target="_blank" class="dropdown-item"'); ?>
                                            <?php if ($stripe->stripe_enabled == 1 && $invoice->totalDue != 0 && $key != '') : ?>
                                                <a href="javascript:void(0)" target="_blank" data-toggle="modal" data-target="#stripe_pay" class="dropdown-item pay_button" data-due-amount="<?php echo $invoice->totalDue; ?>"><i class="fab fa-cc-stripe"></i> Pay</a>
                                            <?php endif; ?>
                                            <?php if (is('admin') || is('manager')) : ?>
                                                <div class="dropdown-divider"></div>
                                                <?php echo anchor('invoice/' . $invoice->id . '/delete', icon('trash-alt') . ' ' . lang('Delete'), 'class="delete dropdown-item text-danger"'); ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="modal fade" id="stripe_pay" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">Invoice Stripe Payment</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form role="form" action="../../invoice/<?php echo $invoice->id; ?>/pay" method="post" class="require-validation payment_form" data-cc-on-file="false" data-stripe-publishable-key="<?php echo $key; ?>" id="payment-form">
                                <div class="modal-body">
                                    <input type="hidden" name="invoice_amount" id="invoice_amount">
                                    <div class='form-row row'>
                                        <div class='col-12 form-group required'>
                                            <label class='control-label'><?php echo lang('Name on Card'); ?></label> <input class='form-control' size='4' type='text'>
                                        </div>
                                    </div>

                                    <div class='form-row row'>
                                        <div class='col-12 form-group required'>
                                            <label class='control-label'><?php echo lang('Card Number'); ?></label> <input autocomplete='off' class='form-control card-number' size='20' type='text'>
                                        </div>
                                    </div>

                                    <div class='form-row row'>
                                        <div class='col-12 col-md-4 form-group cvc required'>
                                            <label class='control-label'>CVC</label> <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                                        </div>
                                        <div class='col-12 col-md-4 form-group expiration required'>
                                            <label class='control-label'><?php echo lang('Expiration Month'); ?></label> <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                                        </div>
                                        <div class='col-12 col-md-4 form-group expiration required'>
                                            <label class='control-label'><?php echo lang('Expiration Year'); ?></label> <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                                        </div>
                                    </div>
                                    <div class='form-row row'>
                                        <div class='col-md-12 error form-group d-none'>
                                            <div class='alert-danger alert'>
                                                <?php echo lang('Please correct the errors and try again.'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('Close'); ?></button>
                                    <button class="btn btn-primary"><?php echo lang('Pay'); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>