<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo session('company_name'); ?>
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

    <?php if(!empty(session('company_custom_css'))): ?>
        <style type="text/css">
            <?php echo session('company_custom_css'); ?>
        </style>
    <?php endif; ?>

    <?php if(ENVIRONMENT =='development'): ?>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.1.0/highlight.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.1.0/styles/github.min.css">
    <?php endif; ?>

    <meta id="site_url" content="<?php echo site_url(); ?>">
    <meta id="base_url" content="<?php echo base_url(); ?>">
    <meta id="lockScreenTimer" content="<?php echo session('company_lockscreen_timer'); ?>">
    <script>
        var lang = <?php echo json_encode($this->lang->language); ?>
    </script>

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
        ga('create', '<?php echo session('company_google_analytics'); ?>', 'auto');
        ga('send', 'pageview');
    </script>

</head>
<body class="skin-blue">
<div class="modals-loader"></div>
<header class="header">
    <a href="<?php echo site_url('dashboard'); ?>" class="logo"
       style="left:0 !important; background-color: <?php echo session('company_logo_bg_color', '#ffeb3b'); ?>">
        <?php if(session('company_logo') == "") : ?>
            <span class="" style="position: absolute; top:-7px; left:45px; z-index: 3000">
			<?php echo session('company_name'); ?>
				</span>
            <span class="" style="position: absolute; top:13px; left:50px;
			z-index: 3000; font-size: 12px; color: #ffff00; font-family: monospace">
			<?php echo session('company_slogan'); ?>
			</span>
        <?php else : ?>
            <img src="<?php echo base_url().'assets/uploads/content/'.session('company_logo'); ?>"/>
        <?php endif; ?>
    </a>
    <!--start nav-->
   <?php $this->load->view('layouts/navigation'); ?>
    <!--end nav-->
</header>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!--start sidebar-->
    <?php $this->load->view('layouts/sidebar'); ?>
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/datatables/datatables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/cookie.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/functions.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/global.js" type="text/javascript"></script>
<script>

</script>

<?php if(!empty(session('company_tawkto_embed_url'))): ?>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
        (function () {
            var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = '<?php echo session('company_tawkto_embed_url'); ?>';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
<?php endif; ?>

<?php if($this->input->cookie('timer') > 0): ?>
<!--    <script>startLockscreen()</script>-->
<?php endif; ?>

<?php $this->load->view('children/add_child'); ?>
<?php $this->load->view('users/add_user'); ?>
<?php $this->load->view('reports/report-form-popover'); ?>

</body>
</html>
