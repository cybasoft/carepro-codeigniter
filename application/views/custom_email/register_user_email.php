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
        <?php if($logo != ''): ?>
            <img src="<?php echo base_url(); ?>assets/uploads/daycare_logo/<?php echo $logo; ?>" alt="Daycare logo"
                 style="width: 200px;margin-bottom: 1%;">
        <?php else: ?>
            <img src="<?php echo base_url(); ?>assets/uploads/content/logo.png" alt="Daycare logo"
                 style="width: 200px;margin-bottom: 1%;">
        <?php endif; ?>
        <p style="font-size: 20px;font-weight: 600;">Hello <?php echo $first_name.' '.$last_name; ?>,</p>
        <?php if($staff_firstname !== "" || $name !== ""): ?>
            <p>
                <?php if($staff_firstname !== ""): ?>
                    <?php echo $staff_firstname.' '.$staff_lastname; ?>
                <?php else: ?>
                    <?php echo $name; ?>
                <?php endif; ?>
                has invited you to <?php echo $daycare_name; ?> dashboard.
            </p>
        <?php else: ?>
            <p>You have registered successfully for <?php echo $daycare_name; ?>.</p>
            <p>Your account still need to be activated.<br/>Once it is done we will notify you.</p>
        <?php endif; ?>
        <p>
            Your login credentials are:<br/>
            <span><strong>Email:</strong> <?php echo $user_name; ?></span><br/>
            <span><strong>Password:</strong> <?php echo $password; ?></span>
        </p>
        Visit <?php echo $daycare_name; ?>:
        <p><a href="<?php echo base_url(); ?>dashboard"
              style="background-color: #EB6C6A;color: white;text-decoration: none;padding: 11px 35px;font-weight: 600;font-size: 13px;border-radius: 21px;">
                Visit Dashboard</a><br/><br/>
            <span>Please change your password after first login.</span>
        </p>
        Thanks!<br/>
        Your Daycare Team

    </div>
</div>
</body>
</html>