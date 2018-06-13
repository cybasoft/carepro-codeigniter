<div class="box box-solid box-warning">
    <div class="box-header">
        <div class="box-title btn-block"><?php echo lang('authorized_pickup'); ?>
            <a href="#" data-toggle="modal" data-target="#newPickupModal">
                <i class="fa fa-plus pull-right"></i>
                <?php echo lang('register'); ?>
            </a>
        </div>
    </div>
    <div class="box-body table-responsive">
        <?php foreach ($pickups as $pickup) : ?>
            <table class="table-bordered" style="width:220px;float:left;margin-right:10px;">
                <tr>
                    <td valign="top" style="position: relative;">
                        <?php if(is_file(APPPATH.'../assets/uploads/users/pickup/'.$pickup->photo)): ?>
                            <img  style="width:100px;height:120px"
                                 src="<?php echo base_url(); ?>assets/uploads/users/pickup/<?php echo $pickup->photo; ?>"/>
                        <?php else: ?>
                            <img  style="width:100px;height:120px"
                                 src="<?php echo base_url('assets/img/content/no-image.png'); ?>"/>
                        <?php endif; ?>
                        <span style="position: absolute;top:0;left:0;background:#cc4868;padding:0 2px;color:#fff;font-size:12px">
                        <span class="fa fa-lock"></span>
                        <?php echo $pickup->pin; ?></span>
                    </td>
                    <td valign="top">
                        <strong class="">
                            <?php echo $pickup->last_name.', '.$pickup->first_name; ?>
                            <?php if(is('admin') || is('manager')): ?>
                                <a href="<?php echo site_url('child/deletePickup/'.$pickup->id); ?>"
                                   class="delete">
                                    <i class="fa fa-trash-alt text-danger pull-right"></i>
                                </a>
                            <?php endif; ?>
                        </strong>
                        <br/>
                        <i><?php echo $pickup->relation; ?></i>
                        <br/>
                        <span class="fa fa-phone"></span>
                        <?php echo $pickup->cell; ?>
                        <br/>
                        <span class="fa fa-phone"></span>
                        <?php echo $pickup->other_phone; ?>
                        <br/>
                        <span class="fa fa-envelope"></span>
                        <?php echo $pickup->address; ?>
                    </td>
                </tr>
            </table>
        <?php endforeach; ?>
    </div>
</div>
<div class="modal fade" id="newPickupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"><?php echo lang('authorized_pickup'); ?></h4>
            </div>

            <?php echo form_open_multipart('child/'.$child->id.'/pickup') ?>
            <div class="modal-body">
                <label><?php echo lang('first_name'); ?></label>
                <input class="form-control" type="text" name="first_name"
                       placeholder="<?php echo lang('first_name'); ?>"
                       required=""/>
                <label><?php echo lang('last_name'); ?></label>
                <input class="form-control"
                       type="text"
                       name="last_name"
                       placeholder="<?php echo lang('last_name'); ?>"
                       required=""/>

                <label><?php echo lang('cellphone'); ?></label>
                <input class="form-control"
                       type="text"
                       name="cell"
                       placeholder="<?php echo lang('cellphone'); ?>"
                       required=""/>

                <label><?php echo lang('other_phone'); ?></label>
                <input class="form-control"
                       type="text"
                       name="other_phone"
                       placeholder="<?php echo lang('other_phone'); ?>"/>

                <label><?php echo lang('relation'); ?></label>
                <input class="form-control" type="text" name="relation"
                       placeholder="<?php echo lang('relation'); ?>" required=""/>

                <label><?php echo lang('pin'); ?></label>
                <input class="form-control"
                       type="text"
                       name="pin"
                       placeholder="<?php echo lang('pin'); ?>"
                       required=""/>

                <label><?php echo lang('address'); ?></label>
                <textarea class="form-control"
                          name="address"
                          rows="3"
                          placeholder="<?php echo lang('address'); ?>"></textarea>
                <label><?php echo lang('photo'); ?></label>
                <input class="form-control" type="file" name="userfile" size="20">
            </div>
            <div class="modal-footer">
                <button type="button"
                        class="btn btn-default"
                        data-dismiss="modal"><?php echo lang('close'); ?></button>
                <button class="btn btn-primary"><?php echo lang('submit'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>