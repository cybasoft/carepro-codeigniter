<div class="modal" id="medHistoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">
                    <?php echo sprintf(lang('Medication history for'), $med->child_name); ?>
                </h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only"><?php echo lang('close'); ?></span>
                </button>
            </div>
            <div class="modal-body">
                <div id="modal-content" style="width:100%">
                    <h4><?php echo $med->med_name; ?></h4>
                    <span class="text-muted"><?php echo $med->med_notes; ?></span>
                    <table class="table table-striped" id="datatable">
                        <thead>
                        <tr>
                            <th><?php echo lang('Date'); ?></th>
                            <th><?php echo lang('Time'); ?></th>
                            <th><?php echo lang('Staff'); ?></th>
                            <th><?php echo lang('Remarks'); ?></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($medHistory as $history): ?>
                            <tr>
                                <td><?php echo date('d/M/Y', strtotime($history->given_at)); ?></td>
                                <td><?php echo date('h:ia', strtotime($history->given_at)); ?></td>
                                <td><?php echo $history->name; ?></td>
                                <td><?php echo ($history->staff_only == 1) ? '<span class="label label-default">'.lang('Staff only').'</span>' : ''
                                        .$history->remarks; ?></td>
                                <td>
                                    <?php if(!is('parent')): ?>
                                    <i id="<?php echo $history->id; ?>" class="fa fa-trash deleteHistory cursor text-danger"></i>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('close'); ?></button>
            </div>
        </div>
    </div>
</div>