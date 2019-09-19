<!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div style="width: 100%;background: #e6e3e3;height: 100%;padding: 3%;font-family:Verdana,sans-serif;margin:0 auto">
    <div style="background-color:white;max-width:680px;margin:0 auto;padding:20px;box-shadow: 7px 7px 7px #655656;border-radius: 10px">
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
        Your Daycare Team

        </div>
    </div>
</body>
</html>