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
                <th></th>
                <th><?php echo lang('User ID'); ?></th>
                <th><?php echo lang('Event'); ?></th>
                <th><?php echo lang('Updated at'); ?></th>          
            </tr>
            </thead>  
            <?php foreach ($event_logs as $logs): ?>
                <tr>
                    <td><?php echo $logs['id']; ?></td>                   
                    <td><?php echo $logs['user_id']; ?></td>
                    <td><?php echo $logs['event']; ?></td>
                    <td><?php echo $logs['date']; ?></td>                
                </tr>
            <?php
            endforeach;
            ?>          
        </table>
             </div>
        </div>
    </div>
</div>