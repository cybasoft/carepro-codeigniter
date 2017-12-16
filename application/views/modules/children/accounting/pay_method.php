<?php $this->load->view('modules/children/nav'); ?>
<div class="row">
	<?php $this->load->view('modules/children/accounting/invoice_nav'); ?>

<!--	<div class="col-sm-5 col-md-5 col-lg-5">-->
<!--		<div class="box box-solid box-success">-->
<!--			<div class="box-header">-->
<!--				<div class="box-title">-->
<!--					<span class="fa fa-credit-card"></span>-->
<!--					--><?php //echo lang('credit_debit_card'); ?>
<!--				</div>-->
<!--			</div>-->
<!--			<div class="box-body">-->
<!--				--><?php
//				foreach($cards->result() as $row) {
//					echo '<div>';
//					echo anchor('charges/delete_card/' . $row->id, '<span class="fa fa-trash text-danger cursor credit_card_edit pull-right"></span>');
//					echo $row->name_on_card;
//					echo '<br/>';
//					echo 'xxxx-xxxx-xxxx-' . substr($this->conf->decrypt($row->card_no), -4, 4);
//					echo '<br/>';
//					echo $row->expiry;
//					echo '</div>';
//					echo '<hr/>';
//				}
//
//				//add form
//				echo '<span class="h4 text-warning">' . lang('add_new_card') . '</span>';
//				echo form_open('charges/add_card', 'class=""');
//				$name_on_card = array(
//					'name' => 'name_on_card',
//					'type' => 'text',
//					'class' => 'form-control',
//					'placeholder' => lang('name_on_card'),
//					'required' => '',
//				);
//				$card_no = array(
//					'name' => 'card_no',
//					'type' => 'text',
//					'class' => 'form-control',
//					'placeholder' => lang('card_number'),
//					'required' => '',
//				);
//				$expiry = array(
//					'name' => 'expiry',
//					'type' => 'text',
//					'class' => 'form-control',
//					'placeholder' => lang('expiry') . ' mm/yyyy',
//					'required' => '',
//				);
//				$ccv = array(
//					'name' => 'ccv',
//					'type' => 'text',
//					'class' => 'form-control',
//					'placeholder' => lang('ccv'),
//					'required' => '',
//				);
//				echo form_input($name_on_card);
//				echo form_input($card_no);
//				echo form_input($expiry);
//				echo form_input($ccv);
//				echo '<button class="btn btn-success">' . lang('submit') . '</button>';
//				echo form_close();
//				?>
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->

	<div class="col-sm-5 col-md-5 col-lg-5"">
		<div class="box box-solid box-success">
			<div class="box-header">
				<div class="box-title">
					<span class="fa fa-credit-card"></span>
					<?php echo lang('bank_account'); ?>
				</div>
			</div>
			<div class="box-body">
				<?php
				foreach($banks->result() as $row) {
					echo '<div>';
					echo anchor('charges/delete_bank/' . $row->id, '<span class="fa fa-trash text-danger cursor bank_del pull-right"></span>');
					echo $row->bank_name;
					echo '<br/>';
					echo $this->conf->decrypt($row->account_no);
					echo '<br/>';
					echo $row->routing;
					echo '</div>';
					echo '<hr/>';
				}
				//add form
				echo '<span class="h4 text-warning">' . lang('add_new_bank') . '</span>';
				echo form_open('charges/add_bank', 'class=""');
				$bank_name = array(
					'name' => 'bank_name',
					'type' => 'text',
					'class' => 'form-control',
					'placeholder' => lang('bank_name'),
					'required' => '',
				);
				$account_no = array(
					'name' => 'account_no',
					'type' => 'text',
					'class' => 'form-control',
					'placeholder' => lang('account_number'),
					'required' => '',
				);
				$routing = array(
					'name' => 'routing',
					'type' => 'text',
					'class' => 'form-control',
					'placeholder' => lang('routing_number'),
					'required' => '',
				);
				echo form_input($bank_name);
				echo form_input($account_no);
				echo form_input($routing);
				echo '<button class="btn btn-success">' . lang('submit') . '</button>';
				echo form_close();
				?>
			</div>
		</div>
	</div>
</div>