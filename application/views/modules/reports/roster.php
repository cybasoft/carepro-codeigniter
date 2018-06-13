<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
<head>
    <meta charset="UTF-8">
    <title><?php echo config_item('company')['name']; ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <style>
        .container {
            width: 1170px;
            margin: 0 auto;
        }

        @media print {
            @page {
                margin: 0;
            }

            body {
                margin: 1.6cm;
            }
        }
    </style>
</head>
<!--<body onload="javascript:print()">-->
<body>
<div class="container">
    <img class="" style="width: 250px;"
         src="<?php echo base_url(); ?>assets/img/<?php echo $this->config->item('invoice_logo', 'company'); ?>"/>

    <h3><?php echo lang('children_roster'); ?>
        <span style="font-size:12px">
        <?php echo(isset($_GET['all']) ? '('.lang('all').')' : ''); ?>
        <?php echo(isset($_GET['active']) ? '('.lang('active').')' : ''); ?>
        <?php echo(isset($_GET['inactive']) ? '('.lang('inactive').')' : ''); ?>
        <?php echo(isset($_GET['daily']) ? '('.lang('daily').')' : ''); ?>
            </span>
    </h3>
    <strong>
        <?php if(isset($_GET['date'])) {
            echo (valid_date($_GET['date']))? format_date($_GET['date'],false) : lang('invalid date');
        } else {
            echo date('d M, Y');
        }
        ?>
    </strong>
    <table class="table table-striped table-bordered">
        <tr>
            <th></th>
            <th><?php echo lang('name'); ?></th>
            <th><?php echo lang('date_of_birth'); ?></th>
            <th><?php echo lang('national_id'); ?></th>
            <th><?php echo lang('blood_type'); ?></th>
            <th><?php echo lang('enrolled_on'); ?></th>
            <th><?php echo lang('status'); ?></th>
        </tr>
        <?php foreach ($children as $child) : ?>
            <tr <?php if(!isset($_GET['inactive']) && $child->status == 0) { ?> style="text-decoration: line-through;color:red" <?php } ?>>
                <td>
                    <i class="fa fa-square-o" style="font-size:20px;"></i>
                </td>
                <td><?php echo $child->first_name.' '.$child->last_name; ?></td>
                <td><?php echo $child->bday; ?></td>
                <td><?php echo decrypt($child->national_id); ?></td>
                <td><?php echo $child->blood_type; ?></td>
                <td><?php echo format_date($child->created_at, false); ?></td>
                <td>
                    <?php
                    if(isset($_GET['daily'])) {
                        $date = date('y-m-d');
                        if(isset($_GET['date'])) {
                            $date = $_GET['date'];
                        }
                        if($this->child->checkedIn($child->id, $date)) {
                            echo '<i class="fa fa-check text-success">'.lang('present').'</i>';
                        } else {
                            echo '<i class="fa fa-times text-danger">'.lang('absent').'</i>';
                        }
                    } else {
                        echo ($child->status == 0) ? lang('inactive') : lang('active');
                    } ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>