<div class="row">
    <div class="col-lg-6">
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
                <td><?php echo format_date($user->last_login); ?></td>
            </tr>
            <tr>
                <td><?php echo lang('registration_date'); ?></td>
                <td><?php echo format_date($user->created_at); ?></td>
            </tr>
        </table>

        <div class="box box-solid box-default">
            <div class="box-header">
                <h3 class="box-title"><?php echo lang('contact_information'); ?></h3>
            </div>
            <div class="box-body">
                <?php
                echo form_open('profile/update_user_data');
                echo form_label(lang('Phone'));
                echo form_input('phone', $user->phone, ['class' => 'form-control', 'required' => '']);

                echo form_label(lang('other_phone'));
                echo form_input('phone2', $user->phone2, ['class' => 'form-control']);

                echo form_label(lang('Address'));
                echo form_textarea('address', $user->address, ['class' => 'form-control']);

                echo '<br/>';
                echo form_button(['type' => 'submit', 'class' => 'btn btn-primary'], lang('submit'));
                echo form_close(); ?>
            </div>
        </div>

        <div class="box box-solid box-default">
            <div class="box-header">
                <h3 class="box-title"><?php echo lang('update_email'); ?></h3>
            </div>
            <div class="box-body">
                <?php
                echo form_open('profile/update_email');

                echo form_label(lang('current_password'), 'password');
                echo form_password('passowrd', null, ['class' => 'form-control', 'required' => '']);

                echo form_label(lang('email'), 'email');
                echo form_input(['type' => 'email', 'name'=>'email', 'class' => 'form-control', 'required' => ''], $user->email);

                echo '<br/>';

                echo form_button(['type' => 'submit', 'class' => 'btn btn-primary'], lang('submit'));
                echo form_close(); ?>
            </div>
        </div>
    </div>
    <div class="col-lg-6">

        <div class="box box-solid box-default">
            <div class="box-header">
                <h3 class="box-title"><?php echo lang('change_pin'); ?></h3>
            </div>
            <div class="box-body">
                <?php
                echo form_open('profile/change_pin');
                echo form_label(lang('Pin'), 'pin');
                echo form_input('pin', $user->pin, ['class' => 'form-control', 'required' => '']);
                echo '<br/>';
                echo form_button(['type' => 'submit', 'class' => 'btn btn-primary'], lang('submit'));
                echo form_close();
                ?>
            </div>
        </div>

        <div class="box box-solid box-danger">
            <div class="box-header">
                <h3 class="box-title"><?php echo lang('change_password'); ?></h3>
            </div>
            <div class="box-body">
                <?php
                echo form_open('profile/change_password');

                echo form_label(lang('current_password'), 'password');
                echo form_password('password', null, ['class' => 'form-control', 'required' => '']);

                echo form_label(lang('new_password'), 'new_password');
                echo form_password('new_password', null, ['class' => 'form-control', 'required' => '']);

                echo form_label(lang('confirm_password'), 'new_password_confirm');
                echo form_password('new_password_confirm', null, ['class' => 'form-control', 'required' => '']);

                echo '<br/>';

                echo form_button(['type' => 'submit', 'class' => 'btn btn-danger'], lang('submit'));
                echo form_close(); ?>
            </div>
        </div>
    </div>
</div>