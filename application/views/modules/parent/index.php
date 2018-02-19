<div class="box-footer bg-aqua">
    <?php echo lang('update_child_notice'); ?>
</div>

<div class="row">
    <?php if (count($children) == 0): ?>
        <div class="callout callout-danger">
            <h4>
                <?php echo lang('no_children_notice'); ?>
            </h4>

            <p class="text-bold"><?php echo lang('phone'); ?>: <?php echo config_item('company')['phone']; ?></p>

            <p class="text-bold"><?php echo lang('email'); ?>: <?php echo config_item('company')['email']; ?></p>
        </div>
    <?php endif; ?>
    <?php foreach ($children->result() as $child): ?>
        <div class="col-lg-4 col-md-4 col-xs-12">
            <br/>
            <div class="box box-info">
                <div class="box-header box-border">
                    <h3 class="box-title">
                        <a href="<?php echo site_url('child/'.$child->id); ?>">
                            <?php echo $child->first_name . ' ' . $child->last_name; ?>
                        </a>
                    </h3>
                </div>
                <div class="box-body">
                    <table class="table">
                        <tr>
                            <td rowspan="5">
                                <?php if (!empty($child->photo)): ?>
                                    <img class="img-square img-responsive img-thumbnail"
                                         style="width:150px;height:150px"
                                         src="<?php echo base_url(); ?>assets/uploads/users/children/<?php echo $child->photo; ?>"/>
                                <?php else: ?>
                                    <img class="img-circle img-responsive img-thumbnail"
                                         style="width:150px;height:150px"
                                         src="<?php echo base_url(); ?>assets/img/content/no-image.png"/>;
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo lang('national_id'); ?>:</td>
                            <td><?php echo decrypt($child->national_id); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo lang('gender'); ?>:</td>
                            <td><?php  echo lang($child->gender); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo lang('blood_type'); ?>:</td>
                            <td><?php echo $child->blood_type; ?></td>
                        </tr>
                        <tr>
                            <td><?php echo lang('enrolled_on'); ?>:</td>
                            <td><?php echo format_date($child->created_at, false) ?></td>
                        </tr>
                    </table>
                </div>
                <div class="box-footer">

                    <div class="bg-warning">
                    <span
                            class="badge"><?php echo $this->child->totalRecords('child_notes', $child->id); ?></span>
                        <?php echo lang('notes'); ?>
                    </div>
                    <div class="bg-warning">
                    <span
                            class="badge"><?php echo $this->child->totalrecords('child_meds', $child->id); ?></span>
                        <?php echo lang('medications'); ?>
                    </div>
                    <div class="bg-warning">
                    <span
                            class="badge"><?php echo $this->child->totalRecords('child_allergy', $child->id); ?></span>
                        <?php echo lang('allergies'); ?>
                    </div>

                    <br/>
                    <?php echo lang('status'); ?>
                    <?php echo ($child->status == 1) ? lang('active_status') : lang('inactive_status'); ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>