<?php $this->load->view('child/nav'); ?>
<div class="row">
    <div class="col-sm-2 col-lg-2 col-md-2 ">
        <?php $this->load->view('child/sidebar'); ?>
    </div>
    <div class="col-sm-10 col-lg-10 col-md-10">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="nav-item active show">
                     <a class="nav-link" href="#attendance" aria-controls="attendance-report" role="tab" data-toggle="tab">
                        <?php echo lang('Attendance'); ?>
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active show" id="attendance">
                     <div class="card">
                         <div class="card-body"><?php $this->load->view($this->module.'reports/attendance'); ?></div>
                     </div>
                </div>
            </div>
    </div>
</div>