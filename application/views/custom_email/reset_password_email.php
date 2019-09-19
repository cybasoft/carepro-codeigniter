<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div style="width: 100%;background: #e6e3e3;height: 100%;padding: 3%;font-family:Verdana,sans-serif;margin:0 auto">
    <div style="background-color:white;max-width:680px;margin:0 auto;padding:20px;box-shadow: 7px 7px 7px #655656;border-radius: 10px">
        <img src="<?php echo base_url(); ?>assets/uploads/content/logo.png" alt="Daycare logo"
             style="width: 200px;margin-bottom: 1%;">
        <p style="font-size: 20px;font-weight: 600;">
            Hello
            <?php if($firstname !== ''): ?>
                <?php echo $firstname.' '.$lastname; ?>,
            <?php elseif($user_name !== ''): ?>
                <?php echo $user_name; ?>
            <?php endif; ?>
        </p>
        <p>Password Reset completed successfully.</p>

        <p><a href="<?php echo base_url(); ?>/login"
              style="background-color: #EB6C6A;color: white;text-decoration: none;padding: 11px 35px;font-weight: 600;font-size: 13px;border-radius: 21px;">
                Visit Daycare</a><br/><br/></p>
        Thanks!<br/>
        Your Daycare Team

    </div>
</div>
</body>
</html>