<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo get_option('company_name'); ?>
        <?php if(isset($this->title)) {
            echo ' - '.$this->title;
        } ?>
    </title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('assets/img/favicon.ico'); ?>"/>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="<?php echo base_url(); ?>assets/css/open-iconic-bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/css/fontawesome-all.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/plugins/summernote/summernote.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/css/sweetalert.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/css/fullcalendar.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/css/fullcalendar.print.css" rel="stylesheet" type="text/css"
          media='print'/>
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url(); ?>assets/plugins/datatables/datatables.min.css"/>
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/css/print.css" rel="stylesheet" type="text/css" media="print"/>

    <?php if(!empty(get_option('custom_css'))): ?>
        <style type="text/css">
            <?php echo get_option('custom_css'); ?>
        </style>
    <?php endif; ?>

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
        ga('create', '<?php echo get_option('google_analytics'); ?>', 'auto');
        ga('send', 'pageview');
    </script>
</head>
<body class="skin-blue">
<div class="modals-loader"></div>
<header class="header">
    <a href="<?php echo site_url('dashboard'); ?>" class="logo"
       style="left:0 !important; background-color: <?php echo get_option('logo_bg_color', '#ffeb3b'); ?>">
        <?php if(get_option('logo') == "") : ?>
            <span class="" style="position: absolute; top:-7px; left:45px; z-index: 3000">
			<?php echo get_option('company_name'); ?>
				</span>
            <span class="" style="position: absolute; top:13px; left:50px;
			z-index: 3000; font-size: 12px; color: #ffff00; font-family: monospace">
			<?php echo get_option('slogan'); ?>
			</span>
        <?php else : ?>
            <img src="<?php echo base_url().'assets/uploads/content/'.get_option('logo'); ?>"/>
        <?php endif; ?>
    </a>
    <!--start nav-->
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
    <!--end nav-->
