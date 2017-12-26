<div class="row no-print">
    <div class="col-sm-3" style="font-size:22px;font-weight:bold;color: #932ab6 ;">
        <?php echo $child->last_name . ', ' . $child->first_name; ?>
    </div>
    <div class="col-sm-3">

        <?php echo lang('status'); ?>:
        <?php echo ($child->status==1)? lang('active_status'): lang('inactive_status'); ?>
    </div>
    <div class="col-sm-3">
        <span><?php echo lang('birthday'); ?>:</span>
        <span class="label label-info"><?php echo format_date($child->bday,false) ?></span>
    </div>
    <div class="col-sm-3">
        <span><?php echo lang('enrolled'); ?></span>
        <span class="label label-info">
            <?php echo format_date($child->created_at); ?>
        </span>
    </div>
</div>
<hr/>