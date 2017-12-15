<?php
if ($status == "paid" || $status == "due" || $status == "cancelled") {
	switch ($status) {
		case "paid":
			$s = 1;
			break;
		case "due":
			$s = 2;
			break;
		case "cancelled":
			$s = 3;
			break;
	}
	$this->db->where('invoice_status', $s);
}
if (isset($_GET['search'])) {
	$this->db->like('id', $_GET['search']);
}
$this->db->where('child_id', $this->child->getID());
$query = $this->invoice->getInvoices();
?>
<table class="table table-stripped table-responsive">
	<thead>
	<tr>
		<td>#</td>
		<td><?php echo lang('status'); ?></td>
		<td><?php echo lang('amount'); ?></td>
		<td><?php echo lang('paid'); ?></td>
		<td><?php echo lang('due'); ?></td>
		<td><?php echo lang('due_date'); ?></td>
	</tr>
	</thead>
	<tbody>
	<?php
foreach ($query as $row) :
	$del = anchor('invoice/delete/' . $row->id, '<span class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i></span>');
$download = anchor('invoice/download/' . $row->id, '<span class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-download"></i> ' . lang('download') . '</span>');
$preview = anchor('invoice/preview/' . $row->id, '<span class="btn btn-xs btn-info" ><i class="glyphicon glyphicon-print"></i></span>');

$subTotal = $this->invoice->invoice_subtotal($row->id);
$totalDue = $subTotal - $this->invoice->amount_paid($row->id);
if ($totalDue < 0) {
	$totalDue = $totalDue . ' <span class="label label-success">' . lang('refund') . ' </span>';
}
?>
	<tr>
		<td><?php echo anchor('invoice/view/' . $row->id, $row->id); ?></td>
		<td><?php echo $this->invoice->invoice_status($row->invoice_status); ?></td>
		<td><?php echo $this->config->item('currency_symbol', 'company') . $subTotal; ?></td>
		<td><?php echo $this->config->item('currency_symbol', 'company') . $this->invoice->amount_paid($row->id); ?></td>
		<td><span class="text-danger"><?php echo $this->config->item('currency_symbol', 'company') . $totalDue; ?></span></td>
		<td><?php echo strtoupper(date('d-M-y', strtotime($row->invoice_due_date))); ?></td>
		<td><?php echo $del . ' ' . $preview; ?></td>
	</tr>
	<?php endforeach; ?>
	</tbody>
</table>