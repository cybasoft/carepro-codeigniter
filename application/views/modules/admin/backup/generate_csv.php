<?php echo form_open('reports/create_backup_file', 'class="form-group"'); ?>
<table>
    <tr>
        <td>
            <select class="form-control" name="tablename">
                <option value="">--<?php echo lang('select'); ?>--</option>
                <?php
                foreach ($tables_list as $table) {
                    echo ' <option value="' . $table . '">' . $table . '</option>';
                }
                ?>
            </select>
        </td>
        <td>
            <button class="btn btn-primary" type="submit"><?php echo lang('generate_csv'); ?></button>
        </td>

    </tr>
</table>
<?php echo form_close(); ?>

<h3><?php echo lang('table_reports'); ?></h3>
<table class="table table-bordered table-hover table-striped table-condensed">
    <thead>
    <tr>
        <th>#</th>
        <th><?php echo lang('table'); ?></th>
        <th><?php echo lang('date'); ?></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($csv_backups as $backup) { ?>
        <tr>
            <td><?php echo $backup->id; ?></td>
            <td>
                <?php echo anchor(base_url() . 'assets/backups/csv/' . $backup->backup_date . '.csv', $backup->backup_path); ?>
            </td>
            <td><?php echo date('d/m/Y', $backup->backup_date); ?></td>
            <td><span id="<?php echo $backup->id; ?>" class="fa fa-trash del_csv cursor"></span></td>
        </tr>
    <?php } ?>
    </tbody>
</table>