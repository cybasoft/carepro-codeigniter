<?php $this->load->view('modules/children/nav'); ?>
<div class="row">
	<?php $this->load->view('modules/children/accounting/invoice_nav'); ?>

	<div class="col-sm-10 col-md-10 col-lg-10" style="font-family: courier, monospace">
		<div class="box box-solid">
			<div class="box-header bg-black">
				<div class="box-title">
					<span class="fa fa-credit-card"></span>
					<?php echo lang('new_invoice'); ?>
				</div>
			</div>
			<div class="box-body">
				<?php echo form_open('invoice/save', 'id="myForm"'); ?>
				<label class="label label-default"><?php echo lang('date'); ?></label>

				<div class="form-group input-group date col-lg-4 col-md-4 col-sm-4">
					<input class="datepicker1 form-control" size="16" type="text" name="invoice_date"
						   readonly required=""/>
                         <span class="input-group-addon add-on">
                             <i class="fa fa-calendar" style="display: inline"></i>
                         </span>
				</div>

				<label class="label label-default"><?php echo lang('due'); ?> </label>

				<div class="form-group input-group date col-lg-4 col-md-4 col-sm-4">
					<input class="datepicker2 form-control" size="16" type="text" name="invoice_due_date"
						   readonly required=""/>
                        <span class="input-group-addon add-on">
                            <i class="fa fa-calendar" style="display: inline"></i>
                        </span>
				</div>
<hr/>
				<table class="table table-bordered">
					<thead>
					<tr class="table_header">
						<th><?php echo lang('item'); ?></th>
						<th><?php echo lang('description'); ?></th>
						<th><?php echo lang('quantity'); ?></i></th>
						<th class="text-right"><?php echo lang('amount'); ?></th>
						<th class="text-right"><?php echo lang('discount'); ?></th>
					</tr>
					</thead>
					<tbody>
					<tr id="new_item">
						<td style="width:20%">
							<input name="item_name[]" value="" class="form-control"/>
						</td>
						<td><textarea name="item_description[]" class="form-control" required=""></textarea>
						</td>

						<td style="width:5%">
							<input class="form-control" onchange="javascript: calculateInvoiceAmounts();"
								   name="item_quantity[]" value="" required=""/>
						</td>
						<td class="text-right" style="width:10%">
							<input
								class="form-control text-right"
								onchange="javascript: calculateInvoiceAmounts();" name="item_price[]"
								value="" required=""/>
						</td>
						<td class="text-right" style="width:10%">
							<input
								class="form-control text-right"
								onchange="javascript: calculateInvoiceAmounts();"
								name="item_discount[]" value="" required=""/>
						</td>
						<!--td class="text-right" style="width:10%">
							<input
								class="form-control text-right" readonly name="item_sub_total"
								value=""/>
						</td-->
					</tr>
					</tbody>
				</table>
<hr/>
					<label class="label label-default"> <?php echo lang('invoice_terms'); ?></label>
					<textarea name="invoice_terms" class="form-control"
							  id="invoice_terms" required=""></textarea>
				<button class="btn btn-large btn-success" id="bttn_save_invoice"><i
						class="fa fa-check"></i> <?php echo lang('save'); ?></button>

				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
<div class="load"></div>
<script type="text/javascript">
	$(document).ready(function () {
		$('.datepicker1').datepicker({autoclose: true, startDate: '-30d', format: 'dd-mm-yyyy'});
		$('.datepicker2').datepicker({autoclose: true, startDate: '-0d', format: 'dd-mm-yyyy'});
		//$(".date").datepicker("setDate", new Date());
		$(".edit_invoice_date").datepicker({autoclose: true, format: 'dd-mm-yyyy'});

		$('#bttn_add_product').click(function () {
			$('#modal-placeholder').load(site_url + "invoices/items_from_products/" + Math.floor(Math.random() * 1000));
		});

		$('#bttn_quote_add_product').click(function () {
			$('#modal-placeholder').load(site_url + "quotes/items_from_products/" + Math.floor(Math.random() * 1000));
		});

		$('#bttn_add_item').click(function () {
			$('#new_item').clone().appendTo('#item_table').removeAttr('id').addClass('item').show();
		});

	});

	function calculateInvoiceAmounts() {
		var items = [];
		var item_order = 1;
		$('.load').html('<div class="loading"></div>').fadeOut('slow');

		$('table tr.item').each(function () {
			var row = {};
			var quantity = $(this).find("input[name=item_quantity]").val();
			var unit_price = $(this).find("input[name=item_price]").val();
			var discount = $(this).find("input[name=item_discount]").val();
			$(this).find("input[name=item_sub_total]").val(quantity * unit_price - discount);

			$(this).find('input,select,textarea').each(function () {
				row[$(this).attr('name')] = $(this).val();
			});
			items.push(row);
		});
		$.post('<?php echo site_url('invoice/ajax_calculate_totals'); ?>', {
				items: JSON.stringify(items),
				'invoice_discount_amount': $('#invoice_discount_amount').val(),
				'invoice_id': $('#invoice_id').val()
			},
			function (data) {
				var response = JSON.parse(data);
				$('#items_total_cost').html(response.items_total_cost);
				$('#invoice_total_tax').html(response.invoice_total_tax);
				$('#invoice_sub_total1').html(response.items_sub_total1);
				$('#invoice_sub_total2').html(response.invoice_sub_total2);
				$('#invoice_discount_amount').html(response.invoice_discount_amount);
				$('#invoice_amount_due').html(response.invoice_amount_due);

				$('.load').html('<div class="loading"></div>').fadeOut('slow');
			});
	}


</script>