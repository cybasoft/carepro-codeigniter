<div class="modal fade" id="new-charge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only"><?php echo lang('close'); ?></span></button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('charges/add_charge/' . $this->uri->segment(3), 'class="input-group"'); ?>
                <span class="label label-default"><?php echo lang('item'); ?></span>
                <select class="form-control" name="item" required="">
                    <option value="">--<?php echo lang('select'); ?>--</option>
                    <option value="Monthly fees">Monthly Fees</option>
                    <option value="Bi-monthly fees">Bi-monthly Fees</option>
                    <option value="Meals">Meals</option>
                    <option value="Early Drop-off fee">Early drop-off fee</option>
                    <option value="Late Pickup fee">Late Pick-up free</option>
                    <option value="Other"><?php echo lang('other'); ?></option>
                </select>

                <div class="spacer"></div>

                <span class="label label-default"><?php echo lang('description'); ?></span>
                <input class="form-control" type="text" name="charge_desc" required=""/>

                <div class="spacer"></div>

                <span class="label label-default"><?php echo lang('amount'); ?></span>
                <input class="form-control" type="text" name="amount" required=""/>

                <div class="spacer"></div>

                <span class="label label-default"><?php echo lang('due'); ?></span>
                <input class="form-control" type="date" id="due_date" name="due_date" required=""/>

                <div class="spacer"></div>
                <button class="btn btn-default"><?php echo lang('submit'); ?></button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script>
    $("#due_date").mask("99/99/9999");
</script>