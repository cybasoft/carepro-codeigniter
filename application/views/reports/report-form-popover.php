<div style="width:200px;display:none" id="daily-report">
    <form target="_blank" method="get" action="<?php echo site_url('reports/roster'); ?>">
        <input type="hidden" name="daily">
        <input type="hidden" name="active">
        <div class="input-group date">
            <input data-provide="datepicker" data-date="<?php echo date('m/d/Y'); ?>" type="text" name="date"
                   class="form-control datepicker" value="<?php echo date('m/d/Y'); ?>">
            <div class="input-group-btn">
                <button class="btn btn-default btn-flat">
                    <span class="fa fa-print"></span>
                    <?php echo lang('daily roster'); ?>
                </button>
            </div>
        </div>
    </form>
</div>