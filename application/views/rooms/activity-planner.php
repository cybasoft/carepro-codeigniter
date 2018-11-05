<div class="card weekly">
    <div class="card-header">
        <h3 class="card-title text-center weekly-header">
            <?php
            if(isset($_GET['week']) && $_GET['week'] !== "") {

                $lastWeek = date('Y-m-d', strtotime($_GET['week'].' -7 days')).'#activities';
                $nextWeek = date('Y-m-d', strtotime($_GET['week'].' +7 days')).'#activities';

                echo anchor(uri_string().'?week='.$lastWeek, icon('chevron-left').'&nbsp;');
                echo format_date($_GET['week'], FALSE);
                echo ' - ';
                echo format_date(date('Y-m-d', strtotime($_GET['week'].' +6 days')), FALSE);
                echo anchor(uri_string().'?week='.$nextWeek, '&nbsp;'.icon('chevron-right'));
            } else {

                $lastWeek = date('Y-m-d', strtotime('monday last week')).'#activities';
                $nextWeek = date('Y-m-d', strtotime('monday next week')).'#activities';

                echo anchor(uri_string().'?week='.$lastWeek, icon('chevron-left').'&nbsp;');

                echo format_date(date('Y-m-d', strtotime('monday this week')), FALSE);
                echo ' - ';
                echo format_date(date('Y-m-d', strtotime('monday this week +6 days')), FALSE);
                echo anchor(uri_string().'?week='.$nextWeek, '&nbsp;'.icon('chevron-right'));
            }
            ?>
        </h3>

    </div>

    <?php
    $h_start = "08:00";
    $h_end = "17:00";
    $interval = "30";

    $starttimestamp = strtotime($h_start);
    $endtimestamp = strtotime($h_end);
    $hours = abs($endtimestamp - $starttimestamp) / 3600;

    ?>
    <div class="card-content">
        <div class="weekly-btns">
            <button
                    data-toggle="modal" data-target="#activityModal"
                    class="btn btn-default btn-sm"><?php echo icon('plus').' '.lang('New Activity'); ?></button>
            <?php if(!isset($_GET['week']) || isset($_GET['week']) && $_GET['week'] == date('Y-m-d')): ?>
                <a href="<?php echo site_url('activities/copy'); ?>"
                   class="btn btn-primary btn-sm copy-plan"><?php echo icon('copy').' '.lang('Copy to next week'); ?></a>
                <a href="<?php echo site_url('activities/clear'); ?>"
                   class="btn btn-warning btn-sm clear-plan"><?php echo icon('trash').' '.lang('Clear activity plan'); ?></a>
            <?php else: ?>
                <?php echo anchor(uri_string().'#activities', icon('home').' '.lang('This week'), 'class="btn btn-primary btn-sm"'); ?>
            <?php endif; ?>
        </div>

        <table>
            <thead>
            <tr>
                <th></th>
                <?php foreach ($days as $num => $day): ?>
                    <?php

                    if(isset($_GET['week']) && $_GET['week'] !== "") {
                        $date = date('Y-m-d', strtotime($_GET['week'].' +'.$num.'days'));
                    } else {
                        $date = date('Y-m-d', strtotime('monday this week '.$num.' days'));
                    }
                    ?>
                    <th class="text-center">
                        <span class="time"><?php echo $day; ?></span>
                        <span class="d-block text-sm text-warning"><?php echo $date; ?></span>
                    </th>
                <?php endforeach; ?>
            </tr>
            </thead>
            <tbody>
            <?php for ($i = 0; $i <= $hours; $i++): ?>
                <?php
                $hour = date('h', strtotime($h_start.' + '.$i.' hours'));
                ?>

                <tr class="<?php echo date('h') == $hour ? 'active' : ''; ?>">
                    <td class="day"><span class="text-sm"><?php echo $hour; ?></span></td>
                    <?php foreach ($days as $num => $day): ?>
                        <?php
                        if(isset($_GET['week']) && $_GET['week'] !== "") {
                            $date = date('Y-m-d', strtotime($_GET['week'].' +'.$num.'days'));
                        } else {
                            $date = date('Y-m-d', strtotime('monday this week '.$num.' days'));
                        }
                        ?>
                        <td class="hour">
                            <?php foreach ($this->activity->getActivity($date, $hour, $activities) as $item): ?>
                                <span
                                        id="<?php echo $item['id']; ?>"
                                        data-name="<?php echo $item['name']; ?>"
                                        data-description="<?php echo $item['description']; ?>"
                                        data-activity_date="<?php echo $item['activity_date']; ?>"
                                        data-activity_start="<?php echo $item['activity_start']; ?>"
                                        data-activity_end="<?php echo $item['activity_end']; ?>"
                                        class="update-activity-item activity-item">
                                    <?php echo $item['name']; ?>
                                </span>
                            <?php endforeach; ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endfor; ?>
            </tbody>
        </table>
    </div>

</div>

<div class="modal fade" id="activityModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="activityModalLabel"><?php echo lang('New activity'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <?php echo form_open('activities/create'); ?>
            <?php echo form_hidden('room_id', $room->id); ?>

            <div class="modal-body">
                <label><?php echo lang('Activity'); ?></label>
                <?php echo form_input('name', NULL, 'class="form-control" required="required" required="required"'); ?>

                <div class="row">
                    <div class="col-sm-4">
                        <label><?php echo lang('Date'); ?></label>
                        <?php echo form_date('activity_date', date('Y-m-d'), 'class="form-control" required="required"'); ?>
                    </div>
                    <div class="col-sm-4">
                        <label><?php echo lang('Start'); ?></label>
                        <?php echo form_time('activity_start', date('H:i'), 'class="form-control" required="required"'); ?>
                    </div>
                    <div class="col-sm-4">
                        <label><?php echo lang('End'); ?></label>
                        <?php echo form_time('activity_end', date('H:i'), 'class="form-control" required="required"'); ?>
                    </div>
                </div>

                <label><?php echo lang('Description'); ?></label>
                <textarea class="form-control" name="description"></textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary"><?php echo lang('Submit'); ?></button>
                <a href="#" class="btn btn-danger delete hidden"><i class="fa fa-trash"></i> </a>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<?php if(is('parent')): ?>
<script>
    var div = $('#activityModal');
    div.find('input').attr('readonly','readonly');
    div.find('textarea').attr('readonly','readonly');
    div.find('.modal-footer').remove();
    div.find('#activityModalLabel').remove()
    div.find('form').attr('href','#')
</script>
<?php endif; ?>
<script>

    $('.update-activity-item').click(function () {
        var div = $('#activityModal');
        var id = $(this).attr('id');
        div.find('input[name=name]').val($(this).attr('data-name'));
        div.find('input[name=activity_start]').val($(this).attr('data-activity_start'));
        div.find('input[name=activity_end]').val($(this).attr('data-activity_end'));
        div.find('input[name=activity_date]').val($(this).attr('data-activity_date'));
        div.find('textarea[name=description]').val($(this).attr('data-description'));
        div.find('#activityModalLabel').text('Update Activity');
        div.find('.delete').removeClass('hidden').attr('href', site_url + 'activities/delete/' + id);
        div.find('form').attr('action',site_url+'activities/update/'+id);
        div.modal('show');
    })

    $('.delete-item').on('click', function (e) {
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