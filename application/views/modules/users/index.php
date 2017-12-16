<div class="nav-tabs-custom">
	<ul class="nav nav-tabs">
		<li class="active">
			<a href="#users" data-toggle="tab"><i class="fa fa-list"></i>
				<span class="hidden-xs"><?php echo lang('all_users'); ?></span></a>
		</li>
		<li>
			<a href="#create-user" data-toggle="tab"><i class="fa fa-plus"></i>
				<span class="hidden-xs"><?php echo lang('new_user'); ?></span></a>
		</li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="users">
			<?php $this->load->view($this->module.'users'); ?>
		</div>
		<div class="tab-pane" id="create-user">
			<?php $this->load->view($this->module.'create_user'); ?>
		</div>

	</div>
</div>