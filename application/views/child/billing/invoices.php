<?php $this->load->view('child/nav'); ?>
<div class="row">
    <div class="col-sm-2">
        <?php $this->load->view('child/sidebar'); ?>
    </div>
    <div class="col-sm-10">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><?php echo lang('Invoices'); ?></h4>

                <?php if(!is('parent')): ?>
                    <a href="<?php echo site_url('child/'.$child->id.'/newInvoice'); ?>"
                       class="btn btn-info btn-sm card-tools">
                        <i class="fa fa-plus"></i>
                        <?php echo lang('new_invoice'); ?>
                    </a>
                <?php endif; ?>
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
                    <?php foreach ($invoices as $invoice): ?>
                        <tr>
                            <td><?php echo anchor('invoice/'.$invoice->id.'/view', ($invoice->id < 10) ? '000'.$invoice->id : $invoice->id); ?></td>
                            <td><?php echo lang($invoice->invoice_status); ?></td>
                            <td><?php echo moneyFormat($invoice->amount, TRUE); ?></td>
                            <td><?php echo moneyFormat($invoice->totalPaid, TRUE); ?></td>
                            <td class="text-danger"><?php echo moneyFormat($invoice->totalDue, TRUE); ?></td>
                            <td><?php echo format_date($invoice->date_due, FALSE); ?></td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false"><?php echo lang('Actions'); ?>
                                    </button>
                                    <div class="dropdown-menu">
                                        <?php echo anchor('invoice/'.$invoice->id.'/view', icon('folder-open').' '.lang('Open'), 'class="dropdown-item"'); ?>
                                        <?php echo anchor('invoice/'.$invoice->id.'/download?dl', icon('file-pdf').' '.lang('Download'), 'class="dropdown-item"'); ?>
                                        <?php echo anchor('invoice/'.$invoice->id.'/download?send', icon('envelope').' '.lang('send_to_parent'), 'class="dropdown-item"'); ?>
                                        <?php echo anchor('invoice/'.$invoice->id.'/preview', icon('print').' '.lang('Print'), 'target="_blank" class="dropdown-item"'); ?>
                                        <?php if(!is('parent')): ?>
                                            <div class="dropdown-divider"></div>
                                            <?php echo anchor('invoice/'.$invoice->id.'/delete', icon('trash-alt').' '.lang('Delete'), 'class="delete dropdown-item text-danger"'); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>