<?php $this->load->view('child/nav'); ?>
<div class="row">
    <div class="col-sm-2 col-lg-2 col-md-2 ">
        <?php $this->load->view('child/sidebar'); ?>
    </div>
    <div class="col-sm-10 col-lg-10 col-md-10">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active show" href="#meds" data-toggle="tab">
                        <i class="fa fa-medkit"></i>
                        <?php echo lang('medications'); ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#allergies" data-toggle="tab">
                        <i class="fa fa-heartbeat"></i>
                        <?php echo lang('allergies'); ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#food" data-toggle="tab">
                        <i class="fa fa-leaf"></i>
                        <?php echo lang('food'); ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#emergency_contacts" data-toggle="tab">
                        <i class="fa fa-ambulance"></i> <?php echo lang('contacts'); ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#providers" data-toggle="tab">
                        <i class="fa fa-medkit"></i> <?php echo lang('healthcare_providers'); ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#problem-list" data-toggle="tab">
                        <i class="fa fa-exclamation-circle text-red"></i> <?php echo lang('problem_list'); ?>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="meds">
                    <?php $this->load->view('child/health/meds/meds'); ?>
                </div>
                <div class="tab-pane" id="allergies">
                    <?php $this->load->view('child/health/allergies'); ?>
                </div>
                <div class="tab-pane" id="food">
                    <?php $this->load->view('child/health/food'); ?>
                </div>
                <div class="tab-pane" id="emergency_contacts">
                    <?php $this->load->view('child/health/contacts'); ?>
                </div>
                <div class="tab-pane" id="providers">
                    <?php $this->load->view('child/health/providers'); ?>
                </div>
                <div class="tab-pane" id="problem-list">
                    <?php $this->load->view('child/health/problems'); ?>
                </div>
            </div>
        </div>
</div>
