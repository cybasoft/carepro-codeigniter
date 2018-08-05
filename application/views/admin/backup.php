<div class="row">
    <div class="col-lg-8">
        <div class="box box-solid box-default">
            <div class="box-body">

                <div class="table-responsive">
                    <h3><?php echo lang('Database backups'); ?></h3>
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
                        <?php $count = 1;
                        foreach ($this->backup->databaseBackups() as $backup) { ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td>
                                    <?php echo anchor('admin/backup/download/'.$backup->name, $backup->name); ?>
                                </td>
                                <td><?php echo format_date($backup->created_at); ?></td>
                                <td><span id="<?php echo $backup->id; ?>"
                                          class="fa fa-trash del_sql text-danger cursor"></span></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="box box-solid box-primary">
            <div class="box-body text-center">
                <?php echo anchor('admin/backup/backup_db','<i class="fa fa-database"></i> '. lang('Create database backup'), 'class="btn btn-danger"'); ?>
                <hr/>
                <?php echo form_open('admin/backup/create_csv', 'class="form-group"'); ?>
                <table>
                    <tr>
                        <td>
                            <select class="form-control" name="tablename">
                                <option value="">--<?php echo lang('select'); ?>--</option>
                                <?php
                                foreach ($this->backup->tablesList() as $table) {
                                    echo ' <option value="'.$table.'">'.$table.'</option>';
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

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function () {
        $('.del_sql').click(function () {
            if (confirm('<?php echo lang('confirm_delete_item'); ?>')) {
                var id = $(this).attr('id');
                window.location.href = '<?php echo site_url('admin/backup/delete_backup'); ?>/' + id;
            }
        });
    });
</script>