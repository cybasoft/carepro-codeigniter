<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>DayCarePRO</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>


    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

</head>
<body onload="javascript:print()">
<div class="container">
    <img class="" style="width: 250px;" src="<?php echo base_url(); ?>assets/images/logo.png"/>

    <h3>Children Roster</h3>
    <table class="table table-responsive table-striped">
        <tr>
            <td></td>
            <th>Name</th>
            <th>Date of Birth</th>
            <th>SSN/National ID</th>
            <th>Blood Type</th>
            <th>Enrolled on</th>
        </tr>
        <?php foreach ($children as $child): ?>
            <tr>
                <td>
                    <i class="fa fa-square-o" style="font-size:20px;"></i>
                </td>
                <td><?php echo $child->fname . ' ' . $child->lname; ?></td>
                <td><?php echo $child->bday; ?></td>
                <td><?php echo $this->conf->decrypt($child->ssn); ?></td>
                <td><?php echo $child->blood_type; ?></td>
                <td><?php echo $child->enroll_date; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>