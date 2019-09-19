<!DOCTYPE html>
<html>

<head>
    <title>Daycare Notice</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<div style="width: 100%;background: #e6e3e3;height: 100%;padding: 3%;font-family:Verdana,sans-serif;margin:0 auto">
    <div style="background-color:white;max-width:680px;margin:0 auto;padding:20px;box-shadow: 7px 7px 7px #655656;border-radius: 10px">
            <img src="<?php echo base_url(); ?>assets/uploads/content/logo.png" alt="Daycare logo" style="width: 200px;margin-bottom: 1%;">
            <p style="font-size: 20px;font-weight: 600;">Hello,</p>
            <p>This message is to notify you if your 5th login attempt to your daycarepro-app fails then your account with email <?php echo $email; ?> will be blocked for daycarepro-app.</p>
            <p style="margin-bottom: 30px;">Forgot password for <?php echo $email; ?>,then reset it from here:</p>
            <a href="<?php echo base_url(); ?>forgot" style="background-color: #EB6C6A;color: white;text-decoration: none;padding: 11px 35px;font-weight: 600;font-size: 13px;border-radius: 21px;">Reset Password</a>
            <p style="margin-top:30px">
            Thanks!<br/>

            Your Daycare Team
            </p>
            </a>
        </div>
    </div>
</body>

</html>