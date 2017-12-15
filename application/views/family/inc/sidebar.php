<!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<?php
			if ($this->users->user()->photo !== "" ) {
				echo '<img class="img-circle"
         src="' . base_url() . 'assets/img/staff/' . $this->users->user()->photo . '"/>';
			} else {
				echo '<img class="img-circle"
         src="' . base_url() . 'assets/img/no-image.png"/>';
			}
			?>
			</div>
			<div class="pull-left info">
				<p>Hello, <?php echo $this->users->thisUser('username'); ?></p>

				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>

			</div><i title="lockscreen" class="pull-right fa fa-lock lock-screen cursor"></i>
		</div>
		<!-- search form -->
		<!--form action="#" method="get" class="sidebar-form">
			<div class="input-group">
				<input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
			</div>
		</form-->
		<!-- /.search form -->
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			<li class="active">
				<a href="<?php echo site_url('dashboard'); ?>">
					<i class="fa fa-dashboard"></i> <span><?php echo lang('dashboard'); ?></span>
				</a>
			</li>

			<li>
				<a href="<?php echo site_url('calendar'); ?>">
					<i class="fa fa-calendar"></i> <span><?php echo lang('calendar'); ?></span>
				</a>
			</li>

			<li>
				<a href="<?php echo site_url('news'); ?>">
					<i class="fa fa-clipboard"></i>
					<span><?php echo lang('news'); ?></span>
				</a>
			</li>
			<li>
				<a href="<?php echo site_url('mailbox'); ?>">
					<i class="fa fa-envelope"></i> <span><?php echo lang('mailbox'); ?></span>
					<small class="badge pull-right bg-yellow"><?php echo $this->mail->totalUnread(); ?></small>
				</a>
			</li>
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>