<h2><i class="fa fa-clipboard"></i> <?php echo lang('attendance_report'); ?></h2>
<table class="table table-stripped" id="attendances">
    <thead>
    <tr>
        <th>#</th>
        <th><?php echo lang('date_in'); ?></th>
        <th><?php echo lang('dropped_off_by'); ?></th>
        <th><?php echo lang('date_out'); ?></th>
        <th><?php echo lang('picked_up_by'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php
    $cnt = 1;
    ?>
    <?php foreach ($attendance->result() as $row): ?>
        <tr>
            <td>
                <?php echo $cnt; ?>
            </td>
            <td><?php echo format_date($row->time_in); ?></td>
            <td>
                <?php echo $row->in_guardian; ?>
            </td>
            <td>
                <?php if($row->time_out !== NULL) {
                    echo format_date($row->time_out, true);
                } ?>
            </td>
            <td>
                <?php if($row->out_guardian == null): ?>
                    <span class="label label-danger"><?php echo lang('pending_pickup'); ?></span>
                <?php else: ?>
                    <?php echo $row->out_guardian; ?>
                <?php endif; ?>
            </td>

        </tr>
        <?php $cnt++; endforeach; ?>
    </tbody>
</table>