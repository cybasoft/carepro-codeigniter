<?php $groups = $this->db->get('child_groups'); ?>
<?php if(is('admin') || is('manager')): ?>
    <div class="box box-info">
        <div class="box-body">
            <h3><?php echo lang('New children group'); ?></h3>
            <div class="row">
                <?php echo form_open('children/sstoreGroup'); ?>
                <div class="col-md-5">
                    <input type="text" name="name" class="form-control"
                           placeholder="<?php echo lang('name'); ?>" required/>
                </div>
                <div class="col-md-5">
                    <input type="text" name="description" class="form-control"
                           placeholder="<?php echo lang('description'); ?>"/>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-default"><?php echo lang('Submit'); ?></button>
                </div>
                <?php echo form_close(); ?></div>
        </div>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-md-4">

        <ul class="nav nav-pills nav-stacked">
            <?php foreach ($groups->result() as $group): ?>
                <li onclick="window.location.href='<?php echo site_url('children?group='.$group->id.'#groups'); ?>'"
                    id="<?php echo $group->id; ?>"
                    class="cursor <?php if(isset($_GET['group']) && $_GET['group'] == $group->id): ?>active-group<?php endif; ?>">
                    <div class="box box-info">
                        <div class="box-body">
                            <?php echo $group->name; ?>
                            <p style="font-size:12px;color:#ccc"><?php echo $group->description; ?></p>
                        </div>
                        <div class="box-footer">
                            <div class="row text-sm">
                                <div class="col-md-6">
                                    <span class="label label-success"><?php echo $this->user->groupCount($group->id); ?></span>
                                    <?php echo lang('staff'); ?>
                                </div>
                                <div class="col-md-6">
                                    <i class="label label-success"><?php echo $this->child->groupCount($group->id); ?></i>
                                    <?php echo lang('children'); ?>
                                </div>
                            </div>
                            <?php if(isset($_GET['group']) && $_GET['group'] == $group->id): ?>
                                <span class="arrow-right"></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <?php if(isset($_GET['group']) && $_GET['group'] !== ""): ?>
        <?php
        $cgs = $this->db->select('children.id as child_id,children.first_name,children.last_name,child_groups.name,child_groups.description,child_group.child_id,child_group.group_id')
            ->from('children')
            ->join('child_group', 'child_group.child_id=children.id')
            ->join('child_groups', 'child_groups.id=child_group.group_id')
            ->where('child_groups.id', $_GET['group'])
            ->get();
        ?>
        <?php if(count($cgs->result())>0): ?>
            <div class="col-md-4">
                <div class="box box-default">
                    <div class="box-body">
                        <h3 class="box-title"><?php echo $cgs->result()[0]->name; ?></h3>
                        <em><?php echo $cgs->result()[0]->description; ?></em>
                    </div>
                </div>
                <div class="box box-success">
                    <div class="box-body">
                        <strong><?php echo lang('assigned children'); ?></strong>
                        <ul>
                            <?php foreach ($cgs->result() as $cg): ?>
                                <li>
                                    <?php echo anchor('child/'.$cg->child_id, $cg->first_name.' '.$cg->last_name); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <div class="box box-success">
                    <div class="box-body">
                        <strong><?php echo lang('assigned staff'); ?></strong>
                        <ul>
                            <?php
                            $assignedStaff = $this->db->select('*')
                                ->from('users')
                                ->join('child_group_staff', 'child_group_staff.user_id=users.id')
                                ->where('child_group_staff.group_id', $_GET['group'])
                                ->get();
                            foreach ($assignedStaff->result() as $as): ?>
                                <li>
                                    <?php echo anchor('user/'.$as->id, $as->first_name.' '.$as->last_name); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <?php if(is('admin') || is('manager')): ?>
        <div class="col-md-4">
            <div class="box box-warning">
                <div class="box-body">
                    <h4><?php echo lang('select children to assign'); ?></h4>
                    <div style="max-height:400px;overflow-y: scroll;">
                        <?php if(isset($_GET['group']) && $_GET['group'] !== ""): ?>

                        <?php echo form_open('children/childrenToGroup'); ?>
                        <ul class="nav nav-pills nav-stacked list-unstyled">
                            <?php
                            $children = $this->db->get('children');
                            foreach ($children->result() as $c): ?>
                                <li>
                                    <input type="checkbox"
                                           name="child_id[]"
                                        <?php echo (related('child_group', 'child_id', $c->id, 'group_id', $_GET['group'])) ? 'checked' : ''; ?>
                                           value="<?php echo $c->id; ?>"/>
                                    <input type="hidden"
                                           name="group_id"
                                           value="<?php echo $_GET['group']; ?>"/>
                                    <?php echo $c->first_name.' '.$c->last_name; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <button class="btn btn-default"><?php echo lang('submit'); ?></button>
                    <?php echo form_close(); ?>
                    <?php else: ?>
                        <i class="fa fa-chevron-left"></i>
                        <?php echo lang('select a group from the list to update'); ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="box box-warning">
                <div class="box-body">
                    <h4><?php echo lang('select staff to assign'); ?></h4>
                    <div style="max-height:400px;overflow-y: scroll;">
                        <?php if(isset($_GET['group']) && $_GET['group'] !== ""): ?>

                        <?php echo form_open('children/staffToGroup'); ?>
                        <ul class="nav nav-pills nav-stacked list-unstyled">
                            <?php
                            $this->db->select('users.id,users.first_name,users.last_name,users_groups.group_id');
                            $this->db->where('group_id', 3);
                            $this->db->or_where('group_id', 1);
                            $this->db->from('users');
                            $this->db->join('users_groups', 'users_groups.user_id=users.id');
                            $staff = $this->db->get();
                            foreach ($staff->result() as $s): ?>
                                <li>
                                    <input type="checkbox"
                                           name="user_id[]"
                                        <?php echo (related('child_group_staff', 'user_id', $s->id, 'group_id', $_GET['group'])) ? 'checked' : ''; ?>
                                           value="<?php echo $s->id; ?>"/>
                                    <input type="hidden"
                                           name="group_id"
                                           value="<?php echo $_GET['group']; ?>"/>
                                    <?php echo $s->first_name.' '.$s->last_name; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <button class="btn btn-default"><?php echo lang('submit'); ?></button>
                    <?php echo form_close(); ?>
                    <?php else: ?>
                        <i class="fa fa-chevron-left"></i>
                        <?php echo lang('select a group from the list to update'); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>