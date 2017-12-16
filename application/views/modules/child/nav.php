<div class="row no-print">
    <div class="col-sm-3" style="font-size:22px;font-weight:bold;color: #932ab6 ;">
        <?php echo $child->lname . ', ' . $child->fname; ?>
    </div>
    <div class="col-sm-3">

        <?php echo lang('status') . ': ' . lang($this->child->status($child->status)); ?>
    </div>
    <div class="col-sm-3">
        <span><?php echo lang('birthday'); ?>:</span>
        <span class="label label-info"><?php echo date('d-M, Y', strtotime($child->bday)); ?></span>
    </div>
    <div class="col-sm-3">
        <span><?php echo lang('enrolled'); ?></span>
        <span class="label label-info">
            <?php echo $child->enroll_date !== "" ? date('d-M, Y', $child->enroll_date) : ''; ?>
        </span>
    </div>
</div>
<hr/>