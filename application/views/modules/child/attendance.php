<?php $this->load->view('modules/child/nav'); ?>
<div class="row">
    <div class="col-sm-2 col-lg-2 col-md-2 table-responsive">
        <?php $this->load->view('modules/child/sidebar'); ?>
    </div>
    <div class="col-sm-10 col-lg-10 col-md-10">
        <h2><i class="fa fa-clipboard"></i> <?php echo lang('attendance_report'); ?></h2>
        <table class="table table-stripped">
            <thead>
            <tr>
                <th>#</th>
                <th><?php echo lang('date'); ?></th>
                <th><?php echo lang('time_in'); ?></th>
                <th><?php echo lang('time_out'); ?></th>
            </tr>
            </thead>
            <?php
            $cnt = 1;
            ?>
            <?php foreach ($attendance->result() as $row): ?>
                <tr>
                    <td>
                        <?php echo $cnt; ?>
                    </td>
                    <td><?php echo date('m/d/y', $row->time_in); ?></td>
                    <td><?php if ($row->time_in !== NULL) {
                            echo date('H:i:s', $row->time_in);
                        } ?></td>
                    <td>
                        <?php
                        echo($row->time_out !== NULL ? date('H:i:s', $row->time_out) : '<span class="label label-danger">' . lang('pending_pickup') . '</span>');
                        ?>
                    </td>

                </tr>
                <?php $cnt++; endforeach; ?>
        </table>

    </div>
</div>