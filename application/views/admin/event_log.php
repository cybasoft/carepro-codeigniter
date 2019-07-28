<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <?php echo lang('Event Logs'); ?>
                </h4>
            </div>
            <div class="card-body">
            <table class="table table-bordered table-hover table-striped" id="logs">
            <thead>
            <tr align="center">
                <th><?php echo lang('Date'); ?></th>
                <th><?php echo lang('Event'); ?></th>
            </tr>
            </thead>  
            <tbody>
            <?php foreach($event_logs as $logs): ?>
               <tr>
                 <td><?php echo event_log_date($logs->date); ?></td>
                 <td><span class="font-weight-bold"><?php echo $logs->user_name; ?></span><br/><?php echo $logs->event ?></td>
               </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
             </div>
        </div>
    </div>
</div>