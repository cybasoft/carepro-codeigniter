<!DOCTYPE html>
<html>
    <head>
        <title>Email Verification</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div>
           Hello <?php echo $user_name; ?>, <br/><br/>
           <?php echo $parent_name; ?> has requested for activation of the account.<br/>
            <p>Firstname: <?php echo $firstname; ?></p>
            <p>Lastname: <?php echo $lastname; ?></p>
            <p>Email: <?php echo $email; ?></p>
            <p>phone: <?php echo $phone; ?></p>

            Activation link: <a href="<?php echo base_url(); ?><?php echo $daycare_id ?>/parents"><?php echo base_url(); ?><?php echo $daycare_id ?>/parents</a><br/><br/>

               Thanks!<br/>
               Team Daycarepro
            </a>     
        </div>
    </body>
</html>