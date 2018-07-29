<?php $this->load->view('modules/child/nav'); ?>
<div class="row">
    <div class="col-sm-2 col-lg-2 col-md-2 table-responsive">
        <?php $this->load->view('modules/child/sidebar'); ?>
    </div>
    <div class="col-sm-10 col-lg-10 col-md-10" style="font-family: courier, monospace">
        <h2><i class="fa fa-money"></i> <?php echo lang('new_invoice'); ?></h2>
        <hr/>

        <?php echo form_open('child/'.$child->id.'/createInvoice', 'id="myForm"'); ?>
        <label class="label label-default"><?php echo lang('date'); ?></label>
        <div class="form-group input-group date col-lg-4 col-md-4 col-sm-4">
            <input class="form-control" size="16" type="text" name="invoice_date" value="<?php echo date('Y-m-d'); ?>"
                   readonly required=""/>
            <span class="input-group-addon add-on">
                <i class="fa fa-calendar" style="display: inline"></i>
            </span>
        </div>
        <label class="label label-default"><?php echo lang('due'); ?> </label>
        <div class="form-group input-group date col-lg-4 col-md-4 col-sm-4">
            <input class="form-control" value="<?php echo date('Y-m-d',strtotime(date('Y-m-d'). ' + 15 days')); ?>" size="16" type="date" name="date_due" required=""/>
            <span class="input-group-addon add-on">
                <i class="fa fa-calendar" style="display: inline"></i>
            </span>
        </div>
        <hr/>

        <table class="table table-bordered" id="invoice-form">
            <thead>
            <tr>
                <th><?php echo lang('item_name'); ?></th>
                <th><?php echo lang('description'); ?></th>
                <th><?php echo lang('item_price'); ?></th>
                <th><?php echo lang('item_quantity'); ?></th>
                <th><?php echo lang('total'); ?></th>
            </tr>
            </thead>
            <tbody>
            <tr class="invoice-item">
                <td>
                    <input type="text" name="item_name" id="itemName" class="form-control input-sm"/>
                </td>
                <td>
                    <input type="text" class="form-control" name="description"/>
                </td>
                <td>
                    <input type="text" class="form-control input-sm price" name="price"/>
                </td>
                <td>
                    <input type="text" value="1" class="form-control input-sm qty" name="qty"/>
                </td>
                <td>
                    <input type="text" class="form-control input-sm item-total" value="0.00" readonly
                           name="itemLineTotal"/>
                </td>
            </tr>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3" rowspan="3" class="text-right">
                    <label><?php echo lang('invoice_terms'); ?></label>
                    <textarea name="invoice_terms" rows="4" class="form-control"><?php echo get_option('invoice_terms'); ?></textarea>
                </td>
                <td class="text-right"><?php echo lang('sub_total'); ?>:</td>
                <td>
                    <input type="text" readonly value="0.00" class="subTotal"/>
                </td>
            </tr>
            <tr style="display: none;">
                <td class="text-right"><?php echo lang('tax'); ?>:</td>
                <td><input type="hidden" class="tax" name="tax" value="0"/></td>
            </tr>
            <tr>
                <td class="text-right"><?php echo lang('total'); ?>:</td>
                <td><input type="text" readonly value="0.00" class="finalTotal"/></td>
            </tr>
            </tfoot>
        </table>
        <div class="text-right">
            <?php echo lang('invoice_save_text'); ?>
            <button class="btn btn-primary">
                <?php echo lang('save'); ?>
            </button>
        </div>

    </div>
</div>
<?php echo form_close(); ?>

<div class="load"></div>
<script type="text/javascript">
    function doTotal(price, qty) {
        return parseFloat(price) * parseFloat(qty);
    }

    function calcTotal(total) {
        var subTotal = $('.subTotal');
        var finalTotal = $('.finalTotal');
        var tax = $('.tax').val();
        var subPrice = 0.00;
        $(document).find('.item-total').each(function () {
            subPrice = parseFloat($(this).val()) + parseFloat(subPrice);
        });
        subTotal.val(subPrice);
        if (tax === "0") {
            finalTotal.val(subPrice);
        } else {
            tax = Number(tax) / 100;
            finalTotal.val(subPrice + (subPrice * tax));
        }
    }

    $(document).ready(function () {
        $('.qty').keyup(function () {
            var qty = $(this).val();
            var price = $(this).closest('.invoice-item').find('.price').val();
            var total = doTotal(price, qty);
            $(this).closest('.invoice-item').find('.item-total').val(total);
            calcTotal();
        });
        $('.tax').keyup(function () {
            calcTotal();
        });
        $('.price').keyup(function () {
            var qty = $(this).val();
            var price = $(this).closest('.invoice-item').find('.qty').val();
            var total = doTotal(price, qty);
            $(this).closest('.invoice-item').find('.item-total').val(total);
            calcTotal();
        });
    });
</script>