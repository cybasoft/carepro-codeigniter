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
        <?php if($logo != '') : ?>
            <img src="<?php echo base_url(); ?>assets/uploads/daycare_logo/<?php echo $logo; ?>" alt="Daycare logo"
                 style="width: 200px;margin-bottom: 1%;">
        <?php else : ?>
            <img src="<?php echo base_url(); ?>assets/uploads/content/logo.png" alt="Daycare logo"
                 style="width: 200px;margin-bottom: 1%;">
        <?php endif; ?>
        <p style="font-size: 20px;font-weight: 600;">Hello <?php echo $name; ?>,</p>
        <p style="font-size: 15px;"><?php echo $message; ?></p>
        <p>
            Thanks!<br/>
            Your Daycare Team
        </p>

    </div>
</div>
</body>

</html>