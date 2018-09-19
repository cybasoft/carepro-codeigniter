<div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="newUserModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="newUserModal"><?php echo lang('Register user'); ?></h4>
            </div>
            <?php echo form_open("users/create"); ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-6">
                            <?php
echo form_label(lang('first_name'));
echo form_input('first_name', set_value('first_name'), ['class' => 'form-control', 'required' => '']);
echo form_label(lang('last_name'));
echo form_input('last_name', set_value('last_name'), ['class' => 'form-control', 'required' => '']);
echo form_label(lang('email'));
echo form_email('email', set_value('email'), ['class' => 'form-control', 'required' => '']);
echo form_label(lang('phone'));
echo form_input('phone', set_value('phone'), ['class' => 'form-control', 'required' => '']);
echo form_label(lang('password'));
echo form_password('password', '', ['class' => 'form-control', 'required' => '']);
echo form_label(lang('password_confirm'));
echo form_password('password_confirm', '', ['class' => 'form-control', 'required' => '']);
?>
                        </div>

                        <div class="col-lg-6">
                            <?php echo form_label(lang('roles')); ?>
                            <?php foreach ($this->db->get('groups')->result() as $group): ?>
                                <label class="check"><?php echo lang($group->name); ?>
                                    <?php echo form_radio('group', $group->id, set_radio('group', $group->id, true)); ?>
                                    <span class="checkmark"></span>
                                </label>
                            <?php endforeach?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary"><?php echo lang('submit'); ?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>