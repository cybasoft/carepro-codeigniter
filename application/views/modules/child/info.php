<div class="box box-info box-solid">
    <div class="box-header">
        <h3 class="box-title"><?php echo sprintf(lang('child_page_heading'), $child->first_name.' '.$child->last_name); ?></h3>
        <div class="box-tools pull-right">
            <?php if(is('admin') || is('staff')): ?>
                <a href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#updateChildModal"><span
                            class="fa fa-pencil-alt"></span>
                </a>
            <?php endif; ?>
        </div>
    </div>
    <div class="box-body table-responsive">
        <?php if(!empty($child->nickname)): ?>
            <div class="row text-primary">
                <div class="col-md-6">
                    <strong><?php echo lang('nickname'); ?></strong>:
                    <?php echo $child->nickname; ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-6">
                <strong><?php echo lang('name'); ?></strong>:
                <?php echo $child->first_name.' '.$child->last_name; ?>
            </div>
            <div class="col-md-6">
                <strong><?php echo lang('date_of_birth'); ?></strong>:
                <?php echo format_date($child->bday, false); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <strong><?php echo lang('national_id'); ?></strong>:
                <?php echo decrypt($child->national_id); ?>
            </div>
            <div class="col-md-6">
                <strong><?php echo lang('gender'); ?></strong>:
                <?php echo $child->gender; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <strong><?php echo lang('blood_type'); ?></strong>:
                <?php echo $child->blood_type; ?>
            </div>
            <div class="col-md-6">
                <strong><?php echo lang('ethnicity'); ?></strong>:
                <?php echo $child->ethnicity; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <strong><?php echo lang('religion'); ?></strong>:
                <?php echo $child->religion; ?>
            </div>
            <div class="col-md-6">
                <strong><?php echo lang('birthplace'); ?></strong>:
                <?php echo $child->birthplace; ?>
            </div>
        </div>
    </div>
</div>
<?php if(is('admin') || is('staff')): ?>
    <div class="modal fade" id="updateChildModal" tabindex="-1" role="dialog" aria-labelledby="updateChildModalLabel">
        <div class="modal-dialog" role="document">
            <?php echo form_open('child/'.$child->id); ?>
            <?php echo form_hidden('child_id', $child->id); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"
                        id="updateChildModalLabel"><?php echo $child->first_name.' '.$child->last_name; ?></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <?php echo form_label(lang('nickname'));
                            echo form_input('nickname', $child->nickname, ['class' => 'form-control' ]);
                            echo form_label(lang('first_name'));
                            echo form_input('first_name', $child->first_name, ['class' => 'form-control','required'=>'']);
                            echo form_label(lang('last_name'));
                            echo form_input('last_name', $child->last_name, ['class' => 'form-control', 'required'=>'']);
                            echo form_label(lang('birthday'));
                            echo form_date('bday', date('Y-m-d', strtotime($child->bday)), ['class' => 'form-control']);
                            echo form_label(lang('gender'));
                            echo form_dropdown('gender', ['male'=>lang('male'),'female'=>lang('female'),'other'=>lang('other')],$child->gender, ['class' => 'form-control', 'required'=>'']);
                            echo form_label(lang('ID'));
                            echo form_input('national_id', decrypt($child->national_id), ['class' => 'form-control', 'required'=>'' ]);
                            ?>
                        </div>
                        <div class="col-sm-6">
                            <?php
                            echo form_label(lang('blood_type'));
                            echo form_dropdown('blood_type', blood_types(),$child->blood_type, ['class' => 'form-control', ]);
                            echo form_label(lang('status'));
                            echo form_dropdown('status', [1=>lang('active'),0=>lang('inactive')],$child->status, ['class' => 'form-control', ]);
                            echo form_label(lang('ethnicity'));
                            echo form_input('ethnicity', $child->ethnicity, ['class' => 'form-control', ]);
                            echo form_label(lang('religion'));
                            echo form_input('religion', $child->religion, ['class' => 'form-control', ]);
                            echo form_label(lang('birthplace'));
                            echo form_input('birthplace', $child->birthplace, ['class' => 'form-control', ]);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <?php echo lang('close'); ?>
                    </button>
                    <button class="btn btn-primary"><?php echo lang('update'); ?></button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
<?php endif; ?>