<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $user->last_name; ?></h4>
            </div>
            <?php echo form_open_multipart('users/update/'.$user->id); ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <?php echo form_hidden('user_id', $user->id); ?>
                        <?php
                        echo form_label(lang('first_name'));
                        echo form_input('first_name', $user->first_name, ['class' => 'form-control', 'required' => '']);
                        echo form_label(lang('last_name'));
                        echo form_input('last_name', $user->last_name, ['class' => 'form-control', 'required' => '']);
                        echo form_label(lang('email'));
                        echo form_input('email', $user->email, ['class' => 'form-control', 'required' => '']);
                        echo form_label(lang('pin'));
                        echo form_input('pin', $user->pin, ['class' => 'form-control', 'required' => '']);
                        echo form_label(lang('address'));
                        echo form_textarea('address', $user->address, ['class' => 'form-control']);
                        echo '<hr/>';
                        echo form_label(lang('new_password'));
                        echo form_password('password', null, ['class' => 'form-control']);
                        echo form_label(lang('confirm_password'));
                        echo form_password('password_confirm', null, ['class' => 'form-control']);
                        ?>
                    </div>
                    <div class="col-lg-6">
                        <?php
                        echo form_label(lang('edit_user_groups_heading'));
                        foreach ($groups as $group) : ?>
                            <label class="checkbox">
                                <?php
                                $gID = $group['id'];
                                $checked = null;
                                $item = null;
                                $type = 'checkbox';
                                $g_name = $group['name'];
                                foreach ($currentGroups as $grp) {
                                    if($gID == $grp->id) {
                                        $checked = ' checked="checked"';
                                        break;
                                    }
                                }
                                if(in_group($this->user->uid(), 'admin') && $group['id'] == 1) {
                                    $type = 'disabled"';
                                } else {
                                    $type = 'disabled"';
                                }
                                ?>
                                <input type="radio" <?php echo $type; ?> name="groups[]"
                                       value="<?php echo $group['id']; ?>" <?php echo $checked; ?>>
                                <?php echo $g_name; ?>
                            </label>
                        <?php endforeach; ?>
                        <?php
                        if(is_file(APPPATH.'../assets/uploads/users/'.$user->photo)) {
                            echo '<img class="" style="height:200px"
                                   src="'.base_url().'assets/uploads/users/'.$user->photo.'"/>';
                        } else {
                            echo '<img class="" style="height:200px"
                                   src="'.base_url().'assets/img/content/no-image.png"/>';
                        }
                        ?>
                        <br/>
                        <input class="form-control" type="file" name="userfile" size="20"/>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('close'); ?></button>
                <button class="btn btn-primary"><?php echo lang('update'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>