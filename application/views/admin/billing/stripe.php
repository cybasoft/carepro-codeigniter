<?php echo form_open('update'); ?>

    <div class="custom-control custom-switch mb-3">
        <input type="hidden" name="stripe" value="1"/>
        <input type="checkbox" class="custom-control-input" id="stripe_toggle" name="stripe_toggle"
            <?php
            if($settings->stripe_toggle == 1) {
                echo "checked";
            }
            ?>
        >
        <label class="custom-control-label" for="stripe_toggle">
            <strong>Stripe Test Mode</strong>
        </label>
    </div>
    <div class="test_stripe text-danger
                      <?php
    if($settings->stripe_toggle == 0) {
        echo "d-none";
    }
    ?>
                    ">
        <?php
        echo form_label(lang('Stripe test public key'));
        echo form_input('stripe_pk_test', $settings->stripe_pk_test, ['class' => 'form-control']);
        echo form_label(lang('Stripe test secret key'));
        echo form_password('stripe_sk_test', $settings->stripe_sk_test, ['class' => 'form-control']);
        echo "<br/>";
        ?>
    </div>
    <div class="live_stripe text-success
                    <?php
    if($settings->stripe_toggle == 1) {
        echo "d-none";
    }
    ?>
                    ">
        <?php
        echo form_label(lang('Stripe live public key'));
        echo form_input('stripe_pk_live', $settings->stripe_pk_live, ['class' => 'form-control']);
        echo form_label(lang('Stripe live secret key'));
        echo form_password('stripe_sk_live', $settings->stripe_sk_live, ['class' => 'form-control']);
        echo '<br/>';
        ?>
    </div>
<?php
echo form_label(lang('Enabled'), 'stripe_enabled');
echo form_dropdown('stripe_enabled', [
    0 => lang('No'),
    1 => lang('Yes'),
], $settings->stripe_enabled, ['class' => 'form-control']);
echo '<br/>';

echo form_button([
    'type'  => 'submit',
    'class' => 'btn btn-primary',
], lang('Update'));
echo form_close();
?>