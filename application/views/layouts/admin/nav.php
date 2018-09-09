<nav class="navbar navbar-static-top" role="navigation">
    <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only"><?php echo lang('toggle_navigation'); ?></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </a>
    <div class="navbar-left">
        <ul class="nav navbar-nav">
            <li class="lock-screen"><a href="#"><i class="fa fa-lock cursor"></i></a></li>
            <li><?php echo anchor('messaging',icon('envelope')); ?></li>
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
                    <img src="<?php echo $this->user->photo(session('photo')); ?>" style="width:20px" class="img-circle"/>
                    <span class="hidden-xs hidden-sm"><?php echo session('last_name'); ?>
                        <i class="caret"></i></span>
                </a>
                <ul class="dropdown-menu">
                    <li class="user-header bg-light-blue">
                        <img src="<?php  echo $this->user->photo(session('photo')); ?>" class="img-circle"/>
                    </li>

                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="<?php echo site_url('profile'); ?>" class="btn btn-default btn-flat">
                                <?php echo lang('profile'); ?>
                            </a>
                        </div>
                        <div class="pull-right">
                            <a href="<?php echo site_url('auth/logout'); ?>" class="btn btn-default btn-flat">
                                <?php echo lang('logout'); ?>
                            </a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>