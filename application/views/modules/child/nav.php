<div class="row no-print child-nav  <?php echo ($this->child->is_checked_in($child->id) == 1) ? 'child-checked-in' : 'child-checked-out'; ?> ">
    <div class="col-sm-3" style="font-size:22px;font-weight:bold;color: #932ab6 ;">
        <?php echo $child->last_name . ', ' . $child->first_name; ?>
    </div>
    <div class="col-sm-3">
        <?php echo lang('status'); ?>:
        <?php echo ($child->status == 1) ? lang('active') : lang('inactive'); ?>
    </div>
    <div class="col-sm-3">
        <span><?php echo lang('birthday'); ?>:</span>
        <?php echo format_date($child->bday, false) ?>
    </div>
    <div class="col-sm-3">
        <span><?php echo lang('enrolled'); ?></span>
        <?php echo format_date($child->created_at); ?>
    </div>
</div>
<hr/>