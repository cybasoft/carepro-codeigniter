<div class="callout callout-info">
    <div class="h4">
        <?php echo $room->description; ?>
        <button type="button" class="btn btn-default btn-sm pull-right" data-toggle="modal" data-target="#myModal">
            <i class="fa fa-pencil-alt"></i> <?php echo lang('edit'); ?>
        </button>
    </div>
</div>

<?php if(count((array)$children)>0): ?>
    <div class="row">
        <div class="col-sm-6">

            <div class="box box-warning box-solid">
                <div class="box-header">
                    <h3 class="box-title"><?php echo lang('assigned staff'); ?></h3>
                    <button type="button" class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#staffModal">
                        <i class="fa fa-user-plus"></i>
                        <?php echo lang('Assign staff'); ?>
                    </button>
                </div>
                <div class="box-body">
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

            <div class="box box-primary box-solid">
                <div class="box-header">
                    <h3 class="box-title"><?php echo lang('assigned children'); ?></h3>
                    <button type="button" class="btn btn-warning btn-xs pull-right" data-toggle="modal" data-target="#childrenModal">
                        <i class="fa fa-user-plus"></i>
                        <?php echo lang('Assign children'); ?>
                    </button>
                </div>
                <div class="box-body">

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
            <?php $this->load->view($this->module.'notes'); ?>
        </div>

    </div>

    <?php echo anchor('rooms/destroy/'.$room->id,'<i class="fa fa-trash"></i> '.lang('Delete room'),['class'=>'btn btn-xs btn-danger delete pull-right']); ?>

<?php endif; ?>

<script src="<?php echo base_url(); ?>assets/plugins/list.min.js" type="text/javascript"></script>
<?php $this->load->view($this->module.'edit-room-modal'); ?>
<?php $this->load->view($this->module.'add-children-modal'); ?>
<?php $this->load->view($this->module.'add-staff-modal'); ?>
