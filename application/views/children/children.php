<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li role="presentation" class="active">
            <a href="#active" aria-controls="active" role="tab" data-toggle="tab">
                <span class="badge badge-info">
                    <?php echo $totalChildren; ?></span>
                <?php echo lang('active_children'); ?>
            </a>
        </li>
        <i class="fa fa-allergies text-danger"></i>
        <?php echo lang('allergy'); ?> &nbsp; | &nbsp;
        <i class="fa fa-pills text-danger"></i>
        <?php echo lang('meds'); ?>
        <button type="button" data-toggle="popover" class="popover-toggle btn btn-lg btn-danger btn-sm btn-flat reportsBtn">
            <i class="fa fa-clipboard-list"></i>
            <?php echo lang('reports'); ?></button>


        <a href="<?php echo site_url('reports/roster?active'); ?>" target="_blank"
            class="btn btn-success btn-flat btn-sm">
            <span class="fa fa-print"></span>
            <?php echo lang('active'); ?>
        </a>
        <a href="<?php echo site_url('reports/roster?inactive'); ?>" target="_blank"
            class="btn btn-danger btn-flat btn-sm">
            <span class="fa fa-print"></span>
            <?php echo lang('inactive'); ?>
        </a>
        <a href="<?php echo site_url('reports/roster'); ?>" target="_blank"
            class="btn btn-warning btn-flat btn-sm">
            <span class="fa fa-print"></span>
            <?php echo lang('print all'); ?>
        </a>

        <li role="presentation" class="pull-right">
            <a href="#inactive" aria-controls="inactive" role="tab" data-toggle="tab">
                <i class="fa fa-info"></i>
                <?php echo lang('inactive_children'); ?>
            </a>
        </li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="active">

            <hr />

            <div class="row">
                <div class="col-md-6">
                    <?php $this->load->view($this->module . 'checked_in'); ?>
                </div>
                <div class="col-md-6">
                    <?php $this->load->view($this->module . 'checked_out'); ?>
                </div>
            </div>
        </div>

        <div role="tabpanel" class="tab-pane fade" id="inactive">
            <?php $this->load->view($this->module . 'inactive_children'); ?>
        </div>

    </div>
</div>

<div class="my_modal"></div>

<script type="text/javascript">
    function loadCheckInModal(child_id) {
        $('.my_modal').load(site_url + 'child/' + child_id + '/checkIn').modal();
    }

    function loadCheckOutModal(child_id) {
        $('.my_modal').load(site_url + 'child/' + child_id + '/checkOut').modal();
    }

</script>

<?php $this->load->view('reports/report-form-popover');
