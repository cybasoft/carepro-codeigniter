<div class="modal fade" id="registerChildModal" tabindex="-1" role="dialog" aria-labelledby="registerChildModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="registerChildModalLabel"><?php echo lang('Register child'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span  class="sr-only"><?php echo lang('close'); ?></span>
                </button>
            </div>
            <?php echo form_open('child/register'); ?>

            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <?php
                        echo form_label(lang('nickname'));
                        echo form_input('nickname', set_value('nickname'), ['class' => 'form-control', 'id' => 'nickname' ]);
                        echo form_label(lang('first_name'));
                        echo form_input('first_name',set_value('first_name'), ['class' => 'form-control','required'=>'']);
                        echo form_label(lang('last_name'));
                        echo form_input('last_name',set_value('last_name'), ['class' => 'form-control', 'required'=>'']);
                        echo form_label(lang('birthday'));
                        echo form_date('bday', set_value('bday',date('Y-m-d')), ['class' => 'form-control']);
                        echo form_label(lang('gender'));
                        echo form_dropdown('gender', ['male'=>lang('male'),'female'=>lang('female'),'other'=>lang('other')],set_value('gender'), ['class' => 'form-control']);
                        echo form_label('ID');
                        echo form_input('national_id',set_value('national_id'), ['class' => 'form-control','required'=>'' ]);
                        ?>
                    </div>
                    <div class="col-sm-6">
                        <?php
                        echo form_label(lang('blood_type'));
                        echo form_dropdown('blood_type', blood_types(),set_value('blood_type'), ['class' => 'form-control', ]);
                        echo form_label(lang('status'));
                        echo form_dropdown('status', [1=>lang('active'),0=>lang('inactive')],set_value('status'), ['class' => 'form-control', ]);
                        echo form_label(lang('Ethnicity'));
                        echo form_input('ethnicity', set_value('ethnicity'), ['class' => 'form-control', ]);
                        echo form_label(lang('religion'));
                        echo form_input('religion', set_value('religion'), ['class' => 'form-control', ]);
                        echo form_label(lang('birthplace'));
                        echo form_input('birthplace',set_value('birthplace'), ['class' => 'form-control', ]);
                        ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <?php echo lang('close'); ?>
                </button>
                <button class="btn btn-primary"><?php echo lang('submit'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
