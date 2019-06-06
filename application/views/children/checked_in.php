<?php foreach ($checkedInChildren as $child): ?>
<div class="children-thumbs cursor">
    <div class="children-thumb" onclick="window.location.href='<?php echo site_url('child/' . $child->id); ?>'"
        style="background-image: url('<?php echo $this->child->photo($child->photo); ?>');">

        <span class="i-check-timer">
            <?php echo $this->children->checkinTimer($child->time_in); ?>
        </span>
        <span class="child-dob">
            <?php echo lang('DOB') . ': ' . format_date($child->bday, false); ?></span>
        <span class="child-id">ID:
            <?php echo decrypt($child->national_id); ?></span>

    </div>

    <div class="child-info">
        <a href="<?php echo site_url($daycare_id.'/child/' . $child->id); ?>">
            <?php echo $child->last_name . ', ' . $child->first_name; ?>
        </a>
    </div>

    <a id="<?php echo $child->id; ?>" href="#"
        class="btn btn-danger btn-flat btn-sm checkout-btn">
        <span class="fa fa-new-window"></span>
        <?php echo lang('check_out'); ?>
    </a>

    <div class="health-icons">
        <?php if ($child->allergy_count > 0): ?>
        <i class="fa fa-allergies text-danger i-check-icons i-check-allergy"></i>
        <?php endif;?>
        <?php if ($child->med_count > 0): ?>
        <i class="fa fa-pills text-danger i-check-icons i-check-med"></i>
        <?php endif;?>
    </div>
</div>
<?php endforeach;
