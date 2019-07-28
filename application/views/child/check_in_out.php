<div class="modal show" id="check-in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display:block">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel"><?php echo ($action == "checkin") ? lang('check_in') : lang('check_out'); ?></h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo lang('close'); ?></span></button>
            </div>
            <?php echo ($action == "checkin") ? form_open('child/' . $child_id . '/checkIn') : form_open('child/' . $child_id . '/checkOut'); ?>
            <div class="modal-body">
                <div class="alert alert-warning text-left">
                    <?php echo lang('check_in_out_notice'); ?>
                </div>
                <?php if (empty($parents)) : ?>
                    <div class="alert alert-danger">
                        <?php echo lang('no_assigned_parent_error'); ?>
                    </div>
                <?php endif; ?>

                <div class="list list-group">
                    <?php foreach ($parents as $p) : ?>

                        <div class="list-group-item">
                            <div class="media">
                                <div class="align-self-start mr-2">
                                    <img class="img-thumbnail" src="<?php echo $this->user->photo($p->photo); ?>" style="width:100px;height:100px" />
                                </div>
                                <div class="media-body">
                                    <p class="mb-1">
                                        <span class="m-0 h3">
                                            <?php echo $p->first_name . ' ' . $p->last_name; ?>
                                        </span>

                                    </p>
                                    <div class="text-sm room-note">
                                        <i class="fa fa-lock"></i> <?php echo $p->pin; ?>
                                        <br>
                                        <i class="fa fa-phone"></i> <?php echo $p->phone; ?><br>
                                    </div>
                                </div>
                                <div class="ml-auto">
                                    <input type="radio" style="width:40px;height:40px;" name="<?php echo $action == "checkin" ? 'in_guardian' : 'out_guardian'; ?>" value="<?php echo $p->first_name . ' ' . $p->last_name; ?>">
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <hr />

                <div class="list list-group">
                    <?php foreach ($authPickups as $p) : ?>
                        <div class="list-group-item">
                            <div class="media">
                                <div class="align-self-start mr-2">
                                    <?php if(empty($p->photo)) : ?>
                                        <img class="img-thumbnail" src="<?php echo base_url(); ?>assets/img/content/no-image.png" style="width:100px;height:100px" />
                                    <?php else: ?>
                                        <img class="img-thumbnail" src="<?php echo base_url(); ?>assets/uploads/pickup/<?php echo $p->photo ?>" style="width:100px;height:100px" />
                                    <?php endif; ?>
                                </div>
                                <div class="media-body">
                                    <p class="mb-1">
                                        <span class="m-0 h3">
                                            <?php echo $p->first_name . ' ' . $p->last_name; ?>
                                        </span>

                                    </p>
                                    <div class="text-sm room-note">
                                        <i class="fa fa-lock"></i> <?php echo $p->pin; ?>
                                        <br>
                                        <i class="fa fa-phone"></i> <?php echo $p->cell; ?><br>
                                    </div>
                                </div>
                                <div class="ml-auto">
                                    <input type="radio" style="width:40px;height:40px;" name="<?php echo $action == "checkin" ? 'in_guardian' : 'out_guardian'; ?>" value="<?php echo $p->first_name . ' ' . $p->last_name; ?>">
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="modal-footer">
                <span class="input-group-btn">
                    <button class="btn btn-success">
                        <?php echo ($action == "checkin") ? lang('check_in') : lang('check_out'); ?>
                    </button>
                </span>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>