<?php echo form_open('child/addAllergy'); ?>
<?php echo form_hidden('child_id',$child->id); ?>
<table class="table">
    <tr>
        <td>
            <input
                    class="form-control"
                    type="text"
                    name="allergy"
                    placeholder="<?php echo lang('new') . ' ' . lang('allergy'); ?>"/>
        </td>
        <td>
            <input
                    class="form-control"
                    type="text"
                    name="reaction"
                    placeholder="<?php echo lang('reaction'); ?>"/>
        </td>
        <td>
            <input
                    class="form-control"
                    type="text"
                    name="notes"
                    placeholder="<?php echo lang('notes'); ?>"/>
        </td>
        <td>
            <button class="btn btn-default">
                <span class="fa fa-plus"></span>
            </button>
        </td>
    </tr>
</table>
<?php echo form_close(); ?>
<hr/>
<div class="row">
    <div class="col-lg-12">
        <?php
        $allergies = $this->db->where('child_id', $child->id)->get('child_allergy');
        if ($allergies->num_rows() > 0) {
            foreach ($allergies->result() as $allergy) {
                ?>
                <div class="alert alert-warning">
                    <span class="fa fa-leaf"></span>
                    <span class="label-text"><?php echo $allergy->allergy; ?></span>
                    &raquo;
                    <?php echo $allergy->reaction; ?>
                    <br/>
                    <span class="text-olive">
                    <strong><?php echo lang('notes'); ?>:</strong> <?php echo $allergy->notes; ?></span>
                    <span class="fa fa-trash-o cursor"
                          onclick="deleteAllergy('<?php echo $allergy->id; ?>');"></span>
                </div>
                <?php
            }
        } else {
            echo '<h3 class="alert alert-warning">' . lang('no_known_allergies') . '</h3>';
        }
        ?>
    </div>
</div>
<script type="text/javascript">
    function deleteAllergy(id) {
        if (confirm('<?php echo lang('confirm_delete_item'); ?>')) {
            window.location.href = '<?php echo site_url(); ?>child/deleteAllergy/' + id;
        }
    }
</script>