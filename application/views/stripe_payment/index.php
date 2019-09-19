<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo session('company_name'); ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo assets('img/favicon.ico'); ?>">
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/css/icons/font-awesome/css/all.min.css" rel="stylesheet"
          type="text/css"/>

    <link href="<?php echo base_url(); ?>assets/css/icons/font-awesome/css/all.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/css/user_register/payment.css" type="text/css" rel="stylesheet">
    <style>
        body {
            position: relative;
        }

        .loading_div {
            display: none;
            position: fixed;
            background: #fff url('../assets/img/loader.gif') no-repeat 50%;
            opacity: .5;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            height: 100%;
        }

        .btn_div {
            margin-left: 20%;
        }

        .fas {
            color: #EB6C6A;
        }

    </style>
</head>

<body>
<div class="loading_div"></div>
<div class="container">
    <div class="row pt-5">
        <div class="offset-4">
            <img src="../assets/img/logo.png" class="w-50 mb-3 offset-1">
            <p class="subscribe_text offset-1"><?php echo lang('Subscribe to Daycarepro Plan'); ?></p>
        </div>
        <div class="col-md-6 offset-1">
            <div class="card credit-card-box mt-3">
                <div class="card-header display-table">
                    <div class="row display-tr">
                        <div class="display-td float-right">
                            <img class="img-responsive float-right" src="../assets/img/daycare/card_img.png">
                        </div>
                    </div>
                </div>
                <form role="form" action="../stripePost/<?php echo $activation_code; ?>" method="post"
                      class="require-validation payment_form" data-cc-on-file="false"
                      data-stripe-publishable-key="<?php echo $this->config->item('stripe_key') ?>" id="payment-form">
                    <div class="card-body">

                        <?php if($this->session->flashdata('success')) { ?>
                            <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <p class="m-0"><?php echo $this->session->flashdata('success'); ?></p>
                            </div>
                        <?php } ?>
                        <?php if(!empty($this->session->flashdata('subscription_error'))) : ?>
                            <div class="alert alert-danger alert-dismissable">
                                <?php echo $this->session->flashdata('subscription_error'); ?>
                            </div>
                        <?php endif; ?>
                        <div class='form-row row'>
                            <div class='col-12 form-group required'>
                                <label class='control-label'><?php echo lang('Name on Card'); ?> *</label> <input
                                        class='form-control' size='4' type='text'>
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-12 form-group required'>
                                <label class='control-label'><?php echo lang('Card Number'); ?> *</label> <input
                                        autocomplete='off' class='form-control card-number' size='20' type='text'>
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-12 col-md-4 form-group cvc required'>
                                <label class='control-label'>CVC *</label> <input autocomplete='off'
                                                                                  class='form-control card-cvc'
                                                                                  placeholder='ex. 311' size='4'
                                                                                  type='text'>
                            </div>
                            <div class='col-12 col-md-4 form-group expiration required'>
                                <label class='control-label'><?php echo lang('Expiration Month'); ?> *</label> <input
                                        class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                            </div>
                            <div class='col-12 col-md-4 form-group expiration required'>
                                <label class='control-label'><?php echo lang('Expiration Year'); ?> *</label> <input
                                        class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-md-12 error form-group d-none'>
                                <div class='alert-danger alert ml-0'>
                                    <?php echo lang('Please correct the errors and try again.'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 offset-5 mt-3 d-none">
                        <button class="btn btn-primary btn-lg btn-block" type="submit"
                                id="form_submit"><?php echo lang('Buy Now'); ?></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-6 col-md-4 mt-3">
            <p class="text-center selected_plan"><?php echo $plan; ?><?php echo lang('Plan'); ?></p>
            <div class="plan_div ml-5 pl-5">
                <div class="row">
                    <p class="col-md-1">
                        <span><i class="fas fa-child"></i></span>
                    </p>
                    <p class="col-md-10">
                        <?php echo $children; ?><?php echo lang(' Children'); ?>
                    </p>
                </div>
                <div class="row">
                    <p class="col-md-1">
                        <span><i class="fas fa-chalkboard-teacher"></i></span>
                    </p>
                    <p class="col-md-10">
                        <?php echo $staff_members; ?><?php echo lang(' Staff members'); ?>
                    </p>
                </div>
                <div class="row">
                    <p class="col-md-1">
                        <span><i class="fas fa-calendar"></i></span>
                    </p>
                    <p class="col-md-10">
                        <?php echo $calender_events; ?><?php echo lang(' Calender events '); ?>
                    </p>
                </div>
                <div class="row">
                    <p class="col-md-1">
                        <span><i class="fas fa-newspaper"></i></span>
                    </p>
                    <p class="col-md-10">
                        <?php echo $news_module; ?><?php echo lang(' News Module'); ?>
                    </p>
                </div>
                <div class="row">
                    <p class="col-md-1">
                        <span><i class="fas fa-home"></i></span>
                    </p>
                    <p class="col-md-10">
                        <?php echo $rooms; ?><?php echo lang(' Rooms'); ?>
                    </p>
                </div>
                <div class="row">
                    <p class="col-md-1">
                        <span><i class="fas fa-file-invoice"></i></span>
                    </p>
                    <p class="col-md-10">
                        <?php echo $invoices; ?><?php echo lang(' Invoices'); ?>
                    </p>
                </div>
                <div class="row">
                    <p class="col-md-1">
                        <span><i class="fas fa-file-upload"></i></span>
                    </p>
                    <p class="col-md-10">
                        <?php echo $files; ?><?php echo lang(' Files'); ?>
                    </p>
                </div>
            </div>
            <p class="mb-0 amount_to_pay text-center">$<?php echo $price; ?> / month</p>
        </div>
        <div class="col-3 mt-3 btn_div">
            <button class="btn btn-primary btn-lg btn-block" type="submit" id="buy_now">Buy Now</button>
        </div>
    </div>
</div>

</body>

<?php $this->load->view("registration/footer"); ?>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/user_register/stripe.js"></script>

<script type="text/javascript">
    $(function () {
        $("#buy_now").click(function () {
            $("#form_submit").click();
        });
        var $form = $(".require-validation");
        $('form.require-validation').bind('submit', function (e) {
            var $form = $(".require-validation"),
                inputSelector = ['input[type=email]', 'input[type=password]',
                    'input[type=text]', 'input[type=file]',
                    'textarea'
                ].join(', '),
                $inputs = $form.find('.required').find(inputSelector),
                $errorMessage = $form.find('div.error'),
                valid = true;
            $errorMessage.addClass('d-none');

            $('.has-error').removeClass('has-error');
            $inputs.each(function (i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('d-none');
                    e.preventDefault();
                } else {
                    $('.loading_div').show();
                }
            });

            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeResponseHandler);
            }

        });

        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('d-none')
                    .find('.alert')
                    .text(response.error.message);
                $('.loading_div').hide();
            } else {
                var token = response['id'];
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }
    });
</script>

</html>