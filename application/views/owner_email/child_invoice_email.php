<!DOCTYPE html>
<html>

<head>
    <title>Email Verification</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div style="width: 93%;background: #60aff4a8;height: 100%;padding: 4% 3%;">
        <div style="background-color:white;width:90%,margin-left: 2%;">
            <div style="background:#eb6c6ab3">
                 <p style="margin:0;font-size:40px;color:#ffffff;line-height:2.5;padding:1% 2%">
                     <span>Invoice</span>
                    <img src="<?php echo base_url(); ?>assets/uploads/content/logo.png" alt="Daycare logo" style="width: 150px; height: 100px;" align="right">
                </p>            
            </div>
            <div style="padding: 4% 3%;padding-top:0;text-align:center">
                <?php if ($image === '') : ?>
                    <img src="<?php echo base_url(); ?>assets/uploads/content/logo.png" alt="Daycare logo" style="width: 150px; height: 100px">
                <?php else : ?>
                    <img src="<?php echo base_url(); ?>assets/uploads/daycare_logo/<?php echo $image; ?>" alt="Daycare logo" style="width: 150px; height: 100px">
                <?php endif; ?>
                <p style="font-size: 20px;font-weight: 600;">Hello <?php echo $parent_name; ?>,</p>
                <p>
                    You have an invoice for your child <?php echo $child_name; ?>.
                </p>
                <p>
                    <span style="border-bottom: 2px solid #EB6C6A;padding-bottom: 5px;">Date Created: 29/05/19</span><br /><br />
                    <span style="border-bottom: 2px solid #EB6C6A;padding-bottom: 5px;">Due Date: 31/05/19</span>
                </p>
                <p>
                    Please see attachment.<br />
                    You will need Adobe PDF reader to view
                </p>
                Thanks!<br />
                Daycarepro Team
            </div>
        </div>
    </div>
</body>

</html>