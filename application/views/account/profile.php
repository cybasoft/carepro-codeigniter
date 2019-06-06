<div class="row">
    <div class="col-lg-6">

        <div class="card">
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
        </div>
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title"><?php echo lang('contact_information'); ?></h3>
            </div>
            <div class="card-body">
                <?php
                echo form_open($daycare_id.'/profile/update_user');
                echo form_label(lang('Phone'));
                echo form_input('phone', $address['phone'], ['class' => 'form-control', 'required' => '']);

                echo form_label(lang('Address line 1'));
                echo form_input('address_line_1', $address['address_line_1'], ['class' => 'form-control']);

                echo form_label(lang('Address line 2'));
                echo form_input('address_line_2', $address['address_line_2'], ['class' => 'form-control']);

                echo form_label(lang('City'));
                echo form_input('city', $address['city'], ['class' => 'form-control']);

                echo form_label(lang('State'));
                echo form_input('state', $address['state'], ['class' => 'form-control']);
                echo form_label(lang('Country'));
                ?>
                <select id="country" class="form-control" required="" name="country" value="<?php echo set_value('country'); ?>">
                  <option value="1">United States</option>
                </select>
            <?php
                echo '<br/>';
                echo form_button(['type' => 'submit', 'class' => 'btn btn-success'], lang('submit'));
                echo form_close(); ?>
            </div>
        </div>

        <div class="card card-solid card-default">
            <div class="card-header">
                <h3 class="card-title"><?php echo lang('update_email'); ?></h3>
            </div>
            <div class="card-body">
                <?php
                echo form_open($daycare_id.'/profile/update_user_email');

                echo form_label(lang('current_password'), 'password');
                echo form_password('password', null, ['class' => 'form-control', 'required' => '']);

                echo form_label(lang('email'), 'email');
                echo form_input(['type' => 'email', 'name'=>'email', 'class' => 'form-control', 'required' => ''], $user->email);

                echo '<br/>';

                echo form_button(['type' => 'submit', 'class' => 'btn btn-success'], lang('submit'));
                echo form_close(); ?>
            </div>
        </div>
    </div>
    <div class="col-lg-6">

        <div class="card card-solid card-default">
            <div class="card-header">
                <h3 class="card-title"><?php echo lang('change_pin'); ?></h3>
            </div>
            <div class="card-body">
                <?php
                echo form_open($daycare_id.'/profile/change_user_pin');
                echo form_label(lang('Pin'), 'pin');
                echo form_input('pin', $address['zip_code'], ['class' => 'form-control', 'required' => '']);
                echo '<br/>';
                echo form_button(['type' => 'submit', 'class' => 'btn btn-success'], lang('submit'));
                echo form_close();
                ?>
            </div>
        </div>

        <!-- <div class="card card-solid card-danger">
            <div class="card-header">
                <h3 class="card-title"><?php echo lang('change_password'); ?></h3>
            </div>
            <div class="card-body">
                <?php
                echo form_open($daycare_id.'/profile/change_user_password');

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
        </div>         -->
        <div class="card card-solid card-danger">
            <div class="card-header">
                <h3 class="card-title"><?php echo lang('reset_password'); ?></h3>
            </div>
            <div class="card-body">
                <?php
                echo form_open($daycare_id.'/profile/change_reset_password');

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