<div class="box box-solid box-warning">
    <div class="box-header">
        <div class="box-title btn-block">
            <?php echo lang('authorized_pickup'); ?>
            <a href="#" data-toggle="modal" data-target="#newPickupModal">
                <i class="fa fa-plus pull-right"></i>
            </a>
        </div>
    </div>
    <div class="box-body">
        <?php foreach ($pickups as $pickup) : ?>
        <div class="info-box">
            <div class="info-box-img" style="margin-right:10px;">
                <?php if (is_file(APPPATH . '../assets/uploads/pickup/' . $pickup->photo)): ?>
                <img style="width:100px;" class="img-rounded" src="<?php echo base_url(); ?>assets/uploads/pickup/<?php echo $pickup->photo; ?>" />
                <?php else: ?>
                <img style="width:100px;" class="img-rounded" src="<?php echo base_url('assets/img/content/no-image.png'); ?>" />
                <?php endif; ?>
            </div>
            <div class="info-box-content">
                <?php if (is(['admin', 'manager'])): ?>
                <a class="btn btn-danger btn-xs pull-right delete" href="<?php echo site_url('child/deletePickup/' . $pickup->id); ?>">
                    <i class="fa fa-trash-alt"></i>
                </a>
                <?php endif; ?>

                <h3 style="padding:0;margin:0;margin-top:-8px;">
                    <?php echo $pickup->last_name . ', ' . $pickup->first_name; ?>
                </h3>

                <div class="info-box-text" style="margin-bottom:5px;">
                    <?php echo $pickup->relation; ?> |
                    <span class="label label-danger">
                        <span class="fa fa-lock"></span>
                        <?php echo $pickup->pin; ?>
                    </span>
                </div>
                <div class="info-box-light text-danger">

                </div>

                <div class="info-box-text">
                    <span class="fa fa-phone"></span>
                    <?php echo $pickup->cell; ?>
                </div>

                <?php if (!empty($pickup->other_phone)): ?>
                <div class="info-box-text">
                    <span class="fa fa-phone"></span>
                    <?php echo $pickup->other_phone; ?>
                </div>
                <?php endif; ?>

                <?php if (!empty($pickup->address)): ?>
                <div class="info-box-text">
                    <span class="fa fa-envelope"></span>
                    <?php echo $pickup->address; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="modal fade" id="newPickupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    <?php echo lang('authorized_pickup'); ?>
                </h4>
            </div>

            <?php echo form_open_multipart('child/' . $child->id . '/pickup') ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <?php echo form_label(lang('first_name'));
                        echo form_input('first_name', null, ['class' => 'form-control', 'required' => '']);
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo form_label(lang('last_name'));
                        echo form_input('last_name', null, ['class' => 'form-control', 'required' => '']);
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?php echo form_label(lang('cellphone'));
                        echo form_input('cell', null, ['class' => 'form-control', 'required' => '']);
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo form_label(lang('other_phone'));
                        echo form_input('other_phone', null, ['class' => 'form-control']);
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?php echo form_label(lang('relation'));
                        echo form_input('relation', null, ['class' => 'form-control', 'required' => '']);
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo form_label(lang('pin'));
                        echo form_input('pin', null, ['class' => 'form-control', 'required' => '']);
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?php echo form_label(lang('address'));
                        echo form_textarea('address', null, ['class' => 'form-control', 'cols' => 3]);
                        ?>
                    </div>
                    <div class="col-md-6">
                        <?php echo form_label(lang('photo'));
                        echo form_upload('photo', ['class' => 'form-control', ]);
                        ?>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <?php echo lang('close'); ?></button>
                <button class="btn btn-primary">
                    <?php echo lang('submit'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
