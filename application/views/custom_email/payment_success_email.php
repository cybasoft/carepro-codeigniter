<!DOCTYPE html>
<html>
<head>
    <title>Daycare Payment</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div style="width: 93%;background: #D5F2F4 !important;height: 100%;padding: 4% 3%;font-family:Verdana">
        <div style="background-color:white;padding: 4% 3%;">
        <img src="<?php echo base_url(); ?>assets/uploads/content/logo.png" alt="Daycare logo" style="width: 200px;margin-bottom: 1%;">   
        <p style="font-size: 20px;font-weight: 600;">Hello <?php echo $user_name; ?>,</p>
        <?php if($payment_success !== ''): ?>
               <p style="font-weight: 700; font-size: 16px"><?php echo $payment_success; ?></p>
        <?php endif; ?>
        Your payment of $<?php echo $price; ?> completed successfully.<br/>
        Thank you for subscription to daycare <?php echo $plan; ?> plan!<br/><br/>
        For Daycare registration Click the button below:<br/><br/>
        <p><a href="<?php echo base_url(); ?>daycare/<?php echo $activation_code; ?>" style="background-color: #EB6C6A;color: white;text-decoration: none;padding: 11px 35px;font-weight: 600;font-size: 13px;border-radius: 21px;">Daycare Register</a><br/><br/></p>
        Thanks!<br />
        Daycarepro Team
        </a>
        </div>
    </div>
</body>
</html>