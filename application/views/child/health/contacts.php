<div class="card">
	<div class="card-header">
		<h4 class="card-title">
            <?php echo lang('emergency_contacts'); ?>
            <button data-toggle="modal" data-target="#newContact" class="btn btn-success btn-sm card-tools">
                <i class="fa fa-plus-circle"></i> <?php echo lang('Add new'); ?>
            </button>
        </h4>
	</div>
	<div class="card-body">

        <table class="table ">
            <th><?php echo lang('name'); ?></th>
            <th><?php echo lang('relation'); ?></th>
            <th><?php echo lang('phone'); ?></th>
            <th><?php echo lang('address'); ?></th>
            <th></th>
            <?php $query = $this->db->where('child_id', $child->id)->get('child_contacts');
            foreach ($query->result() as $row): ?>
                <tr>
                    <td><?php echo $row->contact_name; ?></td>
                    <td><?php echo $row->relation; ?></td>
                    <td><?php echo $row->phone; ?></td>
                    <td><?php echo $row->address; ?></td>
                    <td>
                        <?php if(!is('parent')): ?>
                            <a class="delete" href="<?php echo site_url('child/deleteContact/'.$row->id); ?>">
                                <i class="fa fa-trash-alt"></i>
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
	</div>
</div>


<div class="modal fade" id="newContact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">
                    <?php echo lang('new_contact'); ?>
                </h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span  class="sr-only"><?php echo lang('close'); ?></span>
                </button>
            </div>
            <?php echo form_open('child/addContact'); ?>
            <div class="modal-body">
                <?php

                echo form_hidden('child_id', $child->id);

                echo form_label(lang('name'));
                echo form_input('name', null, ['class' => 'form-control', 'required' => '']);

                echo form_label(lang('Relation'));
                echo form_input('relation', null, ['class' => 'form-control', 'required' => '']);

                echo form_label(lang('Phone'));
                echo form_input('phone', null, ['class' => 'form-control', 'required' => '']);

                echo form_label(lang('Address'));
                echo form_textarea('address', null, ['class' => 'form-control']);
                ?>
            </div>
            <div class="modal-footer">
                <?php

                echo form_button(
                    [
                        'type' => 'submit',
                        'class' => 'btn btn-primary'
                    ], lang('submit'));
                echo form_button(
                    [
                        'data-dismiss' => 'modal',
                        'class' => 'btn btn-default'
                    ], lang('close'));
                ?>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
