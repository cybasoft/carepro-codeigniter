<div class="col-lg-2 col-md-2 col-sm-2">
	<ul class="list-group">
		<?php echo anchor('invoice/create', lang('new_invoice'),'class="list-group-item list-group-item-success"'); ?>
		<?php echo anchor('child/invoice', lang('all'),'class="list-group-item"'); ?>
		<?php echo anchor('child/invoice/paid', lang('paid'),'class="list-group-item"'); ?>
		<?php echo anchor('child/invoice/due', lang('due'),'class="list-group-item"'); ?>
		<?php echo anchor('child/invoice/cancelled', lang('cancelled'),'class="list-group-item"'); ?>
		<?php echo anchor('invoice/payments', lang('payments'),'class="list-group-item list-group-item-info"'); ?>
		<?php echo anchor('invoice/payMethods', lang('payment_method'),'class="list-group-item bg-green"'); ?>
	</ul>

</div>