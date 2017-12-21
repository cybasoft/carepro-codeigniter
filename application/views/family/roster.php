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
    <img class="" style="width: 250px;" src="<?php echo base_url(); ?>assets/img/logo.png"/>

    <h3>Parents Roster</h3>
    <table class="table table-responsive table-striped">
        <tr>
            <td></td>
            <th>Name</th>
            <th>Phone</th>
            <th>EMail</th>
            <th>Address</th>
            <th>Children</th>
        </tr>
        <?php foreach ($parents->result() as $parent) : ?>
            <tr>
                <td>
                    <i class="fa fa-square-o" style="font-size:20px;"></i>
                </td>
                <td><?php echo $parent->first_name . ' ' . $parent->last_name; ?></td>
                <td><?php echo $this->user->userData($parent->id, 'phone'); ?></td>
                <td><?php echo $parent->email; ?></td>
                <td>
                    <?php echo $this->user->userData($parent->id, 'street'); ?><br/>
                    <?php echo $this->user->userData($parent->id, 'street2'); ?><br/>
                    <?php echo $this->user->userData($parent->id, 'city'); ?>
                    <?php echo $this->user->userData($parent->id, 'state'); ?>
                    <?php echo $this->user->userData($parent->id, 'zip'); ?>
                </td>
                <td>
                    <?php foreach ($this->parent->getChildren($parent->id)->result() as $child) {
                        echo $child->fname . ' ' . $child->lname . '<br/>';
                    }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>