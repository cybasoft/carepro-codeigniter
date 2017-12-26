<div class="modal show" id="check-in">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only"><?php echo lang('close'); ?></span></button>
                <h2 class="modal-title" id="myModalLabel"><?php echo lang('check_in'); ?></h2>
            </div>
            <?php echo form_open('child/' . $child_id . '/checkIn'); ?>

            <div class="modal-body">
                <div class="alert alert-warning text-left"><?php echo lang('check_in_out_notice'); ?></div>

                <div class="row">
                    <?php if(empty($parents)): ?>
                    <div class="alert alert-danger">
                        <?php echo lang('no_assigned_parent_error'); ?>
                    </div>
                    <?php endif; ?>

                    <?php foreach ($parents as $p): ?>
                        <div class="col-sm-3 text-center" style="border-right:solid 1px #ccc;">
                            <input type="radio" name="in_guardian"
                                   value="<?php echo $p->first_name . ' ' . $p->last_name; ?>"
                                   style="width:30px;height:30px"/>
                            <br/>
                            <?php $this->user->getPhoto($p->user_id, 'style="width:100px"'); ?>
                            <br/>
                            <?php echo $p->first_name . ' ' . $p->last_name; ?>
                            <br/>
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <?php echo $p->phone; ?> <br/>
                            <i class="fa fa-key" aria-hidden="true"></i>
                            <?php echo $p->pin; ?>
                        </div>
                    <?php endforeach; ?>

                    <?php foreach ($authPickups as $p): ?>
                        <div class="col-sm-3 text-center" style="border-right:solid 1px #ccc;">
                            <input type="radio" name="in_guardian"
                                   value="<?php echo $p->first_name . ' ' . $p->last_name; ?>"
                                   style="width:30px;height:30px"/>
                            <br/>
                            <img style="width:100px;"
                                 src="<?php echo base_url() . 'assets/uploads/users/pickup/' . $p->photo; ?>"/>
                            <br/>
                            <?php echo $p->first_name . ' ' . $p->last_name; ?>
                            <br/>
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <?php echo $p->cell; ?> <br/>
                            <i class="fa fa-key" aria-hidden="true"></i>
                            <?php echo $p->pin; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="modal-footer">
                <span class="input-group-btn">
                        <button class="btn btn-success">
                            <?php echo lang('check_in'); ?>
                        </button>
                </span>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>