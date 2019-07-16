<!DOCTYPE html>
<html>

<head>
    <title>Daycare Invitation</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div style="width: 93%;background: #D5F2F4 !important;height: 100%;padding: 4% 3%;font-family:Verdana">
        <div style="background-color:white;padding: 4% 3%;">
            <img src="<?php echo base_url(); ?>assets/uploads/content/logo.png" alt="Daycare logo" style="width: 200px;margin-bottom: 1%;">
            <p style="font-size: 20px;font-weight: 600;">Hello,</p>
            <p>This message is to notify you if your 5th login attempt to your daycarepro-app fails then your account with email <?php echo $email; ?> will be blocked for daycarepro-app.</p>
            <p style="margin-bottom: 30px;">Forgot password for <?php echo $email; ?>,then reset it from here:</p>
            <a href="<?php echo base_url(); ?>forgot" style="background-color: #EB6C6A;color: white;text-decoration: none;padding: 11px 35px;font-weight: 600;font-size: 13px;border-radius: 21px;">Reset Password</a>
            <p style="margin-top:30px">
            Thanks!<br/>
            Daycarepro Team
            </p>
            </a>
        </div>
    </div>
</body>

</html>