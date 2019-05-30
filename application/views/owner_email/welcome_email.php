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
        <p style="font-size: 20px;font-weight: 600;">Hello <?php echo $user_name ?>,</p>
        <h2 style="color: #03a9f4;"> Welcome to Daycarepro app</h2>
        Visit your dashboard from here: <br/>
        <p><a href="<?php echo base_url(); ?><?php echo $daycare_id ?>/login" style="background-color: #EB6C6A;color: white;text-decoration: none;padding: 11px 35px;font-weight: 600;font-size: 13px;border-radius: 21px;">Visit Dashboard</a><br/><br/></p>
        Thanks!<br />
        Daycarepro Team
        </a>
        </div>
    </div>
</body>
</html>