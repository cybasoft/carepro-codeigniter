<div class="modal show" id="check-in">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only"><?php echo lang('close'); ?></span></button>
                <h2 class="modal-title" id="myModalLabel"><?php echo lang('check_in'); ?></h2>
            </div>
            <?php echo form_open('child/'.$child_id.'/checkIn'); ?>
            <div class="modal-body">
                <div class="alert alert-warning text-left">
                    <?php echo lang('check_in_out_notice'); ?>
                </div>
                <?php if(empty($parents)): ?>
                    <div class="alert alert-danger">
                        <?php echo lang('no_assigned_parent_error'); ?>
                    </div>
                <?php endif; ?>

                <div class="row">
                    <?php foreach ($parents as $p): ?>
                        <div class="col-md-3">
                            <div class=" i-check">
                                <label for="check-<?php echo $p->id; ?>">
                                    <input type="radio" id="check-<?php echo $p->id; ?>" name="in_guardian"
                                           value="<?php echo $p->first_name.' '.$p->last_name; ?>"
                                           data-keeper-edited="yes" data-keeper-should-not-overwrite="true">
                                    <div class="front-end i-check-box"
                                         style="background-image:url('<?php echo $this->user->getPhoto($p->user_id); ?>')">
                                        <span class="i-check-name"><?php echo $p->first_name.' '.$p->last_name; ?></span>
                                        <br/>
                                        <span class="i-check-pin"><i class="fa fa-lock"></i> <?php echo $p->pin; ?></span>
                                        <br/>
                                        <span class="i-check-phone"><i class="fa fa-phone"></i> <?php echo $p->phone; ?></span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <?php foreach ($authPickups as $p): ?>
                        <div class="col-md-3">
                            <div class="i-check">
                                <label for="check-<?php echo $p->id; ?>">
                                    <input type="radio" id="check-<?php echo $p->id; ?>" name="in_guardian"
                                           value="<?php echo $p->first_name.' '.$p->last_name; ?>"
                                           data-keeper-edited="yes" data-keeper-should-not-overwrite="true">
                                    <div class="front-end i-check-box"
                                         style="background-image: url('<?php echo base_url().'assets/uploads/users/pickup/'.$p->photo; ?>');">
                                        <span class="i-check-name"><?php echo $p->first_name.' '.$p->last_name; ?></span>
                                        <br/>
                                        <span class="i-check-pin"><i class="fa fa-lock"></i> <?php echo $p->pin; ?></span>
                                        <br/>
                                        <span class="i-check-phone"><i class="fa fa-phone"></i> <?php echo $p->cell; ?></span>
                                    </div>
                                </label>
                            </div>
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