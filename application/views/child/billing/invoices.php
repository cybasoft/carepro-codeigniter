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
        $download = anchor('invoice/download/'.$invoice->id, '<span class="btn btn-sm btn-warning"><i class="fa fa-download"></i> '.lang('download').'</span>');
        $subTotal = $this->invoice->subTotal($invoice->id);
        $totalDue = $this->invoice->amountPaid($invoice->id);

        $state = '';
        if($totalDue < 0) {
            $state = ' <span class="label label-success">'.lang('refund').'</span> ';
        }
        ?>
        <tr>
            <td>
                <?php echo anchor('invoice/'.$invoice->id.'/view', ($invoice->id < 10) ? '000'.$invoice->id : $invoice->id); ?></td>
            <td><?php echo lang($invoice->invoice_status); ?></td>
            <td><?php echo moneyFormat($subTotal, true); ?></td>
            <td><?php echo moneyFormat($this->invoice->amountPaid($invoice->id), true); ?></td>
            <td>
                <span class="text-danger"><?php echo moneyFormat($totalDue, true).$state; ?></span>
            </td>
            <td><?php echo format_date($invoice->date_due, false); ?></td>
            <td class="text-right">
                <a href="<?php echo site_url('invoice/'.$invoice->id.'/view'); ?>" class="btn btn-info btn-sm show-tip"
                data-toggle="tooltip" title="<?php echo lang('view'); ?>">
                    <i class="fa fa-folder-open"></i>
                </a>
                <a target="_blank" class="btn btn-default btn-sm"
                   title="<?php echo lang('Print'); ?>"
                   href="<?php echo site_url('invoice/'.$invoice->id.'/preview'); ?>">
                    <i class="fa fa-print"></i>
                </a>
                <a href="<?php echo site_url('invoice/'.$invoice->id.'/download?dl'); ?>"
                   class="btn btn-default btn-sm"
                   title="<?php echo lang('Download'); ?>"><i class="fa fa-file-pdf text-danger"></i>
                </a>
                <a href="<?php echo site_url('invoice/'.$invoice->id.'/download?send'); ?>"
                   class="btn btn-info btn-sm show-tip" data-toggle="tooltip" title="<?php echo lang('send_to_parent'); ?>">
                    <i class="fa fa-envelope"></i>
                </a>
                <?php if(!is('parent')): ?>
                    <a href="#"
                       onclick="confirmDelete('<?php echo site_url("invoice/{$invoice->id}/delete"); ?>')"
                       class="delete btn btn-danger btn-sm show-tip" data-toggle="tooltip" title="<?php echo lang('delete'); ?>
">
                        <i class="fa fa-trash-alt"></i>
                    </a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>