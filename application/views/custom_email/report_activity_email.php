<!DOCTYPE html>
<html>
<head>
    <title>Daycare Invitation</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div style="width: 93%;background: #D5F2F4 !important;height: 100%;padding: 4% 3%;font-family:Verdana;text-align:center">
        <div style="background-color:white;padding: 4% 3%;">
            <?php if ($logo != '') : ?>
                <img src="<?php echo base_url(); ?>assets/uploads/daycare_logo/<?php echo $logo; ?>" alt="Daycare logo" style="width: 200px;margin-bottom: 1%;">
            <?php else : ?>
                <img src="<?php echo base_url(); ?>assets/uploads/content/logo.png" alt="Daycare logo" style="width: 200px;margin-bottom: 1%;">
            <?php endif; ?>
            <p style="font-size: 20px;font-weight: 600;">Hello <?php echo $name; ?>,</p>
            <p style="font-size: 15px;"><?php echo  $message; ?></p>
            <p>
                Thanks!<br />
                Daycarepro Team
            </p>
            </a>
        </div>
    </div>
</body>

</html>