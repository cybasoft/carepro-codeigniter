<div id="parents">
    <input class="search form-control" placeholder="Search"/>
    <br/>

    <div class="list">
        <?php foreach ($users as $user): ?>
            <div class="info-box" style="border-right:solid 1px #ccc;background:#f9f9f9;padding:5px;">
                <div class="info-box-img">
                    <img class="img-circle" style="height:80px;width:80px;"
                         src="<?php echo is_file(APPPATH.'../assets/uploads/users/'.$user['photo']) ? base_url('assets/uploads/users/'.$user['photo']) : base_url('assets/img/content/no-image.png'); ?>">
                    <div class="text-center">
                        <br/>
                        <?php echo ($user['active']) ? anchor('users/deactivate/'.$user['user_id'], '<span class="label label-info">'
                            .lang('index_active_link').'</span>') : anchor('users/activate/'.$user['user_id'], '<span class="label label-danger">'
                            .lang('index_inactive_link').'</span>'); ?>
                    </div>
                </div>
                <div class="info-box-content">
                    <div class="row">
                        <div class="col-sm-4">
                            <h3 class="parent-name">
                                <?php echo $user['first_name'].' '.$user['last_name']; ?>
                            </h3>
                            <i class="fa fa-envelope"></i>
                            <?php echo $user['email']; ?><br/>
                            <i class="fa fa-phone"></i>
                            <?php echo $user['phone']; ?><br/>
                        </div>
                        <div class="col-sm-4">
                            <h4>
                                <?php echo lang('Children'); ?>
                            </h4>
                            <ul class="list-links child-name" style="display:grid">
                                <?php foreach ($user['children'] as $child): ?>
                                    <li>
                                        <?php echo anchor('child/'.$child['id'], $child['first_name'].' '.$child['last_name']); ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                    </div>
                    <hr/>
                    <div class="info-box-more">
                        <a id="<?php echo $user['user_id']; ?>" onclick="editUser('<?php echo $user['user_id']; ?>')"
                           class="cursor">
                <span class="btn btn-default btn-xs">
                    <i class="fa fa-pencil-alt"></i></span>
                        </a>
                        <?php if(!is('staff')): echo anchor('users/delete/'.$user['user_id'], '<span class="btn btn-danger btn-xs"><i class="fa fa-trash-alt"></i></span>', 'class="delete"'); endif;?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <ul class="pagination"></ul>
</div>
