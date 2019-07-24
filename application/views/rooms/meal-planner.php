<style>
    table {
        width: 100%;
        border-spacing: 0;
        border-collapse: separate;
        table-layout: fixed;
        margin-bottom: 50px;
    }

    table thead tr th {
        background: #20aecc;
        color: #fff;
        padding: 0.5em;
        overflow: hidden;
        border-right: solid 1px #fff;
    }

    table tbody tr.active td {
        color: #333;
        background: #53cc8e40;
    }

    table thead tr th i {
        vertical-align: middle;
        font-size: 2em;
    }

    table tbody tr {
        background: #e2e2e2;
    }

    table tbody tr:nth-child(odd) td {
        /*border-right:solid 1px #ccc*/
    }

    table tbody tr:nth-child(odd) {
        /*background: #fff;*/

    }

    table tbody tr td {
        border-bottom: 1px solid #53cc8e;
    }

    table tbody tr td {
        text-align: center;
        vertical-align: middle;
        border-left: 1px solid #fff;
        position: relative;
        height: 32px;
        cursor: pointer;
    }

    table tbody tr td:last-child {
        border-right: 1px solid #fff;
    }

    table tbody tr td.day {
        font-size: 2em;
        padding: 0;
        color: #626E7E;
        background: #fff;
        border-bottom: solid 1px #53cc8e;
        border-collapse: separate;
        min-width: 100px;
        cursor: default;
    }

    table tbody tr td.day span {
        display: block;
    }

    table tbody td.day span:nth-child(2) {
        font-size: 10px
    }

    table .meal-item {
        display: block;
        background: #009688;
        margin-bottom: 1px;
        border-radius: 3px;
        color: #ffffff;
        z-index: 2000
    }

    @media (max-width: 60em) {
        table tbody tr td.day span {
            transform: rotate(270deg);
            -webkit-transform: rotate(270deg);
            -moz-transform: rotate(270deg);
        }
    }

    @media (max-width: 27em) {
        table thead tr th {
            font-size: 65%;
        }

        table thead tr th .time {
            display: block;
            font-size: 1.2em;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            margin: 0 auto 5px;
            padding: 5px;
        }

        table thead tr th .time.active {
            background: #f5f8fa;
            color: #626E7E;
        }

        table tbody tr td.day {
            font-size: 1.7em;
        }

        table tbody tr td.day span {
            transform: translateY(16px) rotate(270deg);
            -webkit-transform: translateY(16px) rotate(270deg);
            -moz-transform: translateY(16px) rotate(270deg);
        }
    }

    .add-meal {
        font-size: 20px;
    }
    .meal-header .fa-chevron-right, .meal-header .fa-chevron-left{
        color: #20aecc;
    }

    .meal-header .fa-chevron-right:hover, .meal-header .fa-chevron-left:hover{
        color: #ccc;
    }
</style>

