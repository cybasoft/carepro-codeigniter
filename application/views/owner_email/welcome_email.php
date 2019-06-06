<!DOCTYPE html>
<html>

<head>
    <title>Email Verification</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div style="width: 93%;background-image: linear-gradient(#60AFF4, #EB6C6A);height: 100%;padding: 4% 3%;">
        <div style="background-color:white;width:90%,margin-left: 2%;">
            <div style="text-align:center;background:#60aff470">
                <img src="<?php echo base_url(); ?>assets/img/daycare/gif-img.gif" alt="Daycare logo" style="width: 200px;margin-top: 2%;"><br /><br />
            </div>
            <div style="padding: 4% 3%;text-align:center">
                <?php if ($image === '') : ?>
                <img src="<?php echo base_url(); ?>assets/uploads/content/logo.png" alt="Daycare logo" style="width: 150px; height: 100px">
                <?php else : ?>
                    <img src="<?php echo base_url(); ?>assets/uploads/daycare_logo/<?php echo $image; ?>" alt="Daycare logo" style="width: 150px; height: 100px">
                <?php endif; ?>
                <p style="font-size: 20px;font-weight: 600;">Hello <?php echo $user_name ?>,</p>
                <h2 style="color: #03a9f4;margin-bottom:5px;"> Welcome to Daycarepro app</h2>
                Visit your dashboard from here: <br />
                <p style="margin-top:28px;">
                    <a href="<?php echo base_url(); ?><?php echo $daycare_id; ?>/login" style="background-color: #EB6C6A;color: white;text-decoration: none;padding: 11px 35px;font-weight: 600;font-size: 13px;border-radius: 21px;">Visit Dashboard</a><br /><br /></p>

                <p style="font-size: 20px">Features of Daycare:</p>
                <p style="font-size: 16px;text-align:center">Invite admin, staff and parent</p>
                <p><img src="<?php echo base_url(); ?>assets/uploads/daycare_logo/1.png" alt="Daycare logo" style="width: 200px;margin-top: 1%;"></p>
                <p style="font-size: 16px;text-align:center">Customise your rooms and invoices</p>
                <p><img src="<?php echo base_url(); ?>assets/uploads/daycare_logo/2.png" alt="Daycare logo" style="width: 200px;margin-top: 1%;"></p>
                <p style="font-size: 16px;text-align:center">Stay update about upcoming events</p>
                <p><img src="<?php echo base_url(); ?>assets/uploads/daycare_logo/3.png" alt="Daycare logo" style="width: 200px;margin-top: 1%;"></p>                   
                <p>
                    Thanks!<br />
                    Daycarepro Team<br />
                    <img src="<?php echo base_url(); ?>assets/uploads/content/logo.png" alt="Daycare logo" style="width: 200px;">
                </p>
            </div>
        </div>
    </div>
</body>
</html>