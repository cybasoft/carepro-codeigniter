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
    <div class="col-sm-6">

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
                    <?php foreach ($staff as $as): ?>
                        <div class="col-xs-3">
                            <img class="img-thumbnail" style="height:100px;"
                                 src="<?php echo $this->user->photo($as->user_id); ?>"/>
                            <h4> <?php echo $as->first_name.' '.$as->last_name; ?></h4>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><?php echo lang('assigned children'); ?>
                    <button type="button" class="btn btn-warning btn-xs card-tools" data-toggle="modal"
                            data-target="#childrenModal">
                        <i class="fa fa-user-plus"></i>
                        <?php echo lang('Assign children'); ?>
                    </button>
                </h4>

            </div>
            <div class="card-body">

                <div class="row">
                    <?php foreach ($children as $cg): ?>
                        <div class="col-xs-3">
                            <img class="img-thumbnail" style="width:100px;height:100px;"
                                 src="<?php echo $this->child->photo($cg->child_id); ?>"/>
                            <h4><?php echo anchor('child/'.$cg->child_id, $cg->first_name.' '.$cg->last_name); ?></h4>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </div>

    <div class="col-sm-6">
        <?php $this->load->view($this->module.'room-notes'); ?>
    </div>

</div>

<?php echo anchor('rooms/destroy/'.$room->id, '<i class="fa fa-trash"></i> '.lang('Delete room'), ['class' => 'btn btn-xs btn-danger delete card-tools']); ?>

<?php $this->load->view($this->module.'edit-room-modal'); ?>
<?php $this->load->view($this->module.'add-children-modal'); ?>
<?php $this->load->view($this->module.'add-staff-modal'); ?>
