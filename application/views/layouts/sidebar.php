<aside class="left-sidebar" data-sidebarbg="skin5">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <?php $sidebar = [
                    [
                        'name' => 'Dashboard',
                        'link' => $daycare_id.'/dashboard',
                        'icon' => 'dash',
                        'active' => 'dashboard',
                        'allow' => ['admin', 'manager', 'staff', 'parent'],
                    ],
                    [
                        'name' => 'Children',
                        'link' => $daycare_id.'/children',
                        'icon' => 'children',
                        'active' => ['children', 'child'],
                        'allow' => ['admin', 'manager', 'staff', 'parent'],
                    ],
                    [
                        'name' => 'rooms',
                        'link' => $daycare_id.'/rooms',
                        'icon' => 'groups',
                        'active' => ['rooms', 'room'],
                        'users' => ['admin', 'manager', 'staff'],
                        'allow' => ['admin', 'manager', 'staff'],
                    ],
                    [
                        'name' => 'Users',
                        'link' => $daycare_id.'/users',
                        'icon' => 'users',
                        'active' => ['users', 'user'],
                        'allow' => ['admin', 'manager'],
                    ],
                    [
                        'name' => 'Parents',
                        'link' => $daycare_id.'/parents',
                        'icon' => 'parents',
                        'active' => 'parents',
                        'allow' => ['admin', '/manager'],
                    ],
                    [
                        'name' => 'Calendar',
                        'link' => $daycare_id.'/calendar',
                        'icon' => 'calendar',
                        'active' => 'calendar',
                        'allow' => ['admin', 'manager', 'staff', 'parent'],
                    ],
                    [
                        'name' => 'Files',
                        'link' => $daycare_id.'/files',
                        'icon' => 'folder',
                        'active' => 'folder',
                        'allow' => ['admin', 'manager', 'staff'],
                    ], [
                        'name' => 'News',
                        'link' => $daycare_id.'/news',
                        'icon' => 'news',
                        'active' => ['news', 'article'],
                        'allow' => ['admin', 'manager', 'staff', 'parent'],
                    ], [
                        'name' => 'Settings',
                        'link' => $daycare_id.'/settings',
                        'icon' => 'settings',
                        'active' => ['settings'],
                        'allow' => ['admin'],
                    ], [
                        'name' => 'Logout',
                        'link' => $daycare_id.'/logout',
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