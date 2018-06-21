<table class="table table-bordered table-hover table-striped" id="users">
    <thead>
    <tr align="center">
        <th></th>
        <th class="col-lg-2 hidden-xs"><?php echo lang('name'); ?></th>
        <th class="hidden-xs"><?php echo lang('index_email_th'); ?></th>
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
            <tr>
                <td>
                    <div class="pull-left">
                        <?php if(is_file(APPPATH.'../assets/uploads/users/'.$user->photo)): ?>
                            <img class="img-circle" style="height:50px;width:50px;"
                                 src="<?php echo base_url('assets/uploads/users/'.$user->photo); ?>">
                        <?php else: ?>
                            <img class="img-circle" style="height:50px;width:50px;"
                                 src="<?php echo base_url('assets/img/content/no-image.png'); ?>">
                        <?php endif; ?>
                    </div>
                    <div class="visible-xs pull-left" style="padding-left:15px;">
                        <?php echo $user->first_name.' '.$user->last_name; ?><br/>
                        <?php echo $user->email; ?><br/>
                        <?php echo ($user->active) ? anchor("users/deactivate/".$user->id, '<span class="label label-info">'
                            .lang('index_active_link').'</span>') : anchor("users/activate/".$user->id, '<span class="label label-danger">'
                            .lang('index_inactive_link').'</span>'); ?>
                    </div>
                </td>
                <td class="hidden-xs"><?php echo $user->first_name.' '.$user->last_name; ?></td>
                <td class="hidden-xs"><?php echo $user->email; ?></td>
                <td align="center" valign="top" class="hidden-xs">
                    <?php echo ($user->active) ? anchor("users/deactivate/".$user->id, '<span class="text-primary">'
                        .lang('index_active_link').'</span>') : anchor("users/activate/".$user->id, '<span class="text-danger">'
                        .lang('index_inactive_link').'</span>'); ?>
                </td>
                <td>
                    <?php echo anchor("user/".$user->id, '<span class="btn btn-default btn-xs"><i class="fa fa-pencil-alt"></i></span>'); ?>
                    <?php echo anchor("user/".$user->id.'/delete', '<span class="btn btn-danger btn-xs"><i class="fa fa-trash-alt"></i></span>'); ?>
                </td>
            </tr>
            <?php
            $start++;
        endif;
    endforeach;
    ?>
</table>