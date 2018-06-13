<?php echo form_open('child/addAllergy'); ?>
<?php echo form_hidden('child_id', $child->id); ?>
<h2><?php echo lang('allergies'); ?></h2>
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
                <div class="box box-warning box-solid">
                    <div class="box-header">
                        <h3 class="box-title">
                            <?php echo $allergy->allergy; ?>
                            &raquo;
                            <?php echo $allergy->reaction; ?>
                        </h3>
                        <?php if (!is('parent')): ?>
                            <a href="<?php echo site_url('child/deleteAllergy/' . $allergy->id); ?>"
                               class="delete pull-right">
                                <span class="fa fa-trash-alt cursor"></span>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="box-body">
                        <?php echo $allergy->notes; ?>
                    </div>
                </div>
                <?php
            }
        } else {
            echo '<h3 class="alert alert-warning">' . lang('no_known_allergies') . '</h3>';
        }
        ?>
    </div>
</div>