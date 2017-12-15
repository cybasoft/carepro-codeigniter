<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-primary btn-dropnav" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>

			<a class="brand" href="<?php echo site_url(); ?>" style="height: 32px;
width: 213px;
margin-top: -15px;
margin-left: -15px;">
				<img src="<?php echo base_url(); ?>/assets/images/logo.png" class="logo">
			</a>

			<div class="nav-collapse collapse">
				<ul class="nav pull-right animated nav-pro">
					<?php
					$nav_links = array(
						'login' => 'Login',
						'contact' => 'Contact us'
					);
					foreach($nav_links as $url => $name) {
						echo '<li>' . anchor($url, $name) . '</li>';
					}
					?>
				</ul>
			</div>
		</div>
	</div>
</div>