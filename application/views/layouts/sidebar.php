<aside class="left-sidebar" data-sidebarbg="skin5">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <?php $sidebar = [
                    [
                        'name' => 'Dashboard',
                        'link' => 'dashboard',
                        'icon' => 'dash',
                        'active' => 'dashboard',
                        'allow' => ['admin', 'manager', 'staff', 'parent','owner'],
                    ],
                    [
                        'name' => 'Children',
                        'link' => 'children',
                        'icon' => 'children',
                        'active' => ['children', 'child'],
                        'allow' => ['admin', 'manager', 'staff'],
                    ],
                    [
                        'name' => 'Rooms',
                        'link' => 'rooms',
                        'icon' => 'groups',
                        'active' => ['rooms', 'room'],
                        'users' => ['admin', 'manager', 'staff'],
                        'allow' => ['admin', 'manager', 'staff'],
                    ],
                    [
                        'name' => 'Users',
                        'link' => 'users',
                        'icon' => 'users',
                        'active' => ['users', 'user'],
                        'allow' => ['admin', 'manager'],
                    ],
                    [
                        'name' => 'Parents',
                        'link' => 'parents',
                        'icon' => 'parents',
                        'active' => 'parents',
                        'allow' => ['admin', 'manager', 'staff'],
                    ],
                    [
                        'name' => 'Calendar',
                        'link' => 'calendar',
                        'icon' => 'calendar',
                        'active' => 'calendar',
                        'allow' => ['admin', 'manager', 'staff', 'parent'],
                    ],
                    // [
                    //     'name' => 'Files',
                    //     'link' => 'files',
                    //     'icon' => 'folder',
                    //     'active' => 'folder',
                    //     'allow' => ['admin', 'manager', 'staff'],
                    // ], [
                    //     'name' => 'News',
                    //     'link' => 'news',
                    //     'icon' => 'news',
                    //     'active' => ['news', 'article'],
                    //     'allow' => ['admin', 'manager', 'staff', 'parent'],
                    // ], 
                    [
                        'name' => 'Settings',
                        'link' => 'settings',
                        'icon' => 'settings',
                        'active' => ['settings'],
                        'allow' => ['admin'],
                    ], [
                        'name' => 'Logout',
                        'link' => 'logout',
                        'icon' => 'exit',
                        'allow' => ['admin', 'manager', 'staff', 'parent'],
                    ],
                ];

                ?>
                <?php foreach ($sidebar as $sb): ?>
                    <?php
                    if(!is($sb['allow'])) continue;
                    ?>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link"
                           href="<?php echo site_url($sb['link']); ?>"
                           aria-expanded="false">
                            <!--                        <i class="mdi mdi-view-dashboard"></i>-->
                            <img style="width:35px;height:26px;"
                                src="<?php echo assets('img/content/'.$sb['icon'].'.svg'); ?>"/>&nbsp;&nbsp;
                            <span class="hide-menu"><?php echo $sb['name']; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>
</aside>