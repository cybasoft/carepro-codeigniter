<h2><?php echo lang('problem_list'); ?>

    <?php if(!is('parent')): ?>
        <button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal"
                data-target="#newProblemModal">
            <i class="fa fa-plus-circle"></i> <?php echo lang('Add new'); ?>
        </button>
    <?php endif; ?>

</h2>
<hr/>
<div class="row">
    <div class="col-lg-12">
        <?php $problems = $this->db->where('child_id', $child->id)->get('child_problems'); ?>
        <?php if($problems !== false && $problems->num_rows() > 0): ?>
            <table class="table table-responsive table-striped" id="datatable">
                <thead>
                <tr>
                    <th><?php echo lang('Problem name'); ?></th>
                    <th><?php echo lang('Date first occurred'); ?></th>
                    <th><?php echo lang('Date last occurred'); ?></th>
                    <th><?php echo lang('Notes'); ?></th>
                    <?php if(!is('parent')): ?>
                        <th></th>
                    <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($problems->result() as $problem): ?>
                    <tr>
                        <td><?php echo $problem->name; ?></td>
                        <td><?php echo format_date($problem->first_event, false); ?></td>
                        <td><?php echo format_date($problem->last_event, false); ?></td>
                        <td><?php echo $problem->notes; ?></td>
                        <?php if(!is('parent')): ?>
                            <td>
                                <a href="<?php echo site_url('child/deleteProblem/'.$problem->id); ?>"
                                   class="delete text-red pull-right">
                                    <span class="fa fa-trash-alt cursor"></span>
                                </a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="callout callout-warning"><?php echo lang('no_results_found'); ?></div>
        <?php endif; ?>
    </div>
</div>


<div class="modal fade" id="newProblemModal" tabindex="-1" role="dialog" aria-labelledby="newProblemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="newProblemModalLabel"><?php echo lang('Add a problem'); ?></h4>
            </div>
            <?php echo form_open('child/addProblem'); ?>
            <?php echo form_hidden('child_id', $child->id); ?>
            <div class="modal-body">
                <?php echo form_label(lang('Problem name'));
                echo form_input('name', '', ['class' => 'form-control', 'required' => '']);
                ?>

                <?php echo form_label(lang('Notes'));
                echo form_input('notes', '', ['class' => 'form-control']);
                ?>

                <?php echo form_label(lang('Date first occurred'));
                echo form_date('first_event', '', ['class' => 'form-control', 'required' => '']);
                ?>

                <?php echo form_label(lang('Date last occurred'));
                echo form_date('last_event', '', ['class' => 'form-control']);
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('close'); ?></button>
                <button class="btn btn-primary"><?php echo lang('submit'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>