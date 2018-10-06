<nav class="navbar navbar-static-top" role="navigation"
     style="margin-left:0;background-color:<?php echo session('company_top_nav_bg_color', '#03a9f4'); ?>">
    <div class="navbar-left">
        <ul class="nav navbar-nav">
            <li class="<?php echo set_active('dashboard'); ?>">
                <a href="<?php echo site_url('dashboard'); ?>" class="logo hidden-sm-up"
                   style="left:0 !important; background-color: <?php echo session('company_logo_bg_color', '#ffeb3b'); ?>">
                    <?php if(session('company_logo') == "") : ?>
                        <span class="" style="position: absolute; top:-7px; left:45px; z-index: 3000">
                                <?php echo session('company_name'); ?>
                            </span>
                    <?php else : ?>
                        <img src="<?php echo base_url().'assets/uploads/content/'.session('company_logo'); ?>"/>
                    <?php endif; ?>
                </a>
                <img class="hidden-md hidden-lg pull-left"
                     style="height:40px;width:40px;margin-top: 5px;margin-left: 5px;"
                     src="<?php echo base_url().'assets/img/thumb.png'; ?>"/>
            </li>

            <li class="<?php echo set_active('dashboard'); ?>">
                <a href="<?php echo site_url('dashboard'); ?>"
                   style="color:<?php echo session('company_top_nav_link_color', '#fff'); ?>">
                    <i class="fa fa-home"></i>
                    <span class="hidden-sm-up "><?php echo lang('dashboard'); ?></span>
                </a>
            </li>

            <li class="<?php echo set_active(['children', 'child']); ?>">
                <a href="<?php echo site_url('children'); ?>"
                   style="color:<?php echo session('company_top_nav_link_color', '#fff'); ?>">
                    <i class="fa fa-users"></i>
                    <span class="hidden-sm-up "><?php echo lang('children'); ?>
                        <small class="badge pull-right bg-green">
                                <?php echo $this->child->getCount(); ?>
                            </small>
                </a>
            </li>
            <li>
                <?php echo anchor('messaging', icon('envelope').' <span class="d-none d-md-block">'.lang('Messages').'</span>'); ?>
            </li>
            <li class="<?php echo set_active('calendar'); ?>">
                <a href="<?php echo site_url('calendar'); ?>"
                   style="color:<?php echo session('company_top_nav_link_color', '#fff'); ?>">
                    <i class="fa fa-calendar"></i>
                    <span class="hidden-sm-up "><?php echo lang('calendar'); ?></span>
                </a>
            </li>
            <li class="<?php echo set_active(['news']); ?>">
                <a href="<?php echo site_url('news'); ?>"
                   style="color:<?php echo session('company_top_nav_link_color', '#fff'); ?>">
                    <i class="fa fa-clipboard"></i>
                    <span class="hidden-sm-up "><?php echo lang('news'); ?></span>
                </a>
            </li>
        </ul>
    </div>
    <div class="navbar-right">
        <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="<?php echo $this->user->photo(session('photo')); ?>" style="width:20px"
                         class="img-circle"/>
                    <span class="hidden-sm-up "><?php echo session('last_name'); ?>
                        <i class="caret"></i></span>
                </a>
                <ul class="dropdown-menu">
                    <li class="user-header bg-light-blue">
                        <img src="<?php echo $this->user->photo(session('photo')); ?>" class="img-circle"/>
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