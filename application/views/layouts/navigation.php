<nav class="navbar navbar-static-top" role="navigation"
     style="background-color:<?php echo get_option('top_nav_bg_color', '#03a9f4'); ?>">
    <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only"><?php echo lang('toggle_navigation'); ?></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </a>
    <div class="navbar-left">
        <ul class="nav navbar-nav">
            <li class="lock-screen"><a href="#"><i class="fa fa-lock cursor"></i></a></li>
        </ul>
    </div>
    <div class="navbar-right">
        <ul class="nav navbar-nav">
            <?php if(is(['manager', 'admin'])): ?>
                <li class="btn-warning">
                    <a title="<?php echo lang('Register child'); ?>" href="#" data-toggle="modal"
                       data-target="#registerChildModal">
                        <i class="fa fa-user-plus"></i>
                        <span class="hidden-xs"><?php echo lang('Register child'); ?></span>
                    </a>
                </li>
                <li class="btn-info">
                    <a title="<?php echo lang('Register user'); ?>" href="#" data-toggle="modal"
                       data-target="#newUserModal">
                        <i class="fa fa-user-plus"></i>
                        <span class="hidden-xs"><?php echo lang('Register user'); ?></span>
                    </a>
                </li>
            <?php endif; ?>
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-user"></i>
                    <span><?php echo $this->user->user()->last_name; ?>
                        <i class="caret"></i></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo site_url('profile'); ?>"><i
                                class="fa fa-user"></i> <?php echo lang('profile'); ?></a></li>
                    <li><a href="<?php echo site_url('auth/logout'); ?>"><i
                                class="fa fa-lock"></i> <?php echo lang('logout'); ?></a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>