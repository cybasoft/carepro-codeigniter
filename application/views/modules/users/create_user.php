<div class="row">
    <div class="col-lg-12">
        <div class="callout callout-warning">
            <h4><?php echo lang('create_user_heading'); ?></h4>
        </div>
        <?php echo form_open("users/create"); ?>
        <div class="col-lg-6">
            <div class="box">
                <div class="box-body">
                    <table class="table">
                        <tr>
                            <td><?php echo lang('first_name'); ?></td>
                            <td><input type="text" name="first_name" class="form-control" required=""/></td>
                        </tr>
                        <tr>
                            <td><?php echo lang('last_name'); ?></td>
                            <td><input type="text" name="last_name" class="form-control" required=""/></td>
                        </tr>
                        <tr>
                            <td><?php echo lang('email'); ?></td>
                            <td><input type="email" name="email" class="form-control" required=""/></td>
                        </tr>
                        <tr>
                            <td><?php echo lang('group'); ?></td>
                            <td>
                                <?php foreach ($groups as $group) : ?>
                                    <label class="checkbox">
                                        <?php
                                        $gID = $group['id'];
                                        $g_name = $group['name'];
                                        ?>
                                        <input type="radio" name="groups[]" value="<?php echo $group['id']; ?>">
                                        <?php echo $g_name; ?>
                                    </label>
                                <?php endforeach ?>
                            </td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="box">
                <div class="box-body">
                    <table class="table">
                        <tr>
                            <td><?php echo lang('phone'); ?></td>
                            <td><input type="text" name="phone" class="form-control" required=""/></td>
                        </tr>
                        <tr>
                            <td><?php echo lang('password'); ?></td>
                            <td><input type="password" name="password" class="form-control" required=""/></td>
                        </tr>
                        <tr>
                            <td><?php echo lang('confirm_password'); ?></td>
                            <td><input type="password" name="password_confirm" class="form-control" required=""/></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <button class="btn btn-primary"><?php echo lang('submit'); ?></button>
                            </td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>