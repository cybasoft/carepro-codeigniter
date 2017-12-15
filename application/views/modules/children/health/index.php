<?php $this->load->view($this->module.'nav'); ?>
<div class="row">
	<div class="col-md-6">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs pull-right">
				<li class="active"><a href="#allergies" data-toggle="tab">Allergies</a></li>
				<li class=""><a href="#meds" data-toggle="tab">Medications</a></li>
				<li class=""><a href="#food" data-toggle="tab">Food</a></li>
				<li class="pull-left header"><i class="fa fa-th"></i> Health</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="allergies">
					<?php $this->load->view('modules/children/health/allergies'); ?>
				</div>
				<div class="tab-pane" id="meds">
					<?php $this->load->view('modules/children/health/meds'); ?>
				</div>
				<div class="tab-pane" id="food">
					<?php $this->load->view('modules/children/health/food'); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="box box-warning">
			<div class="box-header">
				<div class="box-title">Insurance policy</div>
			</div>
			<div class="box-body">
				<?php $this->load->view('modules/children/health/insurance'); ?>
			</div>

		</div>
	</div>
</div>