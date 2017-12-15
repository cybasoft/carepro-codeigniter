<?php $this->load->view('family/inc/header'); ?>
	<header class="header">
		<a href="<?php echo site_url('dashboard'); ?>" class="logo" style="left:0px !important;">
		<?php if ($this->config->item('logo', 'company') == "") : ?>
		<span class="" style="position: absolute; top:-7px; left:45px; z-index: 3000">
		<?php echo $this->config->item('name', 'company'); ?>
			</span>
		<span class="" style="position: absolute; top:13px; left:50px;
		z-index: 3000; font-size: 12px; color: #ffff00; font-family: monospace">
		<?php echo $this->config->item('slogan', 'company'); ?>
		</span>
<?php else : ?>
<img src="<?php base_url() . 'assets/img/' . $this->config->item('logo', 'company'); ?>"/>
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