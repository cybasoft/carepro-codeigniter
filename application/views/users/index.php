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
<br/>

<table class="table table-bordered table-hover table-striped" id="users">
    <thead>
    <tr align="center">
        <th></th>
        <th class="col-lg-2 hidden-xs"><?php echo lang('Name'); ?></th>
        <th class="hidden-xs"><?php echo lang('Email'); ?></th>
        <th class="hidden-xs"><?php echo lang('Phone'); ?></th>
        <th class="hidden-xs"><?php echo lang('Role'); ?></th>
        <th class="hidden-xs"><?php echo lang('Status'); ?></th>
        <th data-orderable="false"></th>
    </tr>
    </thead>
    <?php foreach ($users as $user): ?>
        <tr>
            <td>
                <div class="pull-left">
                    <img class="img-circle" style="height:50px;width:50px;"
                         src="<?php echo $this->user->photo($user->photo); ?>">
                </div>
                <div class="visible-xs pull-left" style="padding-left:15px;">
                    <?php echo $user->first_name.' '.$user->last_name; ?><br/>
                    <?php echo $user->email; ?><br/>
                    <span class="label label-<?php echo g_decor($user->role); ?>"><?php echo $user->role; ?></span>
                    |
                    <?php echo ($user->active) ? anchor("users/deactivate/".$user->id, '<span class="label label-info">'
                        .lang('index_active_link').'</span>') : anchor("users/activate/".$user->id, '<span class="label label-danger">'
                        .lang('index_inactive_link').'</span>'); ?>
                </div>
            </td>
            <td class="hidden-xs"><?php echo $user->first_name.' '.$user->last_name; ?></td>
            <td class="hidden-xs"><?php echo $user->email; ?></td>
            <td class="hidden-xs"><?php echo $user->phone; ?></td>
            <td class="hidden-xs">
                <span class="label label-<?php echo g_decor($user->role); ?>"><?php echo $user->role; ?></span>
            </td>
            <td align="center" valign="top" class="hidden-xs">
                <?php echo ($user->active) ? anchor("users/deactivate/".$user->id, '<span class="text-primary">'
                    .lang('index_active_link').'</span>') : anchor("users/activate/".$user->id, '<span class="text-danger">'
                    .lang('index_inactive_link').'</span>'); ?>
            </td>
            <td style="width:55px;">
                <a id="<?php echo $user->id; ?>" onclick="editUser('<?php echo $user->id; ?>')" class="cursor">
                    <span class="btn btn-default btn-xs">
                        <i class="fa fa-pencil-alt"></i></span>
                </a>
                <?php echo anchor("users/delete/".$user->id, '<span class="btn btn-danger btn-xs"><i class="fa fa-trash-alt"></i></span>', 'class="delete"'); ?>
            </td>
        </tr>
    <?php
    endforeach;
    ?>
</table>