<div class="card weekly">
    <div class="card-header">
        <h3 class="card-title text-center meal-header">
            <?php
            if(isset($_GET['week']) && $_GET['week'] !== "") {

                $lastWeek = date('Y-m-d', strtotime($_GET['week'].' -7 days')).'#meal';
                $nextWeek = date('Y-m-d', strtotime($_GET['week'].' +7 days')).'#meal';

                echo anchor(uri_string().'?week='.$lastWeek, icon('chevron-left').'&nbsp;');
                echo format_date($_GET['week'], FALSE);
                echo ' - ';
                echo format_date(date('Y-m-d', strtotime($_GET['week'].' +6 days')), FALSE);
                echo anchor(uri_string().'?week='.$nextWeek, '&nbsp;'.icon('chevron-right'));
            } else {

                $lastWeek = date('Y-m-d', strtotime('monday last week')).'#meal';
                $nextWeek = date('Y-m-d', strtotime('monday next week')).'#meal';

                echo anchor(uri_string().'?week='.$lastWeek, icon('chevron-left').'&nbsp;');

                echo format_date(date('Y-m-d', strtotime('monday this week')), FALSE);
                echo ' - ';
                echo format_date(date('Y-m-d', strtotime('monday this week +6 days')), FALSE);
                echo anchor(uri_string().'?week='.$nextWeek, '&nbsp;'.icon('chevron-right'));
            }
            ?>
        </h3>
    </div>

    <div class="card-content">
        <div class="weekly-btns">
            <?php if(!isset($_GET['week']) || isset($_GET['week']) && $_GET['week'] == date('Y-m-d')): ?>
                <a href="<?php echo site_url('meals/copy'); ?>"
                   class="btn btn-primary btn-sm copy-plan"><?php echo icon('copy').' '.lang('Copy to next week'); ?></a>
                <a href="<?php echo site_url('meals/clear'); ?>"
                   class="btn btn-warning btn-sm clear-plan"><?php echo icon('trash').' '.lang('Clear meal plan'); ?></a>
            <?php else: ?>
                <?php echo anchor(uri_string().'#meal',icon('home').' '.lang('This week'),'class="btn btn-primary btn-sm"'); ?>
            <?php endif; ?>
        </div>
        <table>
            <thead>
            <tr>
                <th></th>
                <?php foreach ($mealTypes as $mealType): ?>
                    <th>
                        <span class="time"><?php echo lang($mealType->name); ?></span>
                        <i class="fa fa-plus pull-right cursor text-warning" style="font-size:20px"
                           onclick="addMeal('<?php echo ucfirst($mealType->name); ?>','<?php echo $mealType->id; ?>');"></i>
                    </th>
                <?php endforeach; ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($days as $num => $day): ?>
                <?php

                if(isset($_GET['week']) && $_GET['week'] !== "") {
                    $date = date('Y-m-d', strtotime($_GET['week'].' +'.$num.'days'));
                } else {
                    $date = date('Y-m-d', strtotime('monday this week '.$num.' days'));
                }
                ?>
                <tr class="<?php echo date('Y-m-d') == $date ? 'active' : ''; ?>">
                    <td class="day"><span><?php echo $day; ?></span>
                        <span><?php echo $date; ?></span>
                    </td>
                    <?php foreach ($mealTypes as $mealType): ?>
                        <td class="meal-day">
                            <?php foreach ($this->meal->getMeal($mealType->id, $date, $room->meals) as $item): ?>
                                <?php if(is(['admin', 'manager', 'staff'])): ?>
                                    <a href="<?php echo site_url('meals/delete/'.$item['id']); ?>"
                                       class="delete meal-item"><?php echo $item['name']; ?></a>
                                <?php else: ?>
                                    <?php echo $item['name']; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<div class="modal fade" id="mealModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mealModalLabel"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php echo form_open('meals/create'); ?>
            <?php echo form_hidden('room_id', $room->id); ?>
            <?php echo form_hidden('meal_type'); ?>
            <div class="modal-body">
                <label><?php echo lang('Date'); ?></label>
                <?php echo form_date('meal_date', date('Y-m-d'), 'class="form-control"'); ?>

                <label><?php echo lang('Food item'); ?><span class="field_required"> *</span></label>
                <?php echo form_input('name', NULL, 'class="form-control" required="required"'); ?>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary"><?php echo lang('Submit'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<script>
    function addMeal(meal, id) {
        var div = $('#mealModal');
        div.find('input[name=room_id]').val('<?php echo uri_segment(3); ?>');
        div.find('input[name=meal_type]').val(id);
        div.find('#mealModalLabel').text(meal);
        div.modal('show');
    }

    $('.meal-item').on('click', function (e) {
        e.preventDefault();

        var loc = $(this).attr('href');
        swal({
            title: lang['confirm_delete_title'],
            text: lang['confirm_delete_warning'],
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: lang['confirm_delete_btn'],
            closeOnConfirm: false,
            backdrop: false,
            allowOutsideClick: false
        }, function () {
            swal('processing...');
            if (loc !== undefined)
                window.location.href = loc;
        });

    })
    $('.clear-plan').on('click', function (e) {
        e.preventDefault();

        var loc = $(this).attr('href');
        swal({
            title: lang['confirm_delete_title'],
            text: lang['confirm_delete_warning'],
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: lang['confirm_delete_btn'],
            closeOnConfirm: false,
            backdrop: false,
            allowOutsideClick: false
        }, function () {
            swal('processing...');
            if (loc !== undefined)
                window.location.href = loc;
        });

    })
    $('.copy-plan').on('click', function (e) {
        e.preventDefault();

        var loc = $(this).attr('href');
        swal({
            title: '<?php echo lang('Confirm data overwrite'); ?>',
            text: '<?php echo lang('This will overwrite meal plan for next week'); ?>',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: '<?php echo lang('Confirm'); ?>',
            closeOnConfirm: false,
            backdrop: false,
            allowOutsideClick: false
        }, function () {
            swal('processing...');
            if (loc !== undefined)
                window.location.href = loc;
        });

    })
</script>