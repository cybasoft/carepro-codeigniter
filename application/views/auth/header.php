<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo session('company_name'); ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="DaycarePRO - Daycare management system">
    <meta name="author" content="A&M Digital Technologies">
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/img/favicon.ico'); ?>"/>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="<?php echo assets('css/login.css'); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo assets('css/login-utils.css'); ?>"/>

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
        ga('create', '<?php echo session('company_google_analytics'); ?>', 'auto');
        ga('require', 'displayfeatures');
        ga('send', 'pageview');
    </script>
</head>

<body style="background-color: #666666;">

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">