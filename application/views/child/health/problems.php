<div class="card">
	<div class="card-header">
		<h4 class="card-title"><?php echo lang('problem_list'); ?>
            <?php if(!is('parent')): ?>
                <button type="button" class="btn btn-success btn-sm card-tools" data-toggle="modal"
                        data-target="#newProblemModal">
                    <i class="fa fa-plus-circle"></i> <?php echo lang('Add new'); ?>
                </button>
            <?php endif; ?>
        </h4>
	</div>
	<div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <?php $problems = $this->db->where('child_id', $child->id)->get('child_problems'); ?>
                <?php if($problems !== false && $problems->num_rows() > 0): ?>
                    <table class="table  table-striped" id="datatable">
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
    </div>
</div>

<div class="modal fade" id="newProblemModal" tabindex="-1" role="dialog" aria-labelledby="newProblemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="newProblemModalLabel"><?php echo lang('Add a problem'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span  class="sr-only"><?php echo lang('close'); ?></span>
                </button>
            </div>
            <?php echo form_open('child/addProblem'); ?>
            <?php echo form_hidden('child_id', $child->id); ?>
            <div class="modal-body">
                <?php echo form_label(lang('Problem name'),'name',['class' => 'required']);
                echo form_input('name', '', ['class' => 'form-control', 'required' => '', 'id' => 'name']);
                ?>

                <?php echo form_label(lang('Notes'), 'notes', ['class' => 'required']);
                echo form_input('notes', '', ['class' => 'form-control', 'id' => 'notes']);
                ?>

                <?php echo form_label(lang('Date first occurred'), 'first_event', ['class' => 'required']);
                echo form_date('first_event', '', ['class' => 'form-control', 'required' => '', 'id' => 'first_event']);
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