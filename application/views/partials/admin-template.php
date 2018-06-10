<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $this->config->item('name', 'company'); ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('assets/img/favicon.ico'); ?>"/>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="<?php echo base_url(); ?>assets/css/open-iconic-bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/plugins/summernote/summernote.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/css/sweetalert.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/css/fullcalendar.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/css/fullcalendar.print.css" rel="stylesheet" type="text/css"
          media='print'/>
    <link rel="stylesheet" type="text/css"
          href="//cdn.datatables.net/v/dt/dt-1.10.16/b-1.5.1/fc-3.2.4/fh-3.1.3/r-2.2.1/datatables.min.css"/>
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/css/print.css" rel="stylesheet" type="text/css" media="print"/>
    <!--[if lt IE 9]>
    <script src="<?php echo base_url(); ?>assets/js/html5shiv.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script>
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
        ga('create', '<?php echo $this->config->item('google_analytics', 'company'); ?>', 'auto');
        ga('send', 'pageview');
    </script>
</head>
<body class="skin-blue">
<header class="header">
    <a href="<?php echo site_url('dashboard'); ?>" class="logo" style="left:0px !important;">
        <?php if($this->config->item('logo', 'company') == "") : ?>
            <span class="" style="position: absolute; top:-7px; left:45px; z-index: 3000">
			<?php echo $this->config->item('name', 'company'); ?>
				</span>
            <span class="" style="position: absolute; top:13px; left:50px;
			z-index: 3000; font-size: 12px; color: #ffff00; font-family: monospace">
			<?php echo $this->config->item('slogan', 'company'); ?>
			</span>
        <?php else : ?>
            <img src="<?php echo base_url().'assets/img/'.$this->config->item('logo', 'company'); ?>"/>
        <?php endif; ?>
    </a>
    <!--start nav-->
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only"><?php echo lang('toggle_navigation'); ?></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
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
                        <i class="fa fa-user"></i>
                        <span><?php echo $this->user->user()->last_name; ?>
                            <i class="caret"></i></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header bg-light-blue">
                            <?php $this->user->getPhoto(NULL, 'class="img-circle"'); ?>
                            <p>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?php echo site_url('profile'); ?>" class="btn btn-default btn-flat">
                                    <?php echo lang('profile'); ?>
                                </a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo site_url('logout'); ?>" class="btn btn-default btn-flat">
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
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!--start sidebar-->
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
                <li class="<?php echo set_active(array('children', 'child')); ?>">
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
        <div class="footer text-center">
            <br/>
            <div style="font-size:11px;padding:5px;">
                &copy; <?php echo date('Y'); ?>
                <?php echo lang('copyright'); ?>
                <br/>
                <br/>
                <a href="//amdtllc.com/support" target="_blank">Open support ticket</a>
            </div>
        </div>
    </aside>
    <!--end sidebar-->
    <aside class="right-side" style="">
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
            <?php if($this->session->flashdata('message') !== "") : ?>
                <div id="msg"
                     class="msg alert alert-<?php echo $this->session->flashdata('type'); ?> alert-dismissable">
                    <span class="fa fa-<?php echo $this->session->flashdata('icon'); ?>"></span>
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
<script src="<?php echo base_url(); ?>assets/js/global.js" type="text/javascript"></script>
<script type="text/javascript"
        src="//cdn.datatables.net/v/dt/dt-1.10.16/b-1.5.1/fc-3.2.4/fh-3.1.3/r-2.2.1/datatables.min.js"></script>
<script type="text/javascript">
    function confirmDelete(loc) {
        swal({
            title: '<?php echo lang('confirm_delete_title'); ?>',
            text: '<?php echo lang('confirm_delete_warning'); ?>',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: '<?php echo lang('confirm_delete_btn'); ?>',
            closeOnConfirm: false,
            backdrop: false,
            allowOutsideClick: false
        }, function () {
            swal('processing...');
            if (loc != undefined)
                window.location.href = loc;
        });
    }

    $('.delete').click(function (e) {
        var loc = $(this).attr('href');
        swal({
            title: '<?php echo lang('confirm_delete_title'); ?>',
            text: '<?php echo lang('confirm_delete_warning'); ?>',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: '<?php echo lang('confirm_delete_btn'); ?>',
            closeOnConfirm: false,
            backdrop: false,
            allowOutsideClick: false
        }, function () {
            swal('processing...');
            if (loc != undefined)
                window.location.href = loc;
        });
        e.preventDefault();
    });
    $(document).ready(function () {
        $('#attendance').DataTable({
            buttons: [
                'pdf'
            ]
        });
    });
    //lockscreen
    $('.lock-screen').click(function () {
        startLockscreen();
    });
    setTimeout(function () {
        startLockscreen()
    }, 900000);

    function startLockscreen() {
        $('body').load('<?php echo site_url('lockscreen'); ?>');
        $('html').addClass('lockscreen');
    }
</script>
<?php if($this->input->cookie('timer')>0): ?>
    <script>startLockscreen()</script>
<?php endif; ?>
</body>
</html>
