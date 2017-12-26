<?php echo form_open('child/addMedication'); ?>
<?php echo form_hidden('child_id', $child->id); ?>
<h2><?php echo lang('medications'); ?></h2>

<table class="table">
    <tr>
        <td><input class="form-control" type="text" name="med_name" placeholder="<?php echo lang('medication'); ?>"/>
        </td>
        <td><input class="form-control" type="text" name="med_notes" placeholder="<?php echo lang('notes'); ?>"/></td>
        <td>
            <button class="btn btn-default">
                <span class="fa fa-plus"></span>
                <?php echo lang('add'); ?>
            </button>
        </td>
    </tr>
</table>
<?php echo form_close(); ?>

<div class="row">
    <div class="col-lg-12">
        <?php
        $this->db->where('child_id', $child->id);
        $meds = $this->db->get('child_meds');
        if ($meds->num_rows() > 0) {
            foreach ($meds->result() as $med) {
                ?>
                <div class="alert alert-info">
                    <div class="fa fa-medkit"></div>
                    <span class="label-text"><?php echo $med->med_name; ?></span>
                    <?php echo $med->med_notes; ?>
                    <a href="<?php echo site_url('child/deleteMedication/' . $med->id); ?>" class="delete pull-right">
                        <span class="fa fa-trash-o cursor"></span>
                    </a>
                </div>
                <?php
            }
        } else {
            echo '<h3 class="alert alert-warning">' . lang('nothing_to_display') . '</h3>';
        }
        ?>
    </div>
</div>
