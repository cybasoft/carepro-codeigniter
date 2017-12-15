<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">



    <title><?php echo $this->config->item('name', 'company'); ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="">

    <meta name="author" content="iCoolPix Designs">





    <link href="<?php echo base_url(); ?>assets/landing/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/landing/css/bootstrap-responsive.min.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/landing/css/glyphicons.css" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>

    <link href="<?php echo base_url(); ?>assets/landing/css/base.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/landing/css/blue.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/landing/css/cassets/imgl="stylesheet">



    <!--[if lt IE 9]>

    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>

    <![endif]-->



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

    <script>window.jQuery || document.write('<script src="<?php echo base_url(); ?>assets/landing/js/jquery-1.8.3.min.js"><\/script>')</script>



    <link rel="apple-touch-icon-precomposed" sizes="144x144"

          href="<?php echo base_url(); ?>assets/landing/ico/apple-touch-icon-144-precomposed.png">

    <link rel="apple-touch-icon-precomposed" sizes="114x114"

          href="<?php echo base_url(); ?>assets/landing/ico/apple-touch-icon-114-precomposed.png">

    <link rel="apple-touch-icon-precomposed" sizes="72x72"

          href="<?php echo base_url(); ?>assets/landing/ico/apple-touch-icon-72-precomposed.png">

    <link rel="apple-touch-icon-precomposed"

          href="<?php echo base_url(); ?>assets/landing/ico/apple-touch-icon-57-precomposed.png">

    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.ico">



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

        ga('create', '<?php echo $this->config->item('google_analytics','company'); ?>', 'auto');

        ga('require', 'displayfeatures');

        ga('send', 'pageview');

    </script>



</head>



<body>



<?php $this->load->view('landing/nav'); ?>

<?php echo $this->session->flashdata('message'); ?>

