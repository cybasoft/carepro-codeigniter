<?php echo form_open('child/addProblem'); ?>
<?php echo form_hidden('child_id', $child->id); ?>
<h2><?php echo lang('problem_list'); ?></h2>
<table class="table">
    <tr>
        <td>
            <input
                    class="form-control"
                    type="text"
                    name="name"
                    placeholder="<?php echo lang('new') . ' ' . lang('problem'); ?>"/>
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
        <?php $problems = $this->db->where('child_id', $child->id)->get('child_problems'); ?>
        <?php if ($problems !==false && $problems->num_rows() > 0): ?>
            <?php foreach ($problems->result() as $problem): ?>
                <div class="box box-default box-solid">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo $problem->name; ?></h3>
                        <?php if (!is('parent')): ?>
                            <a href="<?php echo site_url('child/deleteProblem/' . $problem->id); ?>"
                               class="delete text-red pull-right">
                                <span class="fa fa-trash-o cursor"></span>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="box-body">
                        <?php echo $problem->notes; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <?php echo '<h3 class="alert alert-warning">' . lang('no_results_found') . '</h3>'; ?>
        <?php endif; ?>
    </div>
</div>