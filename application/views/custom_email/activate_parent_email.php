<!DOCTYPE html>
<html>
<head>
    <title>Daycare Invitation</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div style="width: 100%;background: #e6e3e3;height: 100%;padding: 3%;font-family:Verdana,sans-serif;margin:0 auto">
    <div style="background-color:white;max-width:680px;margin:0 auto;padding:20px;box-shadow: 7px 7px 7px #655656;border-radius: 10px">
        <?php if($image == ''): ?>
            <img src="<?php echo base_url(); ?>assets/uploads/content/logo.png" alt="Daycare logo"
                 style="width: 200px;margin-bottom: 1%;">
        <?php else: ?>
            <img src="<?php echo base_url(); ?>assets/uploads/daycare_logo/<?php echo $image; ?>" alt="Daycare logo"
                 style="width: 200px;margin-bottom: 1%;">
        <?php endif; ?>
        <p style="font-size: 20px;font-weight: 600;">Hello <?php echo $user_name; ?>,</p>
        <?php echo $parent_name; ?> has requested for activation of the account.<br/>
        <p>Firstname: <?php echo $firstname; ?></p>
        <p>Lastname: <?php echo $lastname; ?></p>
        <p>Email: <?php echo $email; ?></p>
        <p>phone: <?php echo $phone; ?></p>
        Activation link: <br/>
        <p>
            <a href="<?php echo base_url(); ?>parents"
               style="background-color: #EB6C6A;color: white;text-decoration: none;padding: 11px 35px;font-weight: 600;font-size: 13px;border-radius: 21px;">Visit
                Parent Dashboard</a><br/><br/>
        </p>
        Thanks!<br/>
        Your Daycare Team

    </div>
</div>
</body>

</html>