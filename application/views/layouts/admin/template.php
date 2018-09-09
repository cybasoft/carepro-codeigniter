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
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
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
    <a href="<?php echo site_url('dashboard'); ?>" class="logo">
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
   <?php $this->load->view('layouts/admin/nav'); ?>
    <!--end nav-->
</header>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!--start sidebar-->
    <?php $this->load->view('layouts/admin/sidebar'); ?>
    <!--end sidebar-->
    <aside class="right-side animate" style="">
        <?php if($this->uri->segment(1) !== 'child' && $this->uri->segment(1) !== 'invoice') : ?>
            <section class="content-header">
                <h1>
                    <?php echo isset($this->title) ? $this->title : strtoupper($this->uri->segment(1)); ?>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo lang('Home'); ?></a></li>
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
<script src="<?php echo base_url(); ?>assets/plugins/jquery.slimscroll.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/list.min.js" type="text/javascript"></script>
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


<div class="modal fade" id="registerChildModal" tabindex="-1" role="dialog" aria-labelledby="registerChildModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="registerChildModalLabel"><?php echo lang('Register child'); ?></h4>
            </div>
            <?php echo form_open('child/register'); ?>

            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <?php echo form_label(lang('nickname'));
                        echo form_input('nickname', set_value('nickname'), ['class' => 'form-control' ]);
                        echo form_label(lang('first_name'));
                        echo form_input('first_name',set_value('first_name'), ['class' => 'form-control','required'=>'']);
                        echo form_label(lang('last_name'));
                        echo form_input('last_name',set_value('last_name'), ['class' => 'form-control', 'required'=>'']);
                        echo form_label(lang('birthday'));
                        echo form_date('bday', set_value('bday',date('Y-m-d')), ['class' => 'form-control']);
                        echo form_label(lang('gender'));
                        echo form_dropdown('gender', ['male'=>lang('male'),'female'=>lang('female'),'other'=>lang('other')],set_value('gender'), ['class' => 'form-control']);
                        echo form_label('ID');
                        echo form_input('national_id',set_value('national_id'), ['class' => 'form-control','required'=>'' ]);
                        ?>
                    </div>
                    <div class="col-sm-6">
                        <?php
                        echo form_label(lang('blood_type'));
                        echo form_dropdown('blood_type', blood_types(),set_value('blood_type'), ['class' => 'form-control', ]);
                        echo form_label(lang('status'));
                        echo form_dropdown('status', [1=>lang('active'),0=>lang('inactive')],set_value('status'), ['class' => 'form-control', ]);
                        echo form_label(lang('Ethnicity'));
                        echo form_input('ethnicity', set_value('ethnicity'), ['class' => 'form-control', ]);
                        echo form_label(lang('religion'));
                        echo form_input('religion', set_value('religion'), ['class' => 'form-control', ]);
                        echo form_label(lang('birthplace'));
                        echo form_input('birthplace',set_value('birthplace'), ['class' => 'form-control', ]);
                        ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <?php echo lang('close'); ?>
                </button>
                <button class="btn btn-primary"><?php echo lang('submit'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="newUserModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="newUserModal"><?php echo lang('Register user'); ?></h4>
            </div>
            <?php echo form_open("users/create"); ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-6">
                            <?php
                            echo form_label(lang('first_name'));
                            echo form_input('first_name', session('first_name'), ['class' => 'form-control', 'required' => '']);
                            echo form_label(lang('last_name'));
                            echo form_input('last_name', set_value('last_name'), ['class' => 'form-control', 'required' => '']);
                            echo form_label(lang('email'));
                            echo form_email('email',set_value('email'),['class'=>'form-control','required'=>'']);
                            echo form_label(lang('phone'));
                            echo form_input('phone', set_value('phone'), ['class' => 'form-control', 'required' => '']);
                            echo form_label(lang('password'));
                            echo form_password('password', '', ['class' => 'form-control', 'required' => '']);
                            echo form_label(lang('password_confirm'));
                            echo form_password('password_confirm', '', ['class' => 'form-control', 'required' => '']);
                            ?>
                        </div>

                        <div class="col-lg-6">
                            <?php echo form_label(lang('roles')); ?>
                            <?php foreach ($this->db->get('groups')->result() as $group) : ?>
                                <label class="check"><?php echo lang($group->name); ?>
                                    <?php echo form_radio('group',$group->id,set_radio('group',$group->id,true)); ?>
                                    <span class="checkmark"></span>
                                </label>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary"><?php echo lang('submit'); ?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>


<?php //$this->load->view('children/add_child'); ?>
<?php //$this->load->view('users/add_user'); ?>
</body>
</html>
