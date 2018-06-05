<div class="row">
    <div class="col-md-4 col-sm-6">
        <?php echo form_open('children', 'class="input-group"'); ?>
        <input type="text" name="search" class="form-control" placeholder="<?php echo lang('search'); ?>..."/>
        <span class="input-group-btn">
            <button class="btn btn-default">
                <span class="fa fa-search"></span>
			</button>
        </span>
        <?php echo form_close(); ?>
    </div>
    <div class="col-md-4 col-sm-6 text-right">
        <a href="<?php echo site_url('children/roster'); ?>" target="_blank" class="btn btn-warning btn-flat">
            <span class="fa fa-print"></span>
            <?php echo lang('children_roster'); ?>
        </a>
    </div>
</div>
<hr/>
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li role="presentation" class="active">
            <a href="#active" aria-controls="active" role="tab" data-toggle="tab">
                <span class="badge badge-info"><?php echo $this->child->getCount(); ?></span>
                <?php echo lang('active_children'); ?>
            </a>
        </li>
        <li role="presentation">
            <a href="#inactive" aria-controls="inactive" role="tab" data-toggle="tab">
                <span class="badge badge-info"><?php echo $this->child->getCount(false); ?></span>
                <?php echo lang('inactive_children'); ?>
            </a>
        </li>
        <li role="presentation">
            <a href="#register" aria-controls="register" role="tab" data-toggle="tab">
               <i class="fa fa-plus"></i> <?php echo lang('register'); ?>
            </a>
        </li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="active">
            <?php
            if($this->input->post('search')) {
                $this->db->like('last_name', $this->input->post('search'));
                $this->db->or_like('first_name', $this->input->post('search'));
            }
            $this->db->where('status', 1);
            $activeChildren = $this->db->get('children')->result();
            ?>
            <div class="row">
                <?php if(!empty($activeChildren)): ?>
                    <?php foreach ($activeChildren as $row): ?>
                        <div class="col-sm-4">
                            <table class="table table-bordered">
                                <tr>
                                    <td class="cursor"
                                        onclick="window.location.href='<?php echo site_url('child/'.$row->id); ?>'">
                                        <?php
                                        if($row->photo !== "") {
                                            echo '<img class=""
         src="'.base_url().'assets/uploads/users/children/'.$row->photo.'" style="width: 120px; height:120px"/>';
                                        } else {
                                            echo '<img class="img-circle"
         src="'.base_url().'assets/img/content/no-image.png" style="width: 120px; height:120px"/>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <h4>
                                            <a href="<?php echo site_url('/child/'.$row->id); ?>">
                                                <?php echo $row->last_name.', '.$row->first_name; ?>
                                            </a>
                                        </h4>
                                        ID:
                                        <?php echo decrypt($row->national_id); ?>
                                        <br/>
                                        <?php echo lang('birthday'); ?>:
                                        <?php echo format_date($row->bday, false); ?> <br/>

                                        <hr/>
                                        <?php if($this->child->is_checked_in($row->id) == 1) : ?>
                                            <a id="<?php echo $row->id; ?>" href="#"
                                               class="btn btn-danger btn-flat btn-sm child-check-out">
                                                <span class="fa fa-new-window"></span>
                                                <?php echo lang('check_out'); ?>
                                            </a>
                                        <?php else : ?>
                                            <a id="<?php echo $row->id; ?>" href="#"
                                               class="btn btn-primary btn-flat btn-sm child-check-in">
                                                <span class="fa fa-check"></span>
                                                <?php echo lang('check_in').' &nbsp; '; ?>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <a href="<?php echo site_url('children'); ?>" class="btn btn-primary"><i
                                class="fa fa-chevron-left"></i> <?php echo lang('back'); ?></a>
                    <hr/>
                    <div class="alert alert-danger">
                        <i class="fa fa-exclamation-triangle"></i> <?php echo lang('no_results_found'); ?></div>
                <?php endif; ?>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="inactive">
            <?php
            if($this->input->post('search')) {
                $this->db->like('last_name', $this->input->post('search'));
                $this->db->or_like('first_name', $this->input->post('search'));
            }
            $this->db->where('status', 0);
            $inactiveChildren = $this->db->get('children')->result();
            ?>
            <div class="row">
                <?php if(!empty($inactiveChildren)): ?>
                    <?php foreach ($inactiveChildren as $row): ?>
                        <div class="col-sm-4">
                            <table class="table table-bordered">
                                <tr>
                                    <td class="cursor"
                                        onclick="window.location.href='<?php echo site_url('child/'.$row->id); ?>'">
                                        <?php
                                        if($row->photo !== "") {
                                            echo '<img class=""
         src="'.base_url().'assets/uploads/users/children/'.$row->photo.'" style="width: 120px; height:120px"/>';
                                        } else {
                                            echo '<img class="img-circle"
         src="'.base_url().'assets/img/content/no-image.png" style="width: 120px; height:120px"/>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <h4>
                                            <a href="<?php echo site_url('/child/'.$row->id); ?>">
                                                <?php echo $row->last_name.', '.$row->first_name; ?>
                                            </a>
                                        </h4>
                                        ID:
                                        <?php echo decrypt($row->national_id); ?>
                                        <br/>
                                        <?php echo lang('birthday'); ?>:
                                        <?php echo format_date($row->bday, false); ?> <br/>

                                        <hr/>
                                        <?php if($this->child->is_checked_in($row->id) == 1) : ?>
                                            <a id="<?php echo $row->id; ?>" href="#"
                                               class="btn btn-danger btn-flat btn-sm child-check-out">
                                                <span class="fa fa-new-window"></span>
                                                <?php echo lang('check_out'); ?>
                                            </a>
                                        <?php else : ?>
                                            <a id="<?php echo $row->id; ?>" href="#"
                                               class="btn btn-primary btn-flat btn-sm child-check-in">
                                                <span class="fa fa-check"></span>
                                                <?php echo lang('check_in').' &nbsp; '; ?>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <a href="<?php echo site_url('children'); ?>" class="btn btn-primary"><i
                                class="fa fa-chevron-left"></i> <?php echo lang('back'); ?></a>
                    <hr/>
                    <div class="alert alert-danger">
                        <i class="fa fa-exclamation-triangle"></i> <?php echo lang('no_results_found'); ?></div>
                <?php endif; ?>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="register">
            <?php $this->load->view('modules/children/register'); ?>
        </div>
    </div>
</div>
<hr/>

<div class="my_modal"></div>

<script type="text/javascript">
    $('.child-check-in').click(function () {
        var child_id = $(this).attr('id');
        $('.my_modal').load('<?php echo site_url('child'); ?>/' + child_id + '/checkIn').modal();
    });
    $('.child-check-out').click(function () {
        var child_id = $(this).attr('id');
        $('.my_modal').load('<?php echo site_url('child'); ?>/' + child_id + '/checkOut').modal();
    });

</script>