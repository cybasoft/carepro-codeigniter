<?php $this->load->view('modules/children/nav'); ?>
<div style="font-family: courier, monospace">
	<div class="row">
		<div class="col-sm-4 invoice-col">
			<div class="box box-solid">
				<div class="box-header bg-light-blue">
				</div>
				<div class="box-body">
					<?php echo $this->company->logo(); ?>
						<br/>
						<?php
						echo $this->conf->company()->street;
						echo br();
						echo $this->conf->company()->city . '. ';
						echo $this->conf->company()->state . ' ,';
						echo $this->conf->company()->zip;
						echo br();
						echo $this->conf->company()->phone;
						echo br();
						echo $this->conf->company()->email;
						echo br();
						echo $this->conf->company()->website;
						?>
				</div>
			</div>
		</div>

		<div class="col-sm-4 invoice-col">
			<div style="width:150px; left:50%;">
				<?php echo $this->invoice->stamp($invoice->id); ?>
			</div>
		</div>

		<div class="col-sm-4 invoice-col">
			<table class="table">
				<tr>
					<td><?php echo lang('invoice'); ?>#:</td>
					<td> <?php echo $invoice->id; ?></td>
				</tr>
				<tr>
					<td><?php echo lang('child'); ?>:</td>
					<td><?php echo $this->children->child($invoice->child_id)->fname.' '.$this->children->child($invoice->child_id)->lname; ?></td>
				</tr>
				<tr>
					<td><?php echo lang('date'); ?>:</td>
					<td><?php echo strtoupper(date('d-M-y', strtotime($invoice->invoice_date))); ?></td>
				</tr>
				<tr>
					<td><?php echo lang('due'); ?>:</td>
					<td><?php echo strtoupper(date('d-M-y', strtotime($invoice->invoice_due_date))); ?></td>
				</tr>
			</table>
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
					<th class="text-right"><?php echo lang('discount'); ?></th>
					<th class="text-right"><?php echo lang('sub_total'); ?></th>

				</tr>
				</thead>
				<tbody>
				<?php
				$subTotal = 0;
				$totalTax = 0;
				$totalDiscount = 0;
				foreach($invoice_items as $item) {
					?>
					<tr id="new_item">
						<td style="width:20%"><?php echo $item->item_name; ?></td>
						<td><?php echo $item->item_description; ?></td>
						<td style="width:5%"><?php echo $item->item_quantity; ?></td>
						<td class="text-right"
							style="width:10%"><?php echo $item->item_price; ?></td>
						<td class="text-right"
							style="width:10%"><?php echo $item->item_discount; ?></td>
						<td class="text-right" style="width:10%">
							<?php echo(($item->item_quantity * $item->item_price) - $item->item_discount); ?>
						</td>
					</tr>
					<?php
					$subTotal = $this->invoice->invoice_subtotal($invoice->id);
					$totalDiscount = $item->item_discount + $totalDiscount;
				}
				?>


				<tr class="text-info">
					<td colspan="3" rowspan="5" class="text-info">
						<h4><?php echo lang('invoice_terms'); ?></h4>

						<div class="text-muted well well-sm no-shadow"><?php echo $invoice->invoice_terms; ?></div>
					</td>
					<td colspan="3" class="no-border">
						<table class="table table-bordered">
							<tr class="text-right text-info">
								<td class="text-right">
									<?php echo lang('discounts'); ?>
								</td>
								<td style="vertical-align: middle; width:130px">
									<?php echo number_format($totalDiscount, 2); ?>
								</td>
							</tr>
							<tr class="text-right">
								<td> <?php echo lang('sub_total'); ?> :</td>
								<td><?php echo number_format($subTotal, 2); ?></td>
							</tr>
							<tr class="text-right text-success">
								<td class="text-right"><?php echo lang('amount_paid'); ?> :</td>
								<td>
									$ <?php
									$totalPaid = $this->invoice->amount_paid($invoice->id);
									echo($totalPaid > 0 ? number_format($totalPaid, 2) : "0.00"); ?>
								</td>
							</tr>
							<tr class="text-right text-danger">
								<td> <?php echo lang('amount_due'); ?> :</td>
								<td>
									<?php
									$totalDue = $this->invoice->invoice_total_due($invoice->id);
									if($totalDue > 0) {
										echo $totalDue;
									} else {
										echo '<span class="label label-success">' . lang('refund') . '</span> ' . $totalDue;
									}
									?>
								</td>
							</tr>
						</table>
					</td>
				</tr>


				</tbody>
			</table>
		</div>
	</div>

	<?php $this->load->view($this->module . 'new_charge'); ?>
</div>

<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
		<div class="btn-group">
			<a target="_blank"
			   href="<?php echo $this->invoice->paypal($invoice->id, 'daycarePP'); ?>"
			   class="btn btn-primary">
				<span class="glyphicon glyphicon-credit-card"></span>
				PayPal
			</a>
			<button class="btn btn-info" onclick="window.print();">
				<span class="glyphicon glyphicon-print"></span>
				<?php echo lang('print'); ?>
			</button>
		</div>
	</div>
</div>
<script type="text/javascript">

	$(document).ready(function () {
		//change status
		$("select[name=invoice_change_status]").change(function () {
			var status = $(this).val();

			var fData = {invoice_status: status, invoice_id: '<?php echo $this->uri->segment(3); ?>'};
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