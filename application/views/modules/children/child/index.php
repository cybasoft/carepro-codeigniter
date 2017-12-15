<?php $this->load->view($this->module.'nav'); ?>

<div class="row">
	<div class="col-sm-3 col-lg-3 col-md-3 table-responsive pad">
		<div class="box">
			<div class="box-body table-responsive">
				<?php $this->load->view($this->module.'child/childphoto'); ?>
			</div>
		</div>
	</div>

	<div class="col-sm-4 col-md-4 col-lg-4">
		<div class="box">
			<div class="box-body table-responsive">
				<?php $this->load->view($this->module.'child/info'); ?>
			</div>
		</div>
	</div>

	<div class="col-sm-5 col-md-5 col-lg-5">
		<div class="box box-solid box-primary">
			<div class="box-header">
				<div class="box-title"><?php echo lang('parents'); ?>
					   <span class="glyphicon glyphicon-plus-sign assign-user-btn"></span>
						<div class="assign-user"></div>
				</div>
			</div>
			<div class="box-body table-responsive">
				<?php $this->load->view($this->module.'child/parents'); ?>
			</div>
		</div>
	</div>
</div>