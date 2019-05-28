<!DOCTYPE html>
<html>
<head>
    <title>User Status</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div>
        <?php if($first_name !== ''): ?>
           <p>Hello <?php echo $first_name . ' '. $last_name;  ?>,</p>
        <?php else: ?>
           <p>Hello <?php echo $username;  ?>,</p>
        <?php endif; ?>

        <p>
        Your acccount has been 
        <?php if($user_status == "deactivate"): ?>
           deactivated for daycarepro app.<br/>
           Ask your manager to activate it again.
        <?php else: ?>
           activated for daycarepro app.<br/>
           Visit Link: 
           <a href="<?php echo base_url(); ?><?php echo $daycare_id; ?>/login">
           <?php echo base_url(); ?><?php echo $daycare_id; ?>/login
           </a>
        <?php endif; ?>
        </p>
        Thanks!<br/>
        Team Daycarepro
        </a>
    </div>
</body>
</html>