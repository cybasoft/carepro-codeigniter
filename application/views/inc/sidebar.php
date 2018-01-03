<!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <?php $this->user->getPhoto(NULL, 'class="img-circle"'); ?>
            </div>
            <div class="pull-left info">
                <p><?php echo lang('hello'); ?>, <?php echo $this->user->thisUser('first_name'); ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> </a>

            </div>
            <i title="lockscreen" class="pull-right fa fa-lock lock-screen cursor"></i>
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
            <li class="<?php echo set_active('dashboard'); ?>">
                <a href="<?php echo site_url('dashboard'); ?>">
                    <i class="fa fa-dashboard"></i> <span><?php echo lang('dashboard'); ?></span>
                </a>
            </li>

            <li class="<?php echo set_active(array('children','child')); ?>">
                <a href="<?php echo site_url('children'); ?>">
                    <i class="fa fa-users"></i> <span><?php echo lang('children'); ?>
                        <small class="badge pull-right bg-green"><?php echo $this->child->getCount(); ?></small>
                </a>
            </li>

            <?php if(is('admin') || is('manager')): ?>
            <li class="<?php echo set_active('users'); ?>">
                <a href="<?php echo site_url('users'); ?>">
                    <i class="fa fa-user"></i> <span><?php echo lang('users'); ?></span>
                    <small class="badge pull-right bg-blue"><?php echo $this->user->getCount(); ?></small>
                </a>
            </li>
            <?php endif; ?>

            <li class="<?php echo set_active('calendar'); ?>">
                <a href="<?php echo site_url('calendar'); ?>">
                    <i class="fa fa-calendar"></i> <span><?php echo lang('calendar'); ?></span>
                    <!--small class="badge pull-right bg-red">3</small-->
                </a>
            </li>
            <li class="<?php echo set_active(['news']); ?>">
                <a href="<?php echo site_url('news'); ?>">
                    <i class="fa fa-clipboard"></i>
                    <span><?php echo lang('news'); ?></span>
                </a>
            </li>

            <?php if(is('admin')): ?>
            <li class="<?php echo set_active('settings'); ?>">
                <a href="<?php echo site_url('settings'); ?>">
                    <i class="fa fa-gears"></i> <span><?php echo lang('settings'); ?></span>
                </a>
            </li>
            <?php endif; ?>

        </ul>
    </section>
    <!-- /.sidebar -->

    <div class="footer text-center">
        <br/>

        <div style="font-size:11px;padding:5px;">
            &copy; <?php echo date('Y'); ?>
            <?php echo lang('copyright'); ?>
            <br/>
            <br/>
            <a href="https://amdtllc.com/support" target="_blank">Open support ticket</a>
        </div>
    </div>
</aside>