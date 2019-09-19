<div style="width: 93%;background: #D5F2F4 !important;height: 100%;padding: 4% 3%;font-family:Verdana">
    <div style="background-color:white;padding: 4% 3%;">

<!--        <img src="--><?php //echo base_url(); ?><!--assets/uploads/daycare_logo/--><?php //echo $logo ?><!--" alt="Daycare logo" style="width: 200px;margin-bottom: 1%;">-->
        <p style="font-size: 20px;font-weight: 600;">
            Hello <?php echo $name ?>,
        </p>
        <h3>
            <?php echo sprintf(lang('email_forgot_password_heading'), $email); ?>
        </h3>
        <p style="padding-bottom: 10px;">
           <?php echo sprintf(lang('email_forgot_password_message'), $email); ?>
        </p>
        <p style="padding-bottom: 10px;">
           <a href="<?php echo base_url(); ?>auth/reset/<?php echo $forgotten_password_code ?>" style="background-color: #EB6C6A;color: white;text-decoration: none;padding: 11px 35px;font-weight: 600;font-size: 13px;border-radius: 21px;">
                <?php echo lang('email_forgot_password_link'); ?>
            </a><br/>
        </p>
        <?php echo lang('If the above link doesn\'t work, copy and paste this to your browser'); ?><br />
        <a href="<?php echo site_url('auth/reset/'.$forgotten_password_code); ?>">
           <?php echo site_url('auth/reset/' . $forgotten_password_code); ?>
        </a><br/><br/>
        Thanks!<br/>
        Your Daycare Team

    </div>
</div>