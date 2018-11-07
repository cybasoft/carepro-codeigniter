<div class="card">
    <div class="card-header">
        <h4 class="card-title"></h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6">

                <?php if($id == $this->user->uid()): ?>
                    <?php echo lang('user_is_self_warning'); ?>
                <?php else: ?>
                    <div class="callout callout-info">
                        <h3><?php echo lang('deactivate_heading'); ?></h3>
                        <p><?php echo sprintf(lang('deactivate_subheading'), $this->user->get($id,'name')); ?></p>
                    </div>
                    <?php echo form_open('users/deactivate/'.$id); ?>
                    <input type="hidden" name="confirm" value="yes"/>
                    <?php echo anchor('users', lang('Cancel'), 'class="btn btn-default"'); ?>
                    <button class="btn btn-primary"><?php echo lang('Yes'); ?></button>
                    <?php echo form_close(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="card-footer">

    </div>
</div>