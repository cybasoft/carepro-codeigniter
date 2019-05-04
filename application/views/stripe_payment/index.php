<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title><?php echo session('company_name'); ?></title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo assets('img/favicon.ico'); ?>">
    <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .panel-title {
            display: inline;
            font-weight: 100;
            color: #0e1a35;
        }

        .display-table {
            display: table;
        }

        .display-tr {
            display: table-row;
        }

        .display-td {
            display: table-cell;
            vertical-align: middle;
            width: 61%;
        }

        .has-error,
        .has-error .control-label {
            color: #a94442;
        }

        .has-error .form-control {
            border-color: #a94442;
        }

        label {
            display: inline-block;
            max-width: 100%;
            margin-bottom: 5px;
            font-weight: 100;
            color: #8492af;
        }

        .form-control {
            background-color: #f4f9fe !important;
            display: block;
            width: 100%;
            height: 34px;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
            background-color: #fff;
            background-image: none;
            border: 0px solid #ffffff;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0);
            -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        }
        .form-control:focus{
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,0);
        }
        .card{
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.13) !important;
        }
        .card-header{
            background-color: rgb(255, 255, 255);
            border-bottom: 0;
        }
        .btn-primary, .btn-primary:hover{
            background-color: #5584ff;
            border-color: #5584ff;
        }
        .btn-primary{
            box-shadow: 0 0 0 0.2rem #5584ff !important;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row pt-5">
            <div class="col-md-6 offset-md-3 pt-5 mt-5">
                <div class="card credit-card-box">
                    <div class="card-header display-table">
                        <div class="row display-tr">
                            <h3 class="panel-title display-td">Payment Details</h3>
                            <div class="display-td">
                                <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <?php if ($this->session->flashdata('success')) { ?>
                            <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <p class="m-0"><?php echo $this->session->flashdata('success'); ?></p>
                            </div>
                        <?php } ?>

                        <form role="form" action="stripePost" method="post" 
                        class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="<?php echo $this->config->item('stripe_key') ?>" id="payment-form">

                            <div class='form-row row'>
                                <div class='col-12 form-group required'>
                                    <label class='control-label'>Name on Card</label> <input class='form-control' size='4' type='text'>
                                </div>
                            </div>

                            <div class='form-row row'>
                                <div class='col-12 form-group required'>
                                    <label class='control-label'>Card Number</label> <input autocomplete='off' class='form-control card-number' size='20' type='text'>
                                </div>
                            </div>

                            <div class='form-row row'>
                                <div class='col-12 col-md-4 form-group cvc required'>
                                    <label class='control-label'>CVC</label> <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                                </div>
                                <div class='col-12 col-md-4 form-group expiration required'>
                                    <label class='control-label'>Expiration Month</label> <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                                </div>
                                <div class='col-12 col-md-4 form-group expiration required'>
                                    <label class='control-label'>Expiration Year</label> <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                                </div>
                            </div>

                            <div class='form-row row'>
                                <div class='col-md-12 error form-group d-none'>
                                    <div class='alert-danger alert'>Please correct the errors and try
                                        again.</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now ($100)</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
    $(function() {
        var $form = $(".require-validation");
        $('form.require-validation').bind('submit', function(e) {
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
            $inputs.each(function(i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('d-none');
                    e.preventDefault();
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
            console.log(status);
            if (response.error) {
                $('.error')
                    .removeClass('d-none')
                    .find('.alert')
                    .text(response.error.message);
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