<div class="row">
    <div class="col-sm-6">

        <?php $this->load->view($this->module.'info'); ?>

        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-default btn-xs"
                   href="<?php echo site_url('child/'.$child->id.'/health#allergies'); ?>">
                    <?php echo lang('allergies'); ?>
                </a>
                <a class="btn btn-default btn-xs" href="<?php echo site_url('child/'.$child->id.'/health#meds'); ?>">
                    <?php echo lang('medications'); ?>
                </a>
                <a class="btn btn-default btn-xs"
                   href="<?php echo site_url('child/'.$child->id.'/health#problem_list'); ?>">
                    <?php echo lang('problem_list'); ?>
                </a>
                <a class="btn btn-default btn-xs" href="<?php echo site_url('child/'.$child->id.'/health#food'); ?>">
                    <?php echo lang('food_pref_header'); ?>
                </a>
                <a class="btn btn-default btn-xs"
                   href="<?php echo site_url('child/'.$child->id.'/health#emergency_contacts'); ?>">
                    <?php echo lang('emergency_contacts'); ?>
                </a>
                <a class="btn btn-default btn-xs"
                   href="<?php echo site_url('child/'.$child->id.'/health#providers'); ?>">
                    <?php echo lang('healthcare_providers'); ?>
                </a>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-default btn-xs"
                   href="<?php echo site_url('child/'.$child->id.'/notes#notes'); ?>">
                    <?php echo lang('notes'); ?>
                </a>
                <a class="btn btn-default btn-xs"
                   href="<?php echo site_url('child/'.$child->id.'/notes#incidents'); ?>">
                    <?php echo lang('incident_reports'); ?>
                </a>
            </div>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="box box-solid box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo lang('parents'); ?></h3>
                <?php if(!is('parent')): ?>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool  assign-user-btn">
                            <span class="fa fa-plus"></span>
                            <?php echo lang('assign'); ?>
                        </button>
                    </div>
                <?php endif; ?>
            </div>
            <div class="box-body table-responsive">
                <div class="assign-user"></div>
                <?php $this->load->view($this->module.'parents'); ?>
            </div>
        </div>

        <?php $this->load->view($this->module.'pickup'); ?>
    </div>
</div>



