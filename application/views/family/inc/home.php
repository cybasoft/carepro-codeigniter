<?php $this->load->view('family/inc/header'); ?>
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
		<?php $this->load->view('family/inc/nav'); ?>
	</header>

	<div class="wrapper row-offcanvas row-offcanvas-left">
		<?php $this->load->view('family/inc/sidebar'); ?>
		<aside class="right-side">
			<?php echo $this->session->flashdata('message'); ?>

			<!-- Main content -->
			<section class="content">
				<?php $this->load->view($page); ?>
			</section>

		</aside>
	</div>
<?php $this->load->view('family/inc/footer'); ?>