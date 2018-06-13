<div class="row">
    <div class="col-md-7 col-lg-7">
        <h3><?php echo lang('payment_methods'); ?></h3>
        <div class="row">
            <div class="col-sm-6">
                <?php echo form_open('settings/paymentMethods'); ?>
                <div class="input-group">
                    <input type="text" name="title" class="form-control" required/>
                    <span class="input-group-btn">
                <button class="btn btn-primary">
                    <i class="fa fa-plus"></i> <?php echo lang('add'); ?>
                </button>
            </span>
                </div>
                <?php echo form_close(); ?>

                    <table class="table table-bordered">
                    <?php foreach ($payMethods as $payMethod): ?>
                        <tr>
                            <td>
                                <?php echo $payMethod->title; ?>
                            </td>
                            <td>
                                <a class="delete" href="<?php echo site_url('settings/deletePaymentMethod/' . $payMethod->id); ?>">
                                    <i class="fa fa-trash-alt text-danger"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </table>
            </div>
        </div>

        <hr/>
        <?php $this->load->view($this->module . 'company_logo'); ?>
    </div>

    <div class="col-md-5 col-lg-5">
        <?php echo lang('settings_notice'); ?>
        <hr/>
        <div class="callout callout-info">
            <h3>Thank you for supporting this project!</h3>
            <p>Your donation helps us keep working on this script and make it available at a
                very affordable price and provide free support</p>
            <form action="https://www.paypal.com/cgi-bin/webscr" target="_blank" method="post">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="hosted_button_id" value="Q3N6CNB3RRJBJ">
                <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0"
                       name="submit" alt="PayPal - The safer, easier way to pay online!">
                <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
            </form>
        </div>
    </div>
</div>