<div class="box box-solid box-warning">
    <div class="box-header">
        <div class="box-title btn-block"><?php echo lang('authorized_pickup'); ?>
            <a href="#" data-toggle="modal" data-target="#newPickupModal"><i class="fa fa-plus pull-right"></i></a>
        </div>
    </div>
    <div class="box-body table-responsive">

        <table class="table table-bordered parent-info">
            <?php foreach ($pickups as $pickup) : ?>
                <tr>
                    <td class="col-sm-4">
                        <div data-toggle="modal" data-target="#new-pickup-photo">
                            <?php
                            if ($pickup->photo !== "") {
                                echo '<img class="img-responsive img-thumbnail"
         src="' . base_url() . 'assets/img/users/pickup/' . $pickup->photo . '"/>';

                            } else {
                                echo '<img class="img-circle img-responsive img-thumbnail"
         src="' . base_url('assets/img/content/no-image.png') . '/>';
                            }
                            ?>

                        </div>
                    </td>
                    <td>
                        <h3 class=""><?php echo $pickup->lname . ', ' . $pickup->fname; ?>
                            <a href="<?php echo site_url('child/deletePickup/' . $pickup->id); ?>"
                               class="delete">
                                <i class="fa fa-trash-o text-danger pull-right"></i>
                            </a>
                        </h3>
                        <h4><?php echo $pickup->relation; ?></h4>

                        <table>
                            <tr>
                                <td>
                                    <span class="fa fa-phone"></span>
                                    <?php echo $pickup->cell; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="fa fa-phone"></span>
                                    <?php echo $pickup->other_phone; ?>
                                </td>
                            </tr>

                        </table>

                        <table>
                            <tr>
                                <td><span class="fa fa-envelope"> </span></td>
                                <td>
                                    <div class="parent-address">
                                        <?php
                                        echo $pickup->address;
                                        ?>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="fa fa-lock"></span></td>
                                <td class="label label-danger">
                                    <?php echo $pickup->pin; ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

    </div>
</div>
<div class="modal fade" id="newPickupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"><?php echo lang('authorized_pickup'); ?></h4>
            </div>

            <?php echo form_open_multipart('child/' . $child->id . '/pickup') ?>
            <div class="modal-body">
                <label><?php echo lang('first_name'); ?></label>
                <input class="form-control" type="text" name="fname"
                       placeholder="<?php echo lang('first_name'); ?>"
                       required=""/>
                <label><?php echo lang('last_name'); ?></label>
                <input class="form-control" type="text" name="lname"
                       placeholder="<?php echo lang('last_name'); ?>"
                       required=""/>

                <label><?php echo lang('cellphone'); ?></label>
                <input class="form-control" type="text" name="cell"
                       placeholder="<?php echo lang('cellphone'); ?>"
                       required=""/>

                <label><?php echo lang('other_phone'); ?></label>
                <input class="form-control" type="text" name="other_phone"
                       placeholder="<?php echo lang('other_phone'); ?>"/>

                <label><?php echo lang('relation'); ?></label>
                <input class="form-control" type="text" name="relation"
                       placeholder="<?php echo lang('relation'); ?>" required=""/>

                <label><?php echo lang('pin'); ?></label>
                <input class="form-control" type="text" name="pin" placeholder="<?php echo lang('pin'); ?>"
                       required=""/>

                <label><?php echo lang('address'); ?></label>
                <textarea class="form-control" name="address" rows="3"
                          placeholder="<?php echo lang('address'); ?>"></textarea>
                <label><?php echo lang('photo'); ?></label>
                <input class="form-control" type="file" name="userfile" size="20">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('close'); ?></button>
                <button class="btn btn-primary"><?php echo lang('submit'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>