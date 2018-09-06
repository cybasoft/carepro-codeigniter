<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo get_option('company_name'); ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('assets/img/favicon.ico'); ?>"/>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="<?php echo base_url(); ?>assets/css/open-iconic-bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/css/fontawesome-all.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/plugins/summernote/summernote.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/css/sweetalert.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url(); ?>assets/plugins/datatables/datatables.min.css"/>
    <link href="<?php echo base_url(); ?>assets/css/fullcalendar.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/css/fullcalendar.print.css" rel="stylesheet" type="text/css"
          media='print'/>

    <meta id="site_url" content="<?php echo site_url(); ?>">
    <meta id="base_url" content="<?php echo base_url(); ?>">
    <meta id="lockScreenTimer" content="<?php echo get_option('lockscreen_timer'); ?>">
    <script>
        var lang = <?php echo json_encode($this->lang->language); ?>
    </script>

    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/css/print.css" rel="stylesheet" type="text/css" media="print"/>

    <script type="text/javascript">
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
        ga('create', '<?php echo get_option('google_analytics'); ?>', 'auto');
        ga('send', 'pageview');

    </script>

    <!--[if lt IE 9]>
    <script src="<?php echo base_url(); ?>assets/js/html5shiv.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
</head>
<body class="skin-blue" style="background-color:#ccc;">

<header class="header container">

    <!--start nav-->
    <nav class="navbar navbar-static-top" role="navigation"
         style="margin-left:0;background-color:<?php echo get_option('top_nav_bg_color', '#03a9f4'); ?>">
        <div class="navbar-left">
            <ul class="nav navbar-nav">
                <li class="<?php echo set_active('dashboard'); ?>">
                    <a href="<?php echo site_url('dashboard'); ?>" class="logo hidden-xs"
                       style="left:0 !important; background-color: <?php echo get_option('logo_bg_color', '#ffeb3b'); ?>">
                        <?php if(get_option('logo') == "") : ?>
                            <span class="" style="position: absolute; top:-7px; left:45px; z-index: 3000">
                                <?php echo get_option('company_name'); ?>
                            </span>
                        <?php else : ?>
                            <img src="<?php echo base_url().'assets/uploads/content/'.get_option('logo'); ?>"/>
                        <?php endif; ?>
                    </a>
                    <img class="hidden-md hidden-lg pull-left"
                         style="height:40px;width:40px;margin-top: 5px;margin-left: 5px;"
                         src="<?php echo base_url().'assets/img/thumb.png'; ?>"/>
                </li>

                <li class="<?php echo set_active('dashboard'); ?>">
                    <a href="<?php echo site_url('dashboard'); ?>"
                       style="color:<?php echo get_option('top_nav_link_color', '#fff'); ?>">
                        <i class="fa fa-home"></i>
                        <span class="hidden-xs hidden-sm"><?php echo lang('dashboard'); ?></span>
                    </a>
                </li>

                <li class="<?php echo set_active(array('children', 'child')); ?>">
                    <a href="<?php echo site_url('children'); ?>"
                       style="color:<?php echo get_option('top_nav_link_color', '#fff'); ?>">
                        <i class="fa fa-users"></i>
                        <span class="hidden-xs hidden-sm"><?php echo lang('children'); ?>
                            <small class="badge pull-right bg-green">
                                <?php echo $this->child->getCount(); ?>
                            </small>
                    </a>
                </li>
                <li class="<?php echo set_active('calendar'); ?>">
                    <a href="<?php echo site_url('calendar'); ?>"
                       style="color:<?php echo get_option('top_nav_link_color', '#fff'); ?>">
                        <i class="fa fa-calendar"></i>
                        <span class="hidden-xs hidden-sm"><?php echo lang('calendar'); ?></span>
                    </a>
                </li>
                <li class="<?php echo set_active(['news']); ?>">
                    <a href="<?php echo site_url('news'); ?>"
                       style="color:<?php echo get_option('top_nav_link_color', '#fff'); ?>">
                        <i class="fa fa-clipboard"></i>
                        <span class="hidden-xs hidden-sm"><?php echo lang('news'); ?></span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <?php if(!is('parent')): ?>
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-warning"></i>
                            <!--span class="label label-warning">10</span-->
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header"><?php echo lang('notifications'); ?></li>
                            <li>
                                <ul class="menu">
                                    <li>
                                        <a href="<?php echo site_url('children'); ?>">
                                            <i class="fa fa-users warning"></i>
                                            <small class="badge bg-default"><?php echo $this->child->getCount(); ?></small>
                                            <?php echo lang('enrolled_children'); ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('users'); ?>">
                                            <i class="fa fa-group success"></i>
                                            <small class="badge bg-default"><?php echo $this->user->getCount(); ?></small>
                                            <?php echo lang('registered_users'); ?>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--li class="footer"><a href="#">View all</a></li-->
                        </ul>
                    </li>
                <?php endif; ?>

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo $this->user->photo(user_id()); ?>" style="width:20px" class="img-circle"/>
                        <span class="hidden-xs hidden-sm"><?php echo $this->user->user()->last_name; ?>
                            <i class="caret"></i></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header bg-light-blue">
                            <img src="<?php echo $this->user->photo(user_id()); ?>" class="img-circle"/>
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
    <!--end nav-->
</header>

<div class="wrapper container">

    <aside class="right-side" style="margin-left:0">
        <?php if($this->uri->segment(1) !== 'child' && $this->uri->segment(1) !== 'invoice') : ?>
            <section class="content-header">
                <h1>
                    <?php echo strtoupper($this->uri->segment(1)); ?>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo lang('home'); ?></a></li>
                    <li class="active"><?php echo ucwords($this->uri->segment(1)); ?></li>
                </ol>
            </section>
        <?php endif; ?>
        <!-- Main content -->
        <section class="content">
            <?php if(!empty($this->session->flashdata('type'))) : ?>
                <div id="msg" class="msg">
                    <?php echo $this->session->flashdata('message'); ?>
                </div>
            <?php endif; ?>

            <?php $this->load->view($page); ?>
        </section>

    </aside>
</div>

<!--start footer-->
<script src="<?php echo base_url(); ?>assets/plugins/summernote/summernote.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/sweetalert2.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/fullcalendar.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/datatables/datatables.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/functions.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/global.js" type="text/javascript"></script>


<?php if(!empty(get_option('tawkto_embed_url'))): ?>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
        (function () {
            var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = '<?php echo get_option('tawkto_embed_url'); ?>';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
<?php endif; ?>
</body>
</html>
