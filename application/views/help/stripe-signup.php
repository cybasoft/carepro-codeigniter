<span class="pull-right cursor text-danger" data-toggle="modal"
      data-target="#stripe-setup"><i class="fa fa-info-circle"></i> Help </span>

<div class="modal fade" id="stripe-setup" tabindex="-1" role="dialog"
     aria-labelledby="stripeSetupLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="stripeSetupLabel">Setting Up Stripe Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-success">
                <h4>1. Sign up for a Stripe account (<a href="https://stripe.com" target="_blank">https://stripe.com</a>)
                </h4>
                <blockquote class="text-black-50 text-monospace font-normal small">
                    Stripe is a powerful software that allows individuals and businesses to make and receive
                    payments over the Internet. Stripe provides the technical, fraud prevention, and banking
                    infrastructure required to operate online payment systems. Think of PayPal but better!

                </blockquote>

                <h4>2. Get API keys</h4>
                <div><img src="<?php echo assets('img/content/stripe-signup.png'); ?>" style="width:100%"/></div>
                <ul style="font-size:18px;" class="text-monospace font-normal">
                    <li>Under <code>API Keys (1)</code>, copy both <code>publishable and secret keys (2)</code> and
                        paste them in
                        Stripe section in billing tab of your account
                    </li>
                    <li>To test your Stripe account, toggle <code>View test data (3)</code> and copy the test API keys.
                        <ul>
                            <li>Toggle your Stripe settings to <code>Test Mode</code> and paste the keys</li>
                            <li>Go to a child's profile and click on an invoice you want to test and select
                                <code>Pay</code> in dropdown
                            </li>
                            <li>Enter credit card information to pay
                                <span class="text-black-50">
                                    <br/>Card No.: <code>4242424242424242</code>
                                <br/>Expiry: <code>07, <?php echo date('Y') + 1; ?></code>
                                <br/> CVV: <code>123</code>
                                </span>
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>