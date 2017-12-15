<?php $this->load->view('inc/header'); ?>
	<header class="header">
		<a href="<?php echo site_url('dashboard'); ?>" class="logo" style="left:0px !important;">
			<?php echo $this->company->logo(); ?>
			<?php if($this->company->company()->logo == ""): ?>
				<span class="" style="position: absolute; top:-7px; left:45px; z-index: 3000">
				<?php echo $this->company->company()->name; ?>
			 	</span>
				<span class="" style="position: absolute; top:13px; left:50px;
			 z-index: 3000; font-size: 12px; color: #ffff00; font-family: monospace">
				<?php echo $this->company->company()->slogan; ?>
			 </span>
			<?php endif; ?>
		</a>
		<?php $this->load->view('inc/nav'); ?>
	</header>

	<div class="wrapper row-offcanvas row-offcanvas-left">
		<?php $this->load->view('inc/sidebar'); ?>
		<aside class="right-side">
			<?php if($this->uri->segment(1) !== 'child' && $this->uri->segment(1) !== 'invoice'): ?>
				<section class="content-header">
					<h1>
						<?php echo strtoupper($this->uri->segment(1)); ?>
					</h1>
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
						<li class="active"><?php echo ucwords($this->uri->segment(1)); ?></li>
					</ol>
				</section>
			<?php endif; ?>

			<?php echo $this->session->flashdata('message'); ?>

			<!-- Main content -->
			<section class="content">
				<?php $this->load->view($page); ?>
			</section>

		</aside>
	</div>
<?php //$this->load->view('modules/broadcast/index'); ?>
<?php $this->load->view('inc/footer'); ?>