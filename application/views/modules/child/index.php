<?php $this->load->view('modules/child/nav'); ?>
<div class="row">
    <div class="col-sm-2 col-lg-2 col-md-2 table-responsive">
        <?php $this->load->view('modules/child/sidebar'); ?>
    </div>
    <div class="col-sm-10 col-lg-10 col-md-10">
        <div class="row">
            <div class="col-sm-6">

                <?php $this->load->view($this->module.'info'); ?>

                <div class="row">
                    <div class="col-md-12">
                        <a class="btn btn-default btn-xs"
                           href="<?php echo site_url('child/'.$child->id.'/health#allergies'); ?>">
                            <?php echo lang('allergies'); ?>
                        </a>
                        <a class="btn btn-default btn-xs"
                           href="<?php echo site_url('child/'.$child->id.'/health#meds'); ?>">
                            <?php echo lang('medications'); ?>
                        </a>
                        <a class="btn btn-default btn-xs"
                           href="<?php echo site_url('child/'.$child->id.'/health#problem_list'); ?>">
                            <?php echo lang('problem_list'); ?>
                        </a>
                        <a class="btn btn-default btn-xs"
                           href="<?php echo site_url('child/'.$child->id.'/health#food'); ?>">
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

                <h3><?php echo lang('groups'); ?></h3>
                <?php $groups = $this->db->where('child_id', $child->id)
                    ->from('child_groups')
                    ->join('child_group', 'child_group.group_id=child_groups.id')
                    ->get(); ?>
                <?php foreach ($groups->result() as $group): ?>
                    <a href="<?php echo site_url('children?group='.$group->id.'#groups'); ?>"
                       class="label label-info"><?php echo $group->name; ?></a>
                <?php endforeach; ?>
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
    </div>
</div>