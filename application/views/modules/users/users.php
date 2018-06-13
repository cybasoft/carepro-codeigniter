<?php function g_decor($name)
{
    switch ($name) {
        case 'admin':
            return 'danger';
            break;
        case 'manager':
            return 'success';
            break;
        case 'staff':
            return 'primary';
            break;
        case 'parent':
            return 'default';
            break;
        default:
            return 'warning';
            break;
    }
}

?>
<div class="row">
    <div class="col-lg-12">
        <div class="callout callout-warning">
            <h4>
                <?php echo $this->user->getCount(); ?>
                <?php echo lang('users').' '.lang('found'); ?>
            </h4>
        </div>

        <table class="table table-bordered table-hover table-striped">
            <thead>
            <tr align="center">
                <th></th>
                <th class="col-lg-2 hidden-xs"><?php echo lang('name'); ?></th>
                <th class="hidden-xs"><?php echo lang('index_email_th'); ?></th>
                <th class="hidden-xs"><?php echo lang('index_groups_th'); ?></th>
                <th class="hidden-xs"><?php echo lang('index_status_th'); ?></th>
                <th><?php echo lang('index_action_th'); ?></th>
            </tr>
            </thead>
            <?php
            $start = 1;
            foreach ($users as $user):
                if(in_group($this->user->uid(), 'admin') == false && in_group($user->id, 'admin') == true):
                    continue;
                else:
                    ?>
                    <tr class="cursor" onclick="window.location.href='<?php echo site_url('user/'.$user->id); ?>'">
                        <td>
                            <div class="pull-left">
                                <?php if(is_file(APPPATH.'../assets/uploads/users/staff/'.$user->photo)): ?>
                                    <img style="height:60px;width:60px;"
                                         src="<?php echo base_url('assets/uploads/users/staff/'.$user->photo); ?>">
                                <?php else: ?>
                                    <img style="height:60px;width:60px;"
                                         src="<?php echo base_url('assets/img/content/no-image.png'); ?>">
                                <?php endif; ?>
                            </div>
                            <div class="visible-xs pull-left" style="padding-left:15px;">
                                <?php echo $user->first_name.' '.$user->last_name; ?><br/>
                                <?php echo $user->email; ?><br/>
                                <?php foreach ($user->groups as $group): ?>
                                    <?php //echo anchor("users/edit_group/" . $group->id, $group->name); ?>
                                    <span
                                            class="label label-<?php echo g_decor($group->name); ?>"><?php echo $group->name; ?></span>
                                <?php endforeach ?> |
                                <?php echo ($user->active) ? anchor("users/deactivate/".$user->id, '<span class="label label-info">'
                                    .lang('index_active_link').'</span>') : anchor("users/activate/".$user->id, '<span class="label label-danger">'
                                    .lang('index_inactive_link').'</span>'); ?>
                            </div>

                        </td>
                        <td class="hidden-xs"><?php echo $user->first_name.' '.$user->last_name; ?></td>
                        <td class="hidden-xs"><?php echo $user->email; ?></td>
                        <td class="hidden-xs">
                            <?php foreach ($user->groups as $group): ?>
                                <?php //echo anchor("users/edit_group/" . $group->id, $group->name); ?>
                                <span
                                        class="label label-<?php echo g_decor($group->name); ?>"><?php echo $group->name; ?></span>
                            <?php endforeach ?>
                        </td>
                        <td align="center" valign="top" class="hidden-xs">
                            <?php echo ($user->active) ? anchor("users/deactivate/".$user->id, '<span class="label label-info">'
                                .lang('index_active_link').'</span>') : anchor("users/activate/".$user->id, '<span class="label label-danger">'
                                .lang('index_inactive_link').'</span>'); ?>
                        </td>
                        <td>
                            <?php echo anchor("user/".$user->id, '<i class="fa fa-pencil-alt fa-2x"></i>'); ?>
                            &nbsp;
                            <?php echo anchor("user/".$user->id.'/delete', '<i class="fa fa-trash-alt fa-2x"></i>'); ?>
                        </td>
                    </tr>
                    <?php
                    $start++;
                endif;
            endforeach;
            ?>
        </table>
    </div>
</div>