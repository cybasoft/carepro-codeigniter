<?php $this->load->view('modules/child/nav'); ?>
<div class="row">
    <div class="col-sm-2 col-lg-2 col-md-2 table-responsive">
        <?php $this->load->view('modules/child/sidebar'); ?>
    </div>
    <div class="col-sm-10 col-lg-10 col-md-10">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                     <a href="#attendance-report" aria-controls="attendance-report" role="tab" data-toggle="tab">
                        <?php echo lang('Attendance'); ?>
                    </a>
                </li>
                <li role="presentation">

                </li>
            </ul>

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="meals">
                     <?php $this->load->view($this->module.'reports/attendance'); ?>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="attendance-report">

                </div>
            </div>
        </div>
    </div>
</div>