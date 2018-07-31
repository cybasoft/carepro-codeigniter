<script src="https://js.stripe.com/v3/"></script>
<form action="<?php echo site_url('invoice/'.$invoice[0]->id.'/stripe-pay'); ?>"
      style="border:solid 1px #CCCCCC;padding:10px"
      method="post" id="payment-form">
    <h4><?php echo lang('payment'); ?></h4>
    <p><?php echo lang('payment_due_note'); ?></p>
    <hr/>
    <div class="form-row">
        <label for="card-element"><?php echo lang('Credit or debit card'); ?></label>
        <div id="card-element"></div>
        <div id="card-errors" role="alert"></div>
    </div>
    <br/>
    <button class="btn btn-info submit-pay">
        <img src="<?php echo assets('img/content/stripe.svg'); ?>" style="width:16px;"/> <?php echo sprintf(lang('pay_with'), 'Stripe'); ?>
    </button>
</form>
<script>
    $('.submit-pay').click(function () {
        $(this).remove()
    });
    var stripe = Stripe("<?php  echo (ENVIRONMENT == 'production') ? get_option('stripe_pk_live') : $stripeKey = get_option('stripe_pk_test'); ?>");
    var elements = stripe.elements();
    var style = {
        base: {
            color: '#32325d',
            lineHeight: '18px',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };
    var card = elements.create('card', {style: style});
    card.mount('#card-element');
    card.addEventListener('change', function (event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        stripe.createToken(card).then(function (result) {
            if (result.error) {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                stripeTokenHandler(result.token);
            }
        });
    });
    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);
        // Submit the form
        form.submit();
    }
</script>