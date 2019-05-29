<div class="card card-default">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-2 col-xs-6">
                <span class="label label-success"><?php echo array_sum($role); ?></span>
                <span class=""><?php echo lang('users'); ?></span>
            </div>
            <div class="col-sm-2 col-xs-6">
                <span class="label label-info"><?php echo isset($role['admin']) ? $role['admin'] : 0; ?></span>
                <span class=""><?php echo lang('Admin'); ?></span>
            </div>
            <div class="col-sm-2 col-xs-6">
                <span class="label label-info"><?php echo isset($role['manager']) ? $role['manager'] : 0; ?></span>
                <span class=""><?php echo lang('Manager'); ?></span>
            </div>
            <div class="col-sm-2 col-xs-6">
                <span class="label label-info"><?php echo isset($role['staff']) ? $role['staff'] : 0; ?></span>
                <span class=""><?php echo lang('Staff'); ?></span>
            </div>
            <div class="col-sm-2 col-xs-6">
                <span class="label label-info"><?php echo isset($role['parent']) ? $role['parent'] : 0; ?></span>
                <span class=""><?php echo lang('Parents'); ?></span>
            </div>
        </div>
    </div>
</div>

<div class="card card-default">
    <div class="card-body">
        <table class="table table-bordered table-hover table-striped" id="users">
            <thead>
            <tr align="center">
                <th></th>
                <th></th>
                <th><?php echo lang('Name'); ?></th>
                <th><?php echo lang('Email'); ?></th>
                <th><?php echo lang('Phone'); ?></th>
                <th><?php echo lang('Role'); ?></th>
                <th><?php echo lang('Status'); ?></th>
                <th data-orderable="false"></th>
            </tr>
            </thead>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user->id; ?></td>
                    <td>
                        <img class="img-circle" style="height:50px;width:50px;"
                             src="<?php echo $this->user->photo($user->photo); ?>">
                    </td>
                    <td><?php if($user->first_name !== ''){ echo $user->first_name.' '.$user->last_name;}else{ echo $user->name; } ?></td>
                    <td><?php echo $user->email; ?></td>
                    <td><?php echo $user->phone; ?></td>
                    <td>
                        <span class="label label-<?php echo g_decor($user->role); ?>"><?php echo $user->role; ?></span>
                    </td>
                    <td align="center" valign="top">
                        <?php echo ($user->active) ? anchor($daycare_id."/users/deactivate/".$user->id, '<span class="text-primary">'
                            .lang('index_active_link').'</span>') : anchor($daycare_id."/users/activate/".$user->id, '<span class="text-danger">'
                            .lang('index_inactive_link').'</span>'); ?>
                    </td>
                    <td style="width:75px;" class="text-right">
                        <a id="<?php echo $user->id; ?>" onclick="editUser('<?php echo $user->id; ?>','<?php echo $daycare_id ?>')" class="cursor">
                    <span class="btn btn-default btn-xs">
                        <i class="fa fa-pencil-alt"></i></span>
                        </a>
                        <?php echo anchor("users/delete/".$daycare_id.'/'.$user->id, '<span class="btn btn-danger btn-xs"><i class="fa fa-trash-alt"></i></span>', 'class="delete"'); ?>
                    </td>
                </tr>
            <?php
            endforeach;
            ?>
        </table>
    </div>
</div>