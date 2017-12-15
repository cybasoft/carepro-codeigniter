<div class="pull-left">
    <?php echo form_open('children/assign'); ?>
    <div class="input-group">
        <span class="input-group-addon"><?php echo lang('select'); ?></span>

        <select class="form-control" name="parent">
            <option value="">--<?php echo lang('select'); ?>--</option>
            <?php
            foreach ($this->family->parents()->result() as $row): ?>
                <option class="form-control"
                        value="<?php echo $row->user_id; ?>"><?php echo $row->first_name . ' ' . $row->last_name; ?></option>
            <?php endforeach; ?>
        </select>
    <span class="input-group-btn">
         <button class="btn btn-primary"><?php echo lang('update'); ?></button>
    </span>
    </div>
    <?php echo form_close(); ?>
</div>