</header>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!--start sidebar-->
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side animate sidebar-offcanvas"
           style="background-color: <?php echo get_option('left_sidebar_bg_color', '#f4f4f'); ?>">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="text-center image">
                    <img src="<?php echo $this->user->photo(user_id()); ?>" class="img-circle"/>
                </div>
                <div class="text-center">
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
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="<?php echo set_active('dashboard'); ?>">
                    <a href="<?php echo site_url('dashboard'); ?>"
                       style="color:<?php echo get_option('left_sidebar_link_color', '#333'); ?>">
                        <img class="icon" src="<?php echo assets('img/content/dash.svg'); ?>"/>
                        <span><?php echo lang('dashboard'); ?></span>
                    </a>
                </li>
                <li class="<?php echo set_active(array('children', 'child')); ?>">
                    <a href="<?php echo site_url('children'); ?>"
                       style="color:<?php echo get_option('left_sidebar_link_color', '#333'); ?>">
                        <img class="icon" src="<?php echo assets('img/content/children.svg'); ?>"/>
                        <span><?php echo lang('children'); ?></span>
                        <small class="badge pull-right bg-green">
                            <?php echo $this->child->getCount(); ?>
                        </small>
                    </a>
                </li>
                <li class="<?php echo set_active(array('rooms', 'room')); ?>">
                    <a href="<?php echo site_url('rooms'); ?>"
                       style="color:<?php echo get_option('left_sidebar_link_color', '#333'); ?>">
                        <img class="icon" src="<?php echo assets('img/content/groups.svg'); ?>"/>
                        <span><?php echo lang('rooms'); ?></span>
                        <small class="badge pull-right bg-green">
                            <?php echo $this->rooms->getCount(); ?>
                        </small>
                    </a>
                </li>
                <?php if(is(['admin', 'manager'])): ?>
                    <li class="<?php echo set_active('users'); ?>">
                        <a href="<?php echo site_url('users'); ?>"
                           style="color:<?php echo get_option('left_sidebar_link_color', '#333'); ?>">
                            <img class="icon" src="<?php echo assets('img/content/users.svg'); ?>"/>
                            <span><?php echo lang('users'); ?></span>
                            <small class="badge pull-right bg-blue">
                                <?php echo $this->user->getCount(); ?>
                            </small>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(is(['admin', 'manager'])): ?>
                    <li class="<?php echo set_active('parents'); ?>">
                        <a href="<?php echo site_url('parents'); ?>"
                           style="color:<?php echo get_option('left_sidebar_link_color', '#333'); ?>">
                            <img class="icon" src="<?php echo assets('img/content/parents.svg'); ?>"/>
                            <span><?php echo lang('parents'); ?></span>
                            <small class="badge pull-right bg-blue"><?php echo $this->user->getCount('parent'); ?></small>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="<?php echo set_active('calendar'); ?>">
                    <a href="<?php echo site_url('calendar'); ?>"
                       style="color:<?php echo get_option('left_sidebar_link_color', '#333'); ?>">
                        <img class="icon" src="<?php echo assets('img/content/calendar.svg'); ?>"/>
                        <span><?php echo lang('calendar'); ?></span>
                    </a>
                </li>
                <li class="<?php echo set_active('files'); ?>">
                    <a href="<?php echo site_url('files'); ?>"
                       style="color:<?php echo get_option('left_sidebar_link_color', '#333'); ?>">
                        <img class="icon" src="<?php echo assets('img/content/folder.svg'); ?>"/>
                        <span><?php echo lang('files'); ?></span>
                    </a>
                </li>
                <li class="<?php echo set_active(['news']); ?>">
                    <a href="<?php echo site_url('news'); ?>"
                       style="color:<?php echo get_option('left_sidebar_link_color'); ?>">
                        <img class="icon" src="<?php echo assets('img/content/news.svg'); ?>"/>
                        <span><?php echo lang('news'); ?></span>
                    </a>
                </li>
                <?php if(is(['admin', 'manager'])): ?>
                    <li class="<?php echo set_active('settings'); ?>">
                        <a href="<?php echo site_url('settings'); ?>"
                           style="color:<?php echo get_option('left_sidebar_link_color', '#333'); ?>">
                            <img class="icon" src="<?php echo assets('img/content/settings.svg'); ?>"/>
                            <span><?php echo lang('settings'); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <li>
                    <a href="<?php echo site_url('auth/logout'); ?>"
                       style="color:<?php echo get_option('left_sidebar_link_color', 'red'); ?>">
                        <img class="icon" src="<?php echo assets('img/content/exit.svg'); ?>"/>
                        <span><?php echo lang('logout'); ?></span>
                    </a>
                </li>
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
    <!--end sidebar-->
    <aside class="right-side animate" style="">
        <?php if($this->uri->segment(1) !== 'child' && $this->uri->segment(1) !== 'invoice') : ?>
            <section class="content-header">
                <h1>
                    <?php echo isset($this->title) ? $this->title : strtoupper($this->uri->segment(1)); ?>
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
<script src="<?php echo base_url(); ?>assets/js/global.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/datatables/datatables.min.js"></script>
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
            if (loc === undefined || loc === 'undefined'){
            swal({type:'warning',title:'Error'})
            }else {
                window.location.href = loc;
            }
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
            if (loc === undefined || loc === 'undefined'){
                swal({type:'warning',title:'Error'})
            }else {
                window.location.href = loc;
            }
        });
        e.preventDefault();
    });
    $(document).ready(function () {
        $('#attendance').DataTable({
            buttons: [
                'pdf'
            ]
        });
        $('#datatable').DataTable();
        $('#users').DataTable({
            buttons: [
                'pdf'
            ]
        });
    });
    //lockscreen
    var timerMins = '<?php echo get_option('lockscreen_timer'); ?>';

    if (timerMins === undefined || timerMins === "")
        timerMins = 5;

    var lockTimer = 1320000 * timerMins;

    $('.lock-screen').click(function () {
        startLockscreen();
    });

    setTimeout(function () {
        startLockscreen()
    }, lockTimer);

    function startLockscreen() {
        $('body').load('<?php echo site_url('lockscreen'); ?>');
        $('html').addClass('lockscreen');
    }
</script>
<script>
    $(document).ready(function () {
        $('.reportsBtn').popover({
            title: '<?php echo lang('reports'); ?>',
            html: true,
            placement: 'bottom',
            content: function () {
                return $('#daily-report').html();
            }
        });
    })

    function editUser(id) {
        $('.modals-loader').load('<?php echo site_url('users/view'); ?>/' + id, function () {
            $('#editUserModal').modal('show')
        })
    }
</script>

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

<?php if($this->input->cookie('timer') > 0): ?>
    <script>startLockscreen()</script>
<?php endif; ?>

<?php $this->load->view('modules/children/add_child'); ?>
<?php $this->load->view('modules/users/add_user'); ?>
<?php $this->load->view('modules/reports/report-form-popover'); ?>

</body>
</html>
