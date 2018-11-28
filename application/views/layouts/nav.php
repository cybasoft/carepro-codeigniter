<header class="topbar" data-navbarbg="skin5">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin5">
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                        class="ti-menu ti-close"></i></a>
            <a class="navbar-brand" href="<?php echo site_url(); ?>">
                <b class="logo-icon p-l-10">

                    <?php if(session('company_logo') == '') : ?>
                        <span class=""
                              style="position: absolute; top:-7px; left:45px; z-index: 3000"><?php echo session('company_name'); ?></span>
                        <span class="" style="position: absolute; top:13px; left:50px;
			z-index: 3000; font-size: 12px; color: #ffff00; font-family: monospace"><?php echo session('company_slogan'); ?></span>
                    <?php else : ?>
                        <img class="light-logo"
                             src="<?php echo base_url().'assets/uploads/content/'.session('company_logo'); ?>"/>

                        <img class="dark-logo" src="<?php echo base_url().'assets/uploads/content/logo-small.png'; ?>"/>
                    <?php endif; ?>
                </b>
            </a>
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
               data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
               aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
        </div>
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
            <ul class="navbar-nav float-left mr-auto">
                <li class="nav-item d-none d-md-block">
                    <a class="nav-link sidebartoggler waves-effect waves-light"
                       href="javascript:void(0)" data-sidebartype="mini-sidebar">
                        <i class="fa fa-bars"></i>
                    </a>
                </li>

                <li class="nav-item"><?php echo anchor('messaging', icon('envelope').' '.lang('Messages'), 'class="nav-link"'); ?></li>
                <?php if(is(['manager', 'admin','staff'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" title="<?php echo lang('Register child'); ?>" href="#" data-toggle="modal"
                           data-target="#registerChildModal">
                            <i class="fa fa-user-plus"></i>
                            <span class="hidden-sm-up"><?php echo lang('Register child'); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" title="<?php echo lang('Register user'); ?>" href="#" data-toggle="modal"
                           data-target="#newUserModal">
                            <i class="fa fa-user-plus"></i>
                            <span class="hidden-sm-up"><?php echo lang('Register user'); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

            </ul>
            <ul class="navbar-nav float-right">

                <?php if(base_url() == "https://careproapp.com/demo/"): ?>
                    <li class="nav-item">
                        <a class="nav-link waves-effect waves-dark btn btn-warning"
                           href="https://careproapp.com/checkout">Buy Now</a>
                    </li>
                <?php endif; ?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark"
                       href="#"
                       data-toggle="dropdown"
                       aria-haspopup="true"
                       aria-expanded="false">
                        <i class="fa fa-flag"></i> <?php echo ucwords($this->conf->getLanguage()); ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated">
                        <?php foreach ($this->conf->getLanguages() as $language) {
                            echo anchor(uri_string().'?language='.$language, icon('flag').' '.$language, 'class="dropdown-item"');
                        } ?>
                    </div>
                </li>
                <li class="nav-item lock-screen"><a href="#" class="nav-link"><i class="fa fa-lock cursor"></i></a></li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic"
                       href="#"
                       data-toggle="dropdown"
                       aria-haspopup="true"
                       aria-expanded="false">
                        <img src="<?php echo $this->user->photo(session('photo')); ?>" class="rounded-circle"
                             width="31" height="31">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated">
                        <a class="dropdown-item" href="<?php echo site_url('profile'); ?>">
                            <i class="ti-user m-r-5 m-l-5"></i>
                            <?php echo lang('profile'); ?>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo site_url('auth/logout'); ?>">
                            <i class="fa fa-power-off m-r-5 m-l-5"></i>
                            <?php echo lang('Logout'); ?>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>