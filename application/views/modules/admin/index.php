<div class="row">
	<div class="col-sm-12 col-md-7 col-lg-7">
		<?php echo lang('settings_notice'); ?>
		
			<h3 class="box-title">
				<?php echo lang('company') . ' ' . lang('logo'); ?>
			</h3>
			<?php if ($this->config->item('logo', 'company') !== "") : ?>
				<div class="box-tools pull-right">
					<a href="<?php echo site_url('settings/delete_logo/'); ?>"
						class="btn btn-danger btn-sm">
						<i class="fa fa-trash-o"></i>
					</a>
				</div>
			<?php endif; ?>
			<hr/>
			<?php $this->load->view($this->module . 'company_logo'); ?>

	</div>
	<div class="col-sm-12 col-md-5 col-lg-7">
	<div class="callout callout-info">
					<h3>Thank you for supporting this project!</h3>
				
					<p>Your donation helps us keep working on this script and make it available at a
					very affordable price and provide free support</p>
				
					<form action="https://www.paypal.com/cgi-bin/webscr" target="_blank" method="post">
						<input type="hidden" name="cmd" value="_s-xclick">
						<input type="hidden" name="hosted_button_id" value="Q3N6CNB3RRJBJ">
						<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
						<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
					</form> 
					</div>
	</div>

</div>