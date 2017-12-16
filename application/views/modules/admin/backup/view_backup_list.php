<?php echo anchor('reports/backup_db', lang('create_backup'), 'class="btn btn-primary"'); ?>
<div class="table-responsive">
    <h3><?php echo lang('database') . ' ' . lang('backup'); ?></h3>
    <table class="table table-bordered table-hover table-striped table-condensed">
        <thead>
        <tr>
            <th>#</th>
            <th><?php echo lang('backup'); ?></th>
            <th><?php echo lang('date'); ?></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($sql_backups as $backup) { ?>
            <tr>
                <td><?php echo $backup->id; ?></td>
                <td>
                    <?php echo anchor(base_url() . 'assets/backups/' . $backup->backup_path, $backup->backup_date); ?>
                </td>
                <td><?php echo date('d/m/Y', $backup->backup_date); ?></td>
                <td><span id="<?php echo $backup->id; ?>" class="fa fa-trash del_sql cursor"></span></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>