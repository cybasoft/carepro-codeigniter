<!DOCTYPE html>
<html>

<head>
    <title>Email Verification</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div>
        <p>Hello <?php echo $user_name ?>,</p>
        <?php if ($registered_success !== '') : ?>
            <p style="font-weight: 700; font-size: 16px"><?php echo $registered_success; ?></p>
        <?php endif; ?>
        Please confirm your email.<br>
        To confirm your email, click the link below and go further for subscription plan’s payment.<br />
        Link: <a href="<?php echo base_url(); ?>payment/<?php echo $activation_code ?>">
            <?php echo base_url(); ?>payment/<?php echo $activation_code ?></a><br /><br />

        Thanks!<br />
        Team Daycarepro
        </a>
    </div>
</body>
</html>