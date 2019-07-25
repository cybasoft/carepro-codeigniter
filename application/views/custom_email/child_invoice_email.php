<!DOCTYPE html>
<html>

<head>
    <title>Email Verification</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div style="width: 93%;background: #60aff4a8;height: 100%;padding: 4% 3%;font-family:Verdana">
        <div style="background-color:white;width:90%,margin-left: 2%;">
            <div style="background:#eb6c6ab3">
                 <p style="margin:0;font-size:35px;color:#ffffff;padding:1% 2%">
                     <span>Invoice</span>
                </p>            
            </div>
            <div style="padding: 4% 3%;padding-top:0;text-align:center;background-color:white">
                <!-- <?php if ($image == NULL) : ?>
                    <img src="<?php echo base_url(); ?>assets/uploads/content/<?php echo $this->session->userdata('company_invoice_logo') ?>" alt="Daycare logo" style="width: 150px; height: 100px">
                <?php else : ?>
                    <img src="<?php echo base_url(); ?>assets/uploads/invoice_logo/<?php echo $image; ?>" alt="Daycare logo" style="width: 150px; height: 100px">
                <?php endif; ?> -->
                <?php if($daycare_logo == ''): ?>
                <img src="<?php echo base_url(); ?>assets/uploads/content/logo.png" alt="Daycare logo" style="width: 200px;margin-top: 20px">
                <?php else: ?>
                <img src="<?php echo base_url(); ?>assets/uploads/daycare_logo/<?php echo $daycare_logo; ?>" alt="Daycare logo" style="width: 200px;margin-top: 20px">
                <?php endif; ?>

                <p style="font-size: 20px;font-weight: 600;">Hello <?php echo $parent_name; ?>,</p>
                <p>
                    You have an invoice for your child <?php echo $child_name; ?>.
                </p>
                <p>
                    <span style="border-bottom: 2px solid #EB6C6A;padding-bottom: 5px;">Date Created: <?php echo $created_date; ?></span><br /><br />
                    <span style="border-bottom: 2px solid #EB6C6A;padding-bottom: 5px;">Due Date: <?php echo $due_date; ?></span>
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