<aside class="left-side animate sidebar-offcanvas"
       style="background-color: <?php echo get_option('left_sidebar_bg_color', '#f4f4f'); ?>">
    <section class="sidebar">
        <div class="user-panel">
            <div class="text-center image">
                <img src="<?php echo $this->user->photo(user_id()); ?>" class="img-circle"/>
            </div>
            <div class="text-center user-info">
                <p><span><?php echo lang('hello'); ?></span> <?php echo $this->user->thisUser('first_name'); ?></p>
            </div>
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

        <ul class="left-menu-wrapper list-unstyled" style="">
            <?php $sidebar = [
                [
                    'name' => 'Dashboard',
                    'link' => 'dashboard',
                    'icon' => 'dash',
                    'active' => 'dashboard'
                ],
                [
                    'name' => 'Children',
                    'link' => 'children',
                    'icon' => 'children',
                    'badge' => $this->child->getCount(),
                    'active' => ['children', 'child']
                ],
                [
                    'name' => 'rooms',
                    'link' => 'rooms',
                    'icon' => 'groups',
                    'badge' => $this->rooms->getCount(),
                    'active' => ['rooms', 'room']
                ], [
                    'name' => 'Users',
                    'link' => 'users',
                    'icon' => 'users',
                    'badget' => $this->user->getCount(),
                    'active' => ['users', 'user']
                ],
                [
                    'name' => 'Parents',
                    'link' => 'parents',
                    'icon' => 'parents',
                    'badget' => $this->user->getCount('parent'),
                    'active' => 'parents'
                ],
                [
                    'name' => 'Calendar',
                    'link' => 'calendar',
                    'icon' => 'calendar',
                    'active' => 'calendar'
                ],
                [
                    'name' => 'Files',
                    'link' => 'files',
                    'icon' => 'folder',
                    'active' => 'folder'
                ], [
                    'name' => 'News',
                    'link' => 'news',
                    'icon' => 'news',
                    'active' => ['news', 'article']
                ], [
                    'name' => 'Settigns',
                    'link' => 'settings',
                    'icon' => 'settings',
                    'active' => ['settings']
                ], [
                    'name' => 'Logout',
                    'link' => 'auth/logout',
                    'icon' => 'exit'
                ]
            ];

            ?>

            <?php foreach ($sidebar as $sb): ?>
                <li class="left-menu-parent <?php if(isset($sb['active'])) {
                    echo set_active($sb['active']);
                }; ?>">
                    <a href="<?php echo site_url($sb['link']); ?>"
                       style="color:<?php echo get_option('left_sidebar_link_color', '#333'); ?>">
                        <span class="left-menu-link-icon">
                            <img class="icon" src="<?php echo assets('img/content/'.$sb['icon'].'.svg'); ?>"/>
                        </span>
                        <span class="left-menu-link-info">
                            <span class="link-name"><?php echo $sb['name']; ?></span>
                        </span>
                        <?php if(isset($sb['badge'])): ?>
                            <small class="badge pull-right bg-green">
                                <?php echo $sb['badge']; ?>
                            </small>
                        <?php endif; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

    </section>
    <div class="footer text-center" style="">
        <br/>
        <div style="font-size:12px;padding:5px;">
            &copy; <?php echo date('Y'); ?>
            <?php echo lang('copyright'); ?>
            <br/>
            <br/>
            <a href="//amdtllc.com/support" target="_blank">Open support ticket</a>
            <br/>
        </div>
    </div>
</aside>