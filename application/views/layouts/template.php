<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon.png">
    <title><?php echo session('company_name'); ?>
        <?php echo (isset($this->title)) ? ' - '.$this->title : ''; ?>
    </title>

    <link href="<?php echo assets('css/theme.css'); ?>" rel="stylesheet">

    <link href="<?php echo assets('css/print.css'); ?>" rel="stylesheet"  media="print">
    <link href="<?php echo assets('plugins/datatables/dataTables.bootstrap.css'); ?>" rel="stylesheet"  media="all">
    <link href="<?php echo assets('plugins/fc/fullcalendar.css'); ?>" rel="stylesheet"  media="all">
    <link href="<?php echo assets('plugins/fc/fullcalendar.print.css'); ?>" rel="stylesheet"  media="print">
    <link href="<?php echo assets('plugins/sweetalert/sweetalert.css'); ?>" rel="stylesheet"  media="all">

    <link href="<?php echo assets('css/theme-style.css'); ?>" rel="stylesheet">

    <?php if(!empty(session('company_custom_css'))): ?>
        <style type="text/css">
            <?php echo session('company_custom_css'); ?>
        </style>
    <?php endif; ?>

    <meta id="site_url" content="<?php echo site_url(); ?>/">
    <meta id="base_url" content="<?php echo base_url(); ?>/">
    <meta id="lockScreenTimer" content="<?php echo session('company_lockscreen_timer'); ?>">
    <script>
        var lang = <?php echo json_encode($this->lang->language); ?> ;
        var site_url = '<?php echo site_url(); ?>/';
    </script>

    <script src="<?php echo assets('plugins/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo assets('plugins/extras/jquery-ui.min.js'); ?>" type="text/javascript"></script>
<!--    <script src="--><?php //echo assets('plugins/extras/jquery.ui.touch-punch-improved.js'); ?><!--" type="text/javascript"></script>-->

    <?php if(ENVIRONMENT == 'testing'): ?>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <script type="text/javascript"
                src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.1.0/highlight.min.js"></script>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.1.0/styles/github.min.css">
    <?php endif; ?>

    <!--[if lt IE 9]>
    <script src="<?php echo assets('plugins/extras/html5shiv.js'); ?>"></script>
    <script src="<?php echo assets('plugins/extras/respond.min.js'); ?>"></script>
    <![endif]-->

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

<body>
<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<div id="main-wrapper">
    <?php $this->load->view('layouts/nav'); ?>
    <?php $this->load->view('layouts/sidebar'); ?>

    <div class="page-wrapper">
        <?php if($this->uri->segment(1) !== 'child' && $this->uri->segment(1) !== 'invoice') : ?>
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">
                            <?php echo isset($this->title) ? $this->title : strtoupper($this->uri->segment(1)); ?>
                        </h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><?php echo anchor('/', lang('Home')); ?></li>
                                    <li class="breadcrumb-item active"
                                        aria-current="page"><?php echo ucwords($this->uri->segment(1)); ?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <?php $this->load->view($page); ?>
                </div>
            </div>
        </div>
        <?php if(!empty($this->session->flashdata('type'))) : ?>
            <div id="msg" class="msg">
                <?php echo $this->session->flashdata('message'); ?>
            </div>
        <?php endif; ?>
        <footer class="footer text-center">
            &copy;
            <?php echo date('Y'); ?> |
            <?php echo lang('copyright'); ?> |
            <a href="//amdtllc.com/support" target="_blank">Open support ticket</a>
        </footer>
    </div>
</div>

<div class="modals-loader"></div>
<?php $this->load->view('layouts/modals'); ?>

<script src="<?php echo assets('plugins/extras/moment.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo assets('plugins/extras/jquery.slimscroll.js'); ?>" type="text/javascript"></script>

<script src="<?php echo assets('plugins/popper/popper.min.js'); ?>"></script>
<script src="<?php echo assets('plugins/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo assets('plugins/perfect-scrollbar/perfect-scrollbar.jquery.min.js'); ?>"></script>
<script src="<?php echo assets('plugins/sparkline/sparkline.js'); ?>"></script>

<script src="<?php echo assets('plugins/sweetalert/sweetalert2.js'); ?>" type="text/javascript"></script>
<script src="<?php echo assets('plugins/fc/fullcalendar.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo assets('js/calendar.js'); ?>" type="text/javascript"></script>
<script src="<?php echo assets('plugins/datatables/datatables.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo assets('js/functions.js'); ?>" type="text/javascript"></script>

<script src="<?php echo assets('js/global.js'); ?>" type="text/javascript"></script>

<script src="<?php echo assets('js/waves.js'); ?>"></script>
<script src="<?php echo assets('js/sidebarmenu.js'); ?>"></script>
<script src="<?php echo assets('js/custom.js'); ?>"></script>

<script src="<?php echo assets('plugins/listjs/list.min.js'); ?>" type="text/javascript"></script>

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
<?php if(ENVIRONMENT !== "development" && $this->input->cookie('timer') > 0): ?>
    <script>startLockscreen()</script>
<?php endif; ?>

<?php $this->load->view('partials/editor'); ?>
</body>

</html>