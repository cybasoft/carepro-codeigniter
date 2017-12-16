<?php $this->load->view('modules/children/nav'); ?>
<div class="row">
	<?php $this->load->view('modules/children/accounting/invoice_nav'); ?>
	<div class="col-sm-10 col-md-10 col-lg-10">
	<div class="col-sm-4 invoice-col">
		<div class="box box-solid box-info">
			<div class="box-header bg-light-blue">
				<div class="box-title"><?php echo lang('invoice') . '# ' . $invoice->id; ?></div>
		</div>
			<div class="box-body">
				<div class="form-group input-group">
					<span class="input-group-addon"><?php echo lang('date'); ?>: </span>
					<input class="form-control" size="16" type="text" name="invoice_date" disabled
						   value="<?php echo strtoupper(date('d-M-y', strtotime($invoice->invoice_date))); ?>"/>
				</div>
				<div class="form-group input-group">
					<span class="input-group-addon"><?php echo lang('due'); ?>: </span>
					<input class="form-control" size="16" type="text" name="invoice_due_date" disabled
						   value="<?php echo strtoupper(date('d-M-y', strtotime($invoice->invoice_due_date))); ?>"/>
				</div>
			</div>
		</div>
	</div>

	<div class="col-sm-4 col-md-4 col-lg-4">
		<button class="btn bg-black btn-flat" data-toggle="modal" data-target="#myModal">
			<i class="fa fa-plus"></i> <?php echo lang('add_item'); ?>
		</button>
		<button class="btn bg-black btn-flat" data-toggle="modal" data-target="#make_payment">
			<span class="fa fa-credit-card"></span>
			<?php echo lang('pay'); ?>
		</button>
		<button class="btn bg-black btn-flat"
				onclick="window.location.href='<?php echo site_url('invoice/preview/' . $invoice->id); ?>'">
			<i class="fa fa-print"></i> <?php echo lang('print'); ?>
		</button>
	</div>

	<div class="col-sm-2 col-md-2 col-lg-2">
		<span class="label label-warning"><?php echo lang('change_status'); ?>: </span>
		<select id="<?php echo $invoice->id; ?>" class="form-control invoice_change_status" name="invoice_change_status">
			<option <?php echo $this->conf->selected_option(1, $invoice->invoice_status); ?>
				value="1"><?php echo lang('paid'); ?></option>
			<option <?php echo $this->conf->selected_option(2, $invoice->invoice_status); ?>
				value="2"><?php echo lang('due'); ?></option>
			<option <?php echo $this->conf->selected_option(3, $invoice->invoice_status); ?>
				value="3"><?php echo lang('cancelled'); ?></option>
		</select>
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
					<th class="text-right"><?php echo lang('discount'); ?></th>
					<th class="text-right"><?php echo lang('sub_total'); ?></th>
				</tr>
				</thead>
				<tbody>
				<?php
			$subTotal = 0;
			$totalTax = 0;
			$totalDiscount = 0;
			foreach ($invoice_items as $item) {
				?>
					<tr id="new_item">
						<td style="width:20%">
							<input disabled name="item_name[]"
								   value="<?php echo $item->item_name; ?>"
								   class="form-control"/>
						</td>
						<td><textarea disabled name="item_description[]"
									  class="form-control"><?php echo $item->item_description; ?></textarea>
						</td>

						<td style="width:5%">
							<input disabled class="form-control"
								   onchange="javascript: calculateInvoiceAmounts();"
								   name="item_quantity[]"
								   value="<?php echo $item->item_quantity; ?>"/>
						</td>
						<td class="text-right" style="width:10%">
							<input disabled
								   class="form-control text-right"
								   onchange="javascript: calculateInvoiceAmounts();"
								   name="item_price[]"
								   value="<?php echo $item->item_price; ?>"/>
						</td>
						<td class="text-right" style="width:10%">
							<input disabled
								   class="form-control text-right"
								   onchange="javascript: calculateInvoiceAmounts();"
								   name="item_discount[]"
								   value="<?php echo $item->item_discount; ?>"/>
						</td>
						<td class="text-right" style="width:10%">
							<input disabled
								   class="form-control text-right"
								   readonly
								   name="item_sub_total"
								   value="<?php echo ( ($item->item_quantity * $item->item_price) - $item->item_discount); ?>"/>
						</td>
						<td>
                                            <span class="fa fa-trash cursor"
												  onclick="window.location.href='<?php echo site_url('invoice/delete_item/' . $item->id); ?>'"></span>
						</td>
					</tr>
					<?php
				$subTotal = $this->invoice->invoice_subtotal($invoice->id);
				$totalDiscount = $item->item_discount + $totalDiscount;
			}
			?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<h4><?php echo lang('items'); ?></h4>
			<table class="table table-bordered">
				<tbody>
				<tr class="text-right text-info">
					<td colspan="6" class="no-border" style="vertical-align: middle">
						<?php echo lang('discounts'); ?>
					</td>
					<td class="col-sm-2">
						<?php echo $this->config->item('currency_symbol', 'company') . number_format($totalDiscount, 2); ?>
					</td>
				</tr>
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
					echo ($totalPaid > 0 ? number_format($totalPaid, 2) : "0.00"); ?>
					</td>
					<td style="width:60px" class="no-border"></td>
				</tr>
				<tr class="text-right text-danger">
					<td colspan="6" class="no-border "> <?php echo lang('amount_due'); ?> :</td>
					<td>
						<?php
					$totalDue = number_format($subTotal - $totalPaid, 2);
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
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12">
			<h4><?php echo lang('invoice_terms'); ?></h4>
			<textarea name="invoice_terms" class="form-control" required=""
					  id="invoice_terms"><?php echo $invoice->invoice_terms; ?></textarea>
			<button class="btn btn-large btn-success pull-right" id="invoice_terms_btn"><i
					class="fa fa-check"></i> <?php echo lang('save'); ?>
			</button>
		</div>
	</div>

</div>
</div>
<?php $this->load->view($this->module . 'new_charge'); ?>
<?php $this->load->view($this->module . 'make_payment'); ?>
<div class="load"></div>

<script type="text/javascript">
	$(document).ready(function () {
		//change status
		$("select[name=invoice_change_status]").change(function () {
			var status = $(this).val();
			var id = $(this).attr('id');

			var fData = {invoice_status: status, invoice_id: id};
			$.ajax({
				url: "<?php echo site_url('invoice/update_status'); ?>",
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

