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
                <img src="<?php echo base_url(); ?>assets/uploads/content/logo.png" alt="Daycare logo" style="width: 200px;">
                <p style="font-size: 20px;font-weight: 600;">Hello <?php echo $user_name ?>,</p>
                <h2 style="color: #03a9f4;margin-bottom:5px;"> Welcome to Daycarepro app</h2>
                Visit your dashboard from here: <br />
                <p style="margin-top:28px;"><a href="<?php echo base_url(); ?><?php echo $daycare_id ?>/login" style="background-color: #EB6C6A;color: white;text-decoration: none;padding: 11px 35px;font-weight: 600;font-size: 13px;border-radius: 21px;">Visit Dashboard</a><br /><br /></p>

                <p>Features of Daycare:</p>
                <p>
                <span>1. Invite admin, staff and parent</span><br/>
                <span>2. Customise your rooms and invoices</span><br/>
                <span>3. Stay update about upcoming events.</span>
                </p>
                Thanks!<br />
                Daycarepro Team
            </div>
            </a>
        </div>
    </div>
</body>

</html>