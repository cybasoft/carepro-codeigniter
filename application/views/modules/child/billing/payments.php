<?php $this->load->view('modules/children/nav'); ?>
<div class="row">
	<?php $this->load->view('modules/children/accounting/invoice_nav'); ?>
	<div class="col-lg-10 col-md-10 col-sm-10">
		<div class="box box-solid box-info">
			<div class="box-header">
				<div class="box-title"><?php echo lang('payments_header'); ?></div>
			</div>
			<div class="box-body">
				<table class="table table-stripped">
					<th><?php echo lang('invoice'); ?></th>
					<th><?php echo lang('amount'); ?></th>
					<th><?php echo lang('date'); ?></th>
					<th><?php echo lang('method'); ?></th>
					<th><?php echo lang('notes'); ?></th>
					<?php foreach($payments->result() as $row): ?>
						<tr>
							<td>
								<?php echo anchor('invoice/view/' . $row->invoice_id, $row->invoice_id); ?>
							</td>
							<td>
								<?php echo get_option('currency_symbol') . ' ' . $row->amount_paid; ?>
							</td>
							<td>
								<?php echo $row->date_paid; ?>
							</td>
							<td>
								<?php echo $this->invoice->pay_method($row->method); ?>
							</td>
							<td>
								<?php echo $row->remarks; ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</table>
			</div>
		</div>
	</div>
</div>