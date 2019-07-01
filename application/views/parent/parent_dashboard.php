<div class="card-footer bg-aqua"><?php echo lang('update_child_notice'); ?></div>
<br/>
<?php if(count((array)$children) == 0): ?>
    <div class="callout callout-danger">
        <h4><?php echo lang('no_children_notice'); ?></h4>
        <p class="text-bold"><?php echo lang('phone'); ?>: <?php echo session('phone'); ?></p>
        <p class="text-bold"><?php echo lang('email'); ?>: <?php echo session('email'); ?></p>
    </div>
<?php endif; ?>

<?php foreach ($children->result() as $child): ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header box-border">
                    <h3 class="card-title">
                        <a href="<?php echo site_url( 'child/'.$child->id); ?>">
                            <?php echo $child->first_name.' '.$child->last_name; ?>
                        </a>
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-2">
                            <?php if(!empty($child->photo)): ?>
                                <img class="img-square img-responsive img-thumbnail"
                                     style="width:150px;height:150px"
                                     src="<?php echo base_url(); ?>assets/uploads/children/<?php echo $child->photo; ?>"/>
                            <?php else: ?>
                                <img class="img-circle img-responsive img-thumbnail"
                                     style="width:150px;height:150px"
                                     src="<?php echo base_url(); ?>assets/img/content/no-image.png"/>
                            <?php endif; ?>
                        </div>

                        <div class="col-sm-3">
                            <p><?php echo lang('national_id'); ?>:<?php echo decrypt($child->national_id); ?></p>
                            <p><?php echo lang('gender'); ?>: <?php echo lang($child->gender); ?></p>

                            <?php if(!empty($child->blood_type)): ?>
                                <p><?php echo lang('blood_type'); ?>: <?php echo $child->blood_type; ?></p>
                            <?php endif; ?>

                            <p>
                                <?php echo lang('enrolled_on'); ?>: <?php echo format_date($child->created_at, FALSE) ?>
                            </p>
                            <?php echo lang('status'); ?>
                            <?php echo ($child->status == 1) ? lang('active_status') : lang('inactive_status'); ?>
                        </div>

                        <div class="col-sm-7">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="row callout callout-info">
                                        <div class="col-sm-2 h2">
                                            <h2><?php echo $this->child->totalRecords('child_notes', $child->id); ?></h2>
                                        </div>
                                        <div class="col-sm-10"><?php echo lang('notes'); ?></div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="row callout callout-warning">
                                        <div class="col-sm-2">
                                            <h2><?php echo $this->child->totalrecords('child_meds', $child->id); ?></h2>
                                        </div>
                                        <div class="col-sm-10">
                                            <strong class="h4"><?php echo lang('medications'); ?></strong><br/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="row callout callout-danger">
                                        <div class="col-sm-2">
                                            <h2><?php echo $this->child->totalRecords('child_allergy', $child->id); ?></h2>
                                        </div>
                                        <div class="col-sm-10"> <?php echo lang('allergies'); ?></div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
