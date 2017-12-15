<?php $this->load->view($this->module . 'nav'); ?>

<div class="row">
<?php $this->load->view('modules/children/accounting/invoice_nav'); ?>

	<div class="col-lg-10 col-md-10 col-sm-10">
		<div class="box box-info inv-content">
				<?php $this->load->view($this->module . 'accounting/invoices'); ?>
		</div>
	</div>
</div>