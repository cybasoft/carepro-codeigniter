<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo get_option('company_name'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('assets/img/favicon.ico'); ?>"/>
    <meta name="description" content="DaycarePRO - Daycare management system">
    <meta name="author" content="A&M Digital Technologies">
    <link href="<?php echo base_url(); ?>assets/css/login.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/open-iconic-bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/login.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <!--google analytic code-->
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
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
        ga('create', '<?php echo get_option('google_analytics'); ?>', 'auto');
        ga('require', 'displayfeatures');
        ga('send', 'pageview');
    </script>
</head>
<body class="login-page login-1">
<?php if ($this->session->flashdata('message') !=="") : ?>
    <div style="width:460px">
        <div id="msg"
             class="msg alert alert-<?php echo $this->session->flashdata('type'); ?> alert-dismissable">
            <span class="fa fa-<?php echo $this->session->flashdata('icon'); ?>"></span>
            <?php echo $this->session->flashdata('message'); ?>
        </div>
    </div>
<?php endif; ?>

