<!DOCTYPE html>
<html>
<head>
    <title>Daycare Invitation</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div>
        <p>Hello <?php echo $first_name . ' ' . $last_name; ?>,</p>
        <p>Your child <?php echo $child_first_name . ' '; ?><?php echo $child_last_name; ?>

            <?php if ($child_status == 1) : ?>
                has been registered sucessfully for Daycarepro app. <br /><br />
                Visit Daycarecarepro: <a href="<?php echo base_url(); ?><?php echo $daycare_id ?>/dashboard">
                    <?php echo base_url(); ?><?php echo $daycare_id ?>/dashboard</a>
            <?php else : ?>
                has been deactivated from daycarepro app.<br /><br />
                Ask manager to activate it again.
            <?php endif; ?>
        </p>
        Thanks!<br />
        Team Daycarepro
        </a>
    </div>
</body>
</html>