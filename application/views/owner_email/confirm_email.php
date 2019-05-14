<!DOCTYPE html>
<html>
    <head>
        <title>Email Verification</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div>
           Hello <?php echo $user_name ?>, <br/><br/>
           Your email is verified.<br/> Now, you can go further for subscription plan’s payment using following link.<br/>
           Link: <a href="http://localhost/daycarepro-app/payment/<?php echo $activation_code ?>">
               http://localhost/daycarepro-app/payment/<?php echo $activation_code ?></a><br/><br/>

               Thanks!<br/>
               Team Daycarepro
            </a>          
        </div>
    </body>
</html>