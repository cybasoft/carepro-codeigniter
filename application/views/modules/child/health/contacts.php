<h2>
    <?php echo lang('emergency_contacts'); ?>
    <button data-toggle="modal" data-target="#newContact" class="btn btn-primary pull-right">
        <i class="fa fa-plus"></i> <?php echo lang('new'); ?>
    </button>
</h2>
<table class="table table-responsive">
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
                <?php if (!is('parent')): ?>
                    <a class="delete" href="<?php echo site_url('child/deleteContact/' . $row->id); ?>">
                        <i class="fa fa-trash-o"></i>
                    </a>
                <?php endif; ?>
            </td >
        </tr>
    <?php endforeach; ?>
</table>


<div class="modal fade" id="newContact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    <?php echo lang('new_contact'); ?>
                </h4>
            </div>
            <?php echo form_open('child/addContact'); ?>
            <div class="modal-body">
                <?php echo form_hidden('child_id', $child->id); ?>
                <input type="text" name="name" class="form-control" required placeholder="<?php echo lang('name'); ?>"/>
                <br/>
                <input type="text" name="relation" class="form-control" required
                       placeholder="<?php echo lang('relation'); ?>"/>
                <br/>
                <input type="text" name="phone" class="form-control" required
                       placeholder="<?php echo lang('phone'); ?>"/>
                <br/>
                <input type="text" name="address" class="form-control" required
                       placeholder="<?php echo lang('address'); ?>"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <?php echo lang('close'); ?>
                </button>
                <button class="btn btn-primary">
                    <?php echo lang('submit'); ?>
                </button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
