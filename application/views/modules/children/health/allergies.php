<?php echo form_open('health/add_allergy/'); ?>
<table class="table">
    <tr>
        <td><input class="form-control" type="text" name="allergy"
                   placeholder="<?php echo lang('new') . ' ' . lang('allergy'); ?>"/></td>
        <td><input class="form-control" type="text" name="reaction" placeholder="<?php echo lang('reaction'); ?>"/></td>
        <td>
            <button class="btn btn-default">
                <span class="glyphicon glyphicon-plus-sign"></span>
            </button>
        </td>
    </tr>
</table>
<?php echo form_close(); ?>

<hr/>
<div class="row">
    <div class="col-lg-12">
        <?php
        $this->db->where('child_id', $this->child->getID());
        $allergies = $this->db->get('child_allergy');
        if ($allergies->num_rows() > 0) {
            foreach ($allergies->result() as $allergy) {
                ?>
                <div class="alert alert-danger">
                    <span class="glyphicon glyphicon-leaf"></span>
                    <span class="label-text"><?php echo $allergy->allergy; ?></span>
                    &raquo;
                    <?php echo $allergy->reaction; ?>
                    <span class="glyphicon glyphicon-trash pull-right cursor"
                          onclick="deleteAllergy('<?php echo $allergy->id; ?>','delete_allergy');"></span>
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
    function deleteAllergy(id, path) {
        if (confirm('<?php echo lang('confirm_delete_item'); ?>')) {
            window.location.href = '<?php echo site_url(); ?>health/' + path + '/' + id;
        }
    }
</script>