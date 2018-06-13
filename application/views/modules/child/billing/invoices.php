<table class="table table-stripped table-responsive table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th><?php echo lang('status'); ?></th>
        <th><?php echo lang('amount'); ?></th>
        <th><?php echo lang('paid'); ?></th>
        <th><?php echo lang('due'); ?></th>
        <th><?php echo lang('due_date'); ?></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($invoices as $invoice) :
        $download = anchor('invoice/download/'.$invoice->id, '<span class="btn btn-xs btn-warning"><i class="fa fa-download"></i> '.lang('download').'</span>');
        $subTotal = $this->invoice->invoice_subtotal($invoice->id);
        $totalDue = $subTotal - $this->invoice->amount_paid($invoice->id);
        if($totalDue<0) {
            $totalDue = $totalDue.' <span class="label label-success">'.lang('refund').' </span>';
        }
        ?>
        <tr>
            <td>
                <?php echo anchor('invoice/'.$invoice->id.'/view', ($invoice->id<10) ? '000'.$invoice->id : $invoice->id); ?></td>
            <td><?php echo lang($invoice->invoice_status); ?></td>
            <td><?php echo $this->config->item('currency_symbol', 'company').$subTotal; ?></td>
            <td><?php echo $this->config->item('currency_symbol', 'company').$this->invoice->amount_paid($invoice->id); ?></td>
            <td>
                <span class="text-danger"><?php echo $this->config->item('currency_symbol', 'company').$totalDue; ?></span>
            </td>
            <td><?php echo format_date($invoice->date_due, false); ?></td>
            <td>
                <a href="<?php echo site_url('invoice/'.$invoice->id.'/view'); ?>" class="btn btn-info btn-xs">
                    <i class="fa fa-eye"></i> <span class="hidden-xs"><?php echo lang('view'); ?></span>
                </a>
                <a target="_blank" class="btn btn-default btn-xs"
                   href="<?php echo site_url('invoice/'.$invoice->id.'/preview'); ?>">
                    <i class="fa fa-print"></i>
                </a>
                <a href="<?php echo site_url('invoice/'.$invoice->id.'/download'); ?>" class="btn btn-default btn-xs"
                   target="_blank">
                    <i class="fa fa-file-pdf-o text-danger"></i>

                </a>
                <?php if(!is('parent')): ?>
                    <div class="dropdown pull-right">
                        <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown">
                            <?php echo lang('actions'); ?>
                            <span class="caret"></span></button>
                        <ul class="dropdown-menu">

                            <li>
                                <a href="<?php echo site_url('invoice/'.$invoice->id.'/send'); ?>">
                                    <i class="fa fa-mail-forward"></i>
                                    <?php echo lang('send_to_parent'); ?>
                                </a>
                            </li>
                            <li class="bg-danger">
                                <a href="#"
                                   onclick="confirmDelete('<?php echo site_url("invoice/{$invoice->id}/delete"); ?>')"
                                   class="delete">
                                    <i class="fa fa-trash-alt text-danger"></i>
                                    <?php echo lang('delete'); ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>