<?php echo form_open('health/add_med/' . $this->child->getID()); ?>
<table class="table">
    <tr>
        <td><input class="form-control" type="text" name="med_name" placeholder="<?php echo lang('medication'); ?>"/>
        </td>
        <td><input class="form-control" type="text" name="med_notes" placeholder="<?php echo lang('notes'); ?>"/></td>
        <td>
            <button class="btn btn-default">
                <span class="glyphicon glyphicon-plus-sign"></span>
                <?php echo lang('add'); ?>
            </button>
        </td>
    </tr>
</table>
<?php echo form_close(); ?>

<div class="row">
    <div class="col-lg-12">
        <?php
        $this->db->where('child_id', $this->child->getID());
        $meds = $this->db->get('child_meds');
        if ($meds->num_rows() > 0) {
            foreach ($meds->result() as $med) {
                ?>
                <div class="alert alert-danger">
                    <div class="glyphicon glyphicon-heart-empty"></div>
                    <span class="label-text"><?php echo $med->med_name; ?></span>
                    <?php echo $med->med_notes; ?>
                    <span class="glyphicon glyphicon-trash pull-right cursor"
                          onclick="deleteMed('<?php echo $med->id; ?>');"></span>
                </div>
            <?php
            }
        } else {
            echo '<h3 class="alert alert-warning">' . lang('nothing_to_display') . '</h3>';
        }
        ?>
    </div>
</div>

<script type="text/javascript">
    function deleteMed(id) {
        if (confirm('<?php echo lang('confirm_delete_item'); ?>')) {
            window.location.href = '<?php echo site_url(); ?>health/delete_med/' + id;
        }
    }
</script>