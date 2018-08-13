<?php $this->load->view('modules/child/nav'); ?>
<div class="row">

    <div class="col-sm-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#meals" aria-controls="meals" role="tab" data-toggle="tab">
                        <?php echo lang('Meals'); ?>
                    </a>
                </li>
                <li role="presentation">
                    <a href="#attendance-report" aria-controls="attendance-report" role="tab" data-toggle="tab">
                        <?php echo lang('Attendance'); ?>
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="meals">
                    <?php $this->load->view($this->module.'reports/attendance_meals'); ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="attendance-report">
                    <?php $this->load->view($this->module.'reports/attendance'); ?>
                </div>
            </div>
        </div>
    </div>
</div>