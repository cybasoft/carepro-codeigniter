<div class="modal fade" id="updateChildModal" tabindex="-1" role="dialog" aria-labelledby="updateChildModalLabel">
    <div class="modal-dialog" role="document">
        <?php echo form_open('child/'.$child->id); ?>
        <?php echo form_hidden('child_id', $child->id); ?>
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title"
                    id="updateChildModalLabel"><?php echo $child->first_name.' '.$child->last_name; ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <?php echo form_label(lang('nickname'));
                        echo form_input('nickname', $child->nickname, ['class' => 'form-control' ]);
                        echo form_label(lang('first_name'), 'first_name', ['class' => 'required']);
                        echo form_input('first_name', $child->first_name, ['class' => 'form-control','required'=>'', 'id' => 'first_name']);
                        echo form_label(lang('last_name'), 'last_name', ['class' => 'required']);
                        echo form_input('last_name', $child->last_name, ['class' => 'form-control', 'required'=>'', 'id' => 'last_name']);
                        echo form_label(lang('birthday'));
                        echo form_date('bday', date('Y-m-d', strtotime($child->bday)), ['class' => 'form-control']);
                        echo form_label(lang('gender'));
                        echo form_dropdown('gender', ['male'=>lang('male'),'female'=>lang('female'),'other'=>lang('other')],$child->gender, ['class' => 'form-control', 'required'=>'']);
                        echo form_label('ID', 'national_id', ['class' => 'required']);
                        echo form_input('national_id', decrypt($child->national_id), ['class' => 'form-control', 'required'=> '', 'id' => 'national_id']);
                        ?>
                    </div>
                    <div class="col-sm-6">
                        <?php
                        echo form_label(lang('blood_type'));
                        echo form_dropdown('blood_type', blood_types(),$child->blood_type, ['class' => 'form-control', ]);
                        echo form_label(lang('status'));
                        echo form_dropdown('status', [1=>lang('active'),0=>lang('inactive')],$child->status, ['class' => 'form-control', ]);
                        echo form_label(lang('Ethnicity'));
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