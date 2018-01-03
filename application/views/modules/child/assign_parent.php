<div class="pull-left">
    <?php echo form_open('child/'.$child_id.'/assignParent'); ?>
    <div class="input-group">
        <span class="input-group-addon"><?php echo ucwords(lang('select')); ?></span>
        <select class="form-control" name="parent">
            <option value="">--<?php echo ucwords(lang('select')); ?>--</option>
            <?php
            foreach ($this->parent->parents()->result() as $row): ?>
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
<br/>
<hr/>