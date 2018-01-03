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
    foreach ($invoices as $row) :

        $download = anchor('invoice/download/' . $row->id, '<span class="btn btn-xs btn-warning"><i class="fa fa-download"></i> ' . lang('download') . '</span>');
        $subTotal = $this->invoice->invoice_subtotal($row->id);
        $totalDue = $subTotal - $this->invoice->amount_paid($row->id);
        if ($totalDue < 0) {
            $totalDue = $totalDue . ' <span class="label label-success">' . lang('refund') . ' </span>';
        }
        ?>
        <tr>
            <td><?php echo anchor('invoice/' . $row->id . '/view', $row->id); ?></td>
            <td><?php echo $this->invoice->status($row->invoice_status); ?></td>
            <td><?php echo $this->config->item('currency_symbol', 'company') . $subTotal; ?></td>
            <td><?php echo $this->config->item('currency_symbol', 'company') . $this->invoice->amount_paid($row->id); ?></td>
            <td>
                <span class="text-danger"><?php echo $this->config->item('currency_symbol', 'company') . $totalDue; ?></span>
            </td>
            <td><?php echo format_date($row->date_due, false); ?></td>
            <td>
                <?php if (!is('parent')): ?>
                    <a href="#" onclick="confirmDelete('<?php echo site_url("invoice/{$row->id}/delete"); ?>')"
                       class="delete btn btn-danger btn-xs">
                        <i class="fa fa-trash-o"></i>
                        <?php echo lang('delete'); ?>
                    </a>
                <?php endif; ?>
                <a href="<?php echo site_url('invoice/' . $row->id . '/view'); ?>" class="btn btn-info btn-xs">
                    <i class="fa fa-eye"></i> <?php echo lang('view'); ?>
                </a>
                <a href="<?php echo site_url('invoice/' . $row->id . '/preview'); ?>" class="btn btn-info btn-xs">
                    <i class="fa fa-print"></i> <?php echo lang('print'); ?>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>