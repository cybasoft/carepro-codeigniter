<!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div style="width: 93%;background: #D5F2F4 !important;height: 100%;padding: 4% 3%;">
        <div style="background-color:white;padding: 4% 3%;">
        <img src="<?php echo base_url(); ?>assets/uploads/content/logo.png" alt="Daycare logo" style="width: 200px;margin-bottom: 1%;">   
        <h2 style="color: #03a9f4;">Verify Your Email Address</h2>
        <p style="font-size: 20px;font-weight: 600;">Hello <?php echo $user_name ?>,</p>
        <?php if ($registered_success !== '') : ?>
                        <p style="font-weight: 700; font-size: 16px"><?php echo $registered_success; ?></p>
        <?php endif; ?>
        <p style="margin-bottom: 30px;">          
            Please confirm your email.<br>
            To confirm your email, click the button below and go further for subscription plan’s payment.<br />
        </p>
        <p><a href="<?php echo base_url(); ?>payment/<?php echo $activation_code ?>" style="background-color: #EB6C6A;color: white;text-decoration: none;padding: 11px 35px;font-weight: 600;font-size: 13px;border-radius: 21px;">Verify Your Email</a><br /><br /></p>
        Thanks!<br />
        Daycarepro Team
        </a>
        </div>
    </div>
</body>
</html>