<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
<head>
    <meta charset="UTF-8">
    <title><?php echo session('company_name'); ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>assets/css/fontawesome-all.min.css" rel="stylesheet" type="text/css"/>
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
         src="<?php echo base_url(); ?>assets/uploads/content/<?php echo session('company_invoice_logo'); ?>"/>

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
            <th><?php echo lang('check_in') ?></th>
            <th><?php echo lang('check_out') ?></th>
            <th><?php echo lang('Total hours'); ?></th>
        </tr>
        <?php foreach ($children as $child) : ?>
            <?php $attendance = $this->child->attendance($child->id, date('Y-m-d', strtotime($_GET['date']))); ?>
            <tr>
                <td>
                    <i class="far fa-square" style="font-size:20px;"></i>
                </td>
                <td><?php echo $child->first_name.' '.$child->last_name; ?></td>
                <td><?php echo $child->bday; ?></td>
                <td><?php echo decrypt($child->national_id); ?></td>
                <?php if($attendance->num_rows() == 0): ?>
                    <td colspan="3">
                        <span class="text-danger"><?php echo lang('absent'); ?></span>
                    </td>
                <?php else: ?>
                    <td style="padding:0">
                        <?php foreach ($attendance->result() as $ck): ?>
                            <div style="border-bottom: solid 1px #ccc"><?php echo date('h:ia', strtotime($ck->time_in)); ?></div>
                        <?php endforeach; ?>
                    </td>
                    <td style="padding:0">
                        <?php foreach ($attendance->result() as $ck): ?>
                            <div style="border-bottom: solid 1px #ccc">
                                <?php if($ck->time_out == null): ?>
                                    <span class="label label-success"><?php echo lang('now'); ?></span>
                                <?php else: ?>
                                    <?php echo date('h:i a', strtotime($ck->time_out)); ?>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>

                        <div class="pull-right" style="font-weight:bold">
                            <?php echo lang('Total hours'); ?>:
                        </div>
                    </td>
                    <td style="padding:0">
                        <?php
                        $hours = 0;
                        $minutes = 0;
                        ?>
                        <?php foreach ($attendance->result() as $ck): ?>
                            <div style="border-bottom: solid 1px #ccc">
                                <?php if($ck->time_out == null): ?>
                                    <span class="label label-default">
                                    <?php echo checkinTimer($ck->time_in, date('Y-m-d H:i:s'))->h; ?>
                                    </span>
                                    <?php echo lang('hrs'); ?>
                                    <span class="label label-default">
                                        <?php echo checkinTimer($ck->time_in, date('Y-m-d H:i:s'))->i; ?>
                                    </span>
                                    <?php echo lang('mins'); ?>
                                <?php else: ?>
                                    <span class="label label-default">
                                        <?php $timerH = checkinTimer($ck->time_in, $ck->time_out)->h;
                                        $hours = (int)$hours + (int)$timerH;
                                        echo $timerH;
                                        ?>
                                    </span>
                                    <?php echo lang('hrs'); ?>
                                    <span class="label label-default">
                                        <?php $timerM = checkinTimer($ck->time_in, $ck->time_out)->i;
                                        $minutes = $minutes + $timerM;
                                        echo $timerM;
                                        ?>
                                    </span>
                                    <?php echo lang('mins'); ?>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                        <div class="pull-left" style="font-weight:bold">
                            <?php echo $hours; ?>
                        </div>
                    </td>
                <?php endif ?>

            </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>