<!DOCTYPE html>
<html>
<head>
    <title>Daycare Payment</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div>
        <p>Hello <?php echo $user_name; ?>,</p>
        <?php if($payment_success !== ''): ?>
               <p style="font-weight: 700; font-size: 16px"><?php echo $payment_success; ?></p>
        <?php endif; ?>
        Your payment of $<?php echo $price; ?> completed successfully.<br/>
        Thank you for subscription to daycare <?php echo $plan; ?> plan!<br/><br/>
        Daycare registration link:<br/>
        <a href="<?php echo base_url(); ?>daycare/<?php echo $activation_code; ?>"><?php echo base_url(); ?>daycare/<?php echo $activation_code; ?></a><br/><br/>
        Thanks!<br/>
        Team Daycarepro
        </a>
    </div>
</body>
</html>