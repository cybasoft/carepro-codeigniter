<div class="row">
	<div class="col-sm-12 col-md-7 col-lg-7">


		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#1-1" data-toggle="tab"><?php echo lang('settings'); ?></a></li>
				<li class=""><a href="#1-2" data-toggle="tab"><?php echo lang('address'); ?></a></li>
				<li class=""><a href="#1-3" data-toggle="tab"><?php echo lang('logo'); ?></a></li>
				<li class=""><a href="#1-4" data-toggle="tab">Support project</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="1-1">
					<div class="box box-primary">
						<div class="box-header">
							<h3 class="box-title"><?php echo lang('settings'); ?></h3>
						</div>
						<div class="box-body">
							<?php $this->load->view($this->module . 'settings'); ?>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="1-2">
					<div class="box box-info">
						<div class="box-header">
							<h3 class="box-title"><?php echo lang('address'); ?></h3>
						</div>
						<div class="box-body">
							<?php $this->load->view($this->module . 'address_form'); ?>
						</div>
					</div>
				</div>
				<div class="tab-pane" id="1-3">
					<div class="box  box-success">
						<div class="box-header">
							<h3 class="box-title">
								<?php echo lang('company') . ' ' . lang('logo'); ?>
							</h3>
							<?php if($this->company->company()->logo !== ""): ?>
								<div class="box-tools pull-right">
									<a href="<?php echo site_url('settings/delete_logo/'); ?>"
									   class="btn btn-danger btn-sm">
										<i class="fa fa-trash-o"></i>
									</a>
								</div>
							<?php endif; ?>
						</div>
						<div class="box-body">
							<?php $this->load->view($this->module . 'company_logo'); ?>
						</div>

					</div>
				</div>


				<div class="tab-pane" id="1-4">
					<div class="box box-success">
						<div class="my_account"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<script>
	$('.my_account').load('<?php echo site_url('billing/mySubscriptions'); ?>');
</script>