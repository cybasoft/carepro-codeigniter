<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <?php echo !empty($room->description) ? $room->description : $room->name; ?>
            <button type="button" class="btn btn-default btn-sm card-tools" data-toggle="modal" data-target="#myModal">
                <i class="fa fa-pencil-alt"></i> <?php echo lang('edit'); ?>
            </button>
        </h3>
    </div>
</div>


<div class="row">
    <div class="col-sm-4">

        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><?php echo lang('assigned staff'); ?>
                    <button type="button" class="btn btn-primary btn-xs card-tools" data-toggle="modal"
                            data-target="#staffModal">
                        <i class="fa fa-user-plus"></i>
                        <?php echo lang('Assign staff'); ?>
                    </button>
                </h4>

            </div>
            <div class="card-body">
                <div class="row">
                    <?php foreach ($room->staff as $as): ?>
                        <div class="col-sm-4 text-center">
                            <?php if(is(['admin', 'manager'])): ?>
                            <a  class="delete" href="<?php echo site_url('/rooms/detachStaff/'.$room->id.'/'.$as->id); ?>"
                               style="position: absolute;right: 10px;top:-10px">
                                <i class="fa fa-times-circle text-danger"></i>
                            </a>
                            <?php endif; ?>
                            <img class="img-thumbnail" style="height:100px;"
                                 src="<?php echo $this->user->photo($as->photo); ?>"/><br/>
                            <?php echo $as->first_name.' '.$as->last_name; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><?php echo lang('assigned children'); ?>
                    <button type="button"
                            class="btn btn-warning btn-xs card-tools"
                            data-toggle="modal"
                            data-target="#childrenModal">
                        <i class="fa fa-user-plus"></i>
                        <?php echo lang('Assign children'); ?>
                    </button>
                </h4>

            </div>
            <div class="card-body">

                <div class="row">
                    <?php foreach ($room->children as $cg): ?>
                        <div class="col-sm-4 text-center" style="margin-bottom:10px">
                            <?php if(is(['admin', 'manager'])): ?>
                                <a class="delete" href="<?php echo site_url('/rooms/detachChild/'.$room->id.'/'.$cg->child_id); ?>"
                                   style="position: absolute;right: 10px;top:-10px">
                                    <i class="fa fa-times-circle text-danger"></i>
                                </a>
                            <?php endif; ?>
                            <img class="img-thumbnail" style="width:100px;height:100px;"
                                 src="<?php echo $this->child->photo($cg->photo); ?>"/><br/>
                            <?php echo anchor('child/'.$cg->child_id, $cg->first_name.' '.$cg->last_name); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </div>

    <div class="col-sm-8">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active show" href="#notes" aria-controls="notes" role="tab" data-toggle="tab">
                    <i class="fa fa-clipboard"></i>
                    <?php echo lang('Notes'); ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#activities" aria-controls="activities" role="tab" data-toggle="tab">
                    <i class="fa fa-weight"></i>
                    <?php echo lang('Activity Plan'); ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#meal" aria-controls="meal" role="tab" data-toggle="tab">
                    <i class="fa fa-calendar-check"></i>
                    <?php echo lang('Meal Plan'); ?>
                </a>
            </li>
        </ul>
        <div class="tab-content tabcontent-border">
            <div role="tabpanel" class="tab-pane fade in active show" id="notes">
                <?php $this->load->view($this->module.'room-notes'); ?>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="activities">
                <?php $this->load->view($this->module.'activity-planner'); ?>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="meal">
                <?php $this->load->view($this->module.'meal-planner'); ?>
            </div>
        </div>
    </div>

</div>

<?php echo anchor('rooms/destroy/'.$room->id, '<i class="fa fa-trash"></i> '.lang('Delete room'), ['class' => 'btn btn-xs btn-danger delete card-tools']); ?>

<?php $this->load->view($this->module.'edit-room-modal'); ?>
<?php $this->load->view($this->module.'add-children-modal'); ?>
<?php $this->load->view($this->module.'add-staff-modal'); ?>
