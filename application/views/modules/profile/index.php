<div class="row">
    <div class="col-lg-6">
        <div class="box box-solid box-warning">
            <div class="box-header">
                <h3 class="box-title"><?php echo lang('user_data'); ?></h3>
            </div>
            <div class="box-body">
                <table class="table">
                    <tr>
                        <td><?php echo lang('first_name'); ?></td>
                        <td><?php echo $user->first_name; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo lang('last_name'); ?></td>
                        <td><?php echo $user->last_name; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo lang('last_login'); ?></td>
                        <td><?php echo date('d M y H:i:s', $user->last_login); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo lang('registration_date'); ?></td>
                        <td><?php echo date('d M y', $user->created_on); ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="box box-solid box-warning">
            <div class="box-header">
                <h3 class="box-title"><?php echo lang('change_pin'); ?></h3>
            </div>
            <div class="box-body">
                <?php echo form_open('profile/change_pin'); ?>
                <table class="table no-border">
                    <tr>
                        <td><?php echo lang('pin'); ?></td>
                        <td><input type="text" name="pin" value="<?php echo $user->pin; ?>"
                                   class="form-control" required=""/></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-right">
                            <button class="btn btn-warning"><?php echo lang('submit'); ?></button>
                        </td>
                    </tr>
                </table>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="box box-solid box-info">
            <div class="box-header">
                <h3 class="box-title"><?php echo lang('contact_information'); ?></h3>
            </div>
            <div class="box-body">
                <?php echo form_open('profile/update_user_data'); ?>
                <table class="table no-border">
                    <tr>
                        <td><?php echo lang('phone'); ?></td>
                        <td><input type="text" name="phone" value="<?php echo $user->phone; ?>"
                                   class="form-control" required=""/></td>
                    </tr>
                    <tr>
                        <td><?php echo lang('other_phone'); ?></td>
                        <td><input type="text" name="phone2" value="<?php echo $user->phone2; ?>"
                                   class="form-control"/></td>
                    </tr>
                    <tr>
                        <td><?php echo lang('address'); ?></td>
                        <td><input type="text" required name="country" value="<?php echo $user->address; ?>"
                                   class="form-control"/>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-right">
                            <button class="btn btn-info"><?php echo lang('submit'); ?></button>
                        </td>
                    </tr>
                </table>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="box box-solid box-primary">
            <div class="box-header">
                <h3 class="box-title"><?php echo lang('update_email'); ?></h3>
            </div>
            <div class="box-body">
                <?php echo form_open('profile/update_email'); ?>
                <table class="table no-border">
                    <tr>
                        <td><?php echo lang('current_password'); ?></td>
                        <td><input type="password" name="password" class="form-control" required=""/></td>
                    </tr>
                    <tr>
                        <td><?php echo lang('email'); ?></td>
                        <td><input type="text" name="email" value="<?php echo $user->email; ?>" class="form-control"
                                   required=""/></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-right">
                            <button class="btn btn-primary"><?php echo lang('submit'); ?></button>
                        </td>
                    </tr>
                </table>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="box box-solid box-danger">
            <div class="box-header">
                <h3 class="box-title"><?php echo lang('change_password'); ?></h3>
            </div>
            <div class="box-body">
                <?php echo form_open('profile/change_password'); ?>
                <table class="table no-border">
                    <tr>
                        <td><?php echo lang('current_password'); ?></td>
                        <td><input type="password" name="password" class="form-control" required=""/></td>
                    </tr>
                    <tr>
                        <td><?php echo lang('new_password'); ?></td>
                        <td><input type="password" name="new_password" value="" class="form-control" required=""/></td>
                    </tr>
                    <tr>
                        <td><?php echo lang('confirm_password'); ?></td>
                        <td><input type="password" name="new_password_confirm" value="" class="form-control"
                                   required=""/></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-right">
                            <button class="btn btn-danger"><?php echo lang('submit'); ?></button>
                        </td>
                    </tr>
                </table>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>