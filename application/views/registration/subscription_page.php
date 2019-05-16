<?php $this->load->view("custom_layouts/header");  ?>
<link href="<?php echo base_url(); ?>assets/css/icons/font-awesome/css/all.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/style.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/content-box.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/skin.css">
<style>
    .pricing-table .list-group-item {
        padding-left: 35px !important;
    }

    .list-group-item {
        border: none
    }
    .pricing-name{
        z-index: 10 !important;
    }
    .circle-button:hover,.btn:not(.btn-border):hover{
        border-color: #EB6C6A !important;
        background-color: #ffffff !important;
        color: #EB6C6A;
    }
    .pricing-table .pricing-price.list-group-item{
        font-size: 60px;
    }
    .circle-button{
        border-color: #EB6C6A;
        background-color: #EB6C6A !important;
    }
    .pricing-table .pricing-price span:first-child{
        color: #5584ff;
    }
    .fas{
        color: #EB6C6A;
    }
    .pricing-table .btn{
        padding: 10px 80px;
    }
</style>
</head>

<body>
    <div class="container content">
        <div class="row">
            <div class="col-md-4">
                <form method="post" action="user/plan">
                <div class="list-group pricing-table">
                    <div class="list-group-item pricing-price">
                        <span>$</span>35<span>/mon</span>
                        <input type="hidden" value="35" name="price">
                        <input type="hidden" value="basic" name="plan">
                    </div>
                    <div class="list-group-item pricing-name">
                        <h3><?php echo lang('Basic plan') ?></h3>
                    </div>
                    <div class="list-group-item">
                        <p class="row">
                            <span class="col-1"><i class="fas fa-child"></i></span>
                            <span class="col-10"><?php echo lang('10 Children'); ?></span>
                        </p>
                    </div>
                    <div class="list-group-item">
                        <p class="row">
                            <span class="col-1"><i class="fas fa-chalkboard-teacher"></i></span>
                            <span class="col-10"><?php echo lang('5 Staff members'); ?></span>
                        </p>
                    </div>
                    <div class="list-group-item">
                        <p class="row">
                            <span class="col-1"><i class="fas fa-calendar"></i></span>
                            <span class="col-10"><?php echo  lang('20 Calender events'); ?></span>
                        </p>
                    </div>
                    <div class="list-group-item">
                        <p class="row">
                            <span class="col-1"><i class="fas fa-newspaper"></i></span>
                            <span class="col-10"><?php echo  lang('No News Module'); ?></span>
                        </p>
                    </div>
                    <div class="list-group-item">
                        <p class="row">
                            <span class="col-1"><i class="fas fa-home"></i></span>
                            <span class="col-10"><?php echo  lang('No Rooms'); ?></span>
                        </p>
                    </div>
                    <div class="list-group-item">
                        <p class="row">
                            <span class="col-1"><i class="fas fa-file-invoice"></i></span>
                            <span class="col-10"><?php echo  lang('30 Invoices'); ?></span>
                        </p>
                    </div>
                    <div class="list-group-item">
                        <p class="row">
                            <span class="col-1"><i class="fas fa-file-upload"></i></span>
                            <span class="col-10"><?php echo  lang('No Files'); ?></span>
                        </p>
                    </div>
                    <div class="list-group-item pricing-btn text-center">
                        <input type="submit" class="btn btn-sm circle-button" value="Order now">
                    </div>
                </div>
                </form>
            </div>
            <div class="col-md-4">
            <form method="post" action="user/plan">
                <div class="list-group pricing-table">
                    <div class="list-group-item pricing-price">
                        <span>$</span>59.99<span>/mon</span>
                        <input type="hidden" value="59.99" name=price>
                        <input type="hidden" value="silver" name="plan">
                    </div>
                    <div class="list-group-item pricing-name">
                        <h3><?php echo lang('Silver plan') ?></h3>
                    </div>
                    <div class="list-group-item">
                        <p class="row">
                            <span class="col-1"><i class="fas fa-child"></i></span>
                            <span class="col-10"><?php echo lang('20 Children'); ?></span>
                        </p>
                    </div>
                    <div class="list-group-item">
                        <p class="row">
                            <span class="col-1"><i class="fas fa-chalkboard-teacher"></i></span>
                            <span class="col-10"><?php echo lang('10 Staff members'); ?></span>
                        </p>
                    </div>
                    <div class="list-group-item">
                        <p class="row">
                            <span class="col-1"><i class="fas fa-calendar"></i></span>
                            <span class="col-10"><?php echo  lang('50 Calender events'); ?></span>
                        </p>
                    </div>
                    <div class="list-group-item">
                        <p class="row">
                            <span class="col-1"><i class="fas fa-newspaper"></i></span>
                            <span class="col-10"><?php echo  lang('Yes News Module'); ?></span>
                        </p>
                    </div>
                    <div class="list-group-item">
                        <p class="row">
                            <span class="col-1"><i class="fas fa-home"></i></span>
                            <span class="col-10"><?php echo  lang('No Rooms'); ?></span>
                        </p>
                    </div>
                    <div class="list-group-item">
                        <p class="row">
                            <span class="col-1"><i class="fas fa-file-invoice"></i></span>
                            <span class="col-10"><?php echo  lang('100 Invoices'); ?></span>
                        </p>
                    </div>
                    <div class="list-group-item">
                        <p class="row">
                            <span class="col-1"><i class="fas fa-file-upload"></i></span>
                            <span class="col-10"><?php echo  lang('230MB Files'); ?></span>
                        </p>
                    </div>
                    <div class="list-group-item pricing-btn text-center">
                        <input type="submit" class="btn btn-sm circle-button" value="Order now">
                    </div>
                </div>
            </form>
            </div>
            <div class="col-md-4">
                <form method="post" action="user/plan">
                <div class="list-group pricing-table">
                    <div class="list-group-item pricing-price">
                        <span>$</span>120<span>/mon</span>
                        <input type="hidden" value="120" name="price">
                        <input type="hidden" value="gold" name="plan">
                    </div>
                    <div class="list-group-item pricing-name">
                        <h3><?php echo lang('Gold plan') ?></h3>
                    </div>
                    <div class="list-group-item">
                        <p class="row">
                            <span class="col-1"><i class="fas fa-child"></i></span>
                            <span class="col-10"><?php echo lang('Unlimited Children'); ?></span>
                        </p>
                    </div>
                    <div class="list-group-item">
                        <p class="row">
                            <span class="col-1"><i class="fas fa-chalkboard-teacher"></i></span>
                            <span class="col-10"><?php echo lang('Unlimited Staff members'); ?></span>
                        </p>
                    </div>
                    <div class="list-group-item">
                        <p class="row">
                            <span class="col-1"><i class="fas fa-calendar"></i></span>
                            <span class="col-10"><?php echo  lang('Unlimited Calender events'); ?></span>
                        </p>
                    </div>
                    <div class="list-group-item">
                        <p class="row">
                            <span class="col-1"><i class="fas fa-newspaper"></i></span>
                            <span class="col-10"><?php echo  lang('Yes News Module'); ?></span>
                        </p>
                    </div>
                    <div class="list-group-item">
                        <p class="row">
                            <span class="col-1"><i class="fas fa-home"></i></span>
                            <span class="col-10"><?php echo  lang('Yes Rooms'); ?></span>
                        </p>
                    </div>
                    <div class="list-group-item">
                        <p class="row">
                            <span class="col-1"><i class="fas fa-file-invoice"></i></span>
                            <span class="col-10"><?php echo  lang('Unlimited Invoices'); ?></span>
                        </p>
                    </div>
                    <div class="list-group-item">
                        <p class="row">
                            <span class="col-1"><i class="fas fa-file-upload"></i></span>
                            <span class="col-10"><?php echo  lang('2GB Files'); ?></span>
                        </p>
                    </div>
                    <div class="list-group-item pricing-btn text-center">
                        <input type="submit" class="btn btn-sm circle-button" value="Order now">
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function(){
        // alert($(".pricing-price").text());
    });
</script>