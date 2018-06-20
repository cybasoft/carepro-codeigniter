<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
<head>
    <meta charset="UTF-8">
    <title><?php echo get_option('company_name'); ?></title>
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
         src="<?php echo base_url(); ?>assets/img/<?php echo get_option('invoice_logo'); ?>"/>

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
            echo (valid_date($_GET['date'])) ? format_date($_GET['date'], false) : lang('invalid date');
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
            <th><?php echo format_date($_GET['date'], false); ?></th>
        </tr>
        <?php foreach ($children as $child) : ?>
            <tr>
                <td>
                    <i class="fa fa-checkbox-alt" style="font-size:20px;"></i>
                </td>
                <td><?php echo $child->first_name.' '.$child->last_name; ?></td>
                <td><?php echo $child->bday; ?></td>
                <td><?php echo decrypt($child->national_id); ?></td>
                <td style="font-size:12px">
                    <?php
                    $attendance = $this->child->attendance($child->id, $_GET['date']); ?>
                    <?php if($attendance->num_rows() == 0): ?>
                        <span class="text-danger"><?php echo lang('absent'); ?></span>
                    <?php endif ?>
                    <?php foreach ($attendance->result() as $ck): ?>
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <?php echo date('H:ia', strtotime($ck->time_in)); ?>
                                -
                                <?php if($ck->time_out == null): ?>
                                    <span class="label label-success"><?php echo lang('now'); ?></span>
                                <?php else: ?>
                                    <?php echo date('H:ia', strtotime($ck->time_out)); ?>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <?php if($ck->time_out == null): ?>
                                    <span class="label label-default">
                                    <?php echo checkinTimer($ck->time_in, date('Y-m-d H:i:s'))->h.' '.lang('hrs'); ?>
                                    <?php echo checkinTimer($ck->time_in, date('Y-m-d H:i:s'))->i.' '.lang('mins'); ?>
                                </span>
                                <?php else: ?>
                                    <span class="label label-default">
                                        <?php echo checkinTimer($ck->time_in, $ck->time_out)->h.' '.lang('hrs'); ?>
                                        <?php echo checkinTimer($ck->time_in, $ck->time_out)->i.' '.lang('mins'); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>