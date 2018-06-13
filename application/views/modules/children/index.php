<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">

<div class="row">
    <div class="col-md-4">
        <?php echo form_open('children', 'class="input-group"'); ?>
        <input type="text" name="search" class="form-control" placeholder="<?php echo lang('search'); ?>..."/>
        <span class="input-group-btn">
            <button class="btn btn-default">
                <span class="fa fa-search"></span>
			</button>
        </span>
        <?php echo form_close(); ?>
    </div>
    <div class="col-md-3">

        <div style="width:200px">
            <div class="input-group date">
                <input data-provide="datepicker" data-date="<?php echo date('m/d/Y'); ?>" type="text"
                       class="form-control datepicker" value="<?php echo date('m/d/Y'); ?>">
                <div class="input-group-addon">
                    <a target="_blank" class="" onclick="getReport()">
                        <span class="fa fa-print"></span>
                        <?php echo lang('daily roster'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <a href="<?php echo site_url('children/roster?active'); ?>" target="_blank"
           class="btn btn-success btn-flat btn-sm">
            <span class="fa fa-print"></span>
            <?php echo lang('active'); ?>
        </a>
        <a href="<?php echo site_url('children/roster?inactive'); ?>" target="_blank"
           class="btn btn-danger btn-flat btn-sm">
            <span class="fa fa-print"></span>
            <?php echo lang('inactive'); ?>
        </a>
        <a href="<?php echo site_url('children/roster?active'); ?>" target="_blank"
           class="btn btn-warning btn-flat btn-sm">
            <span class="fa fa-print"></span>
            <?php echo lang('print all'); ?>
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
        <li role="presentation">
            <a href="#groups" aria-controls="groups" role="tab" data-toggle="tab">
                <i class="fa fa-group"></i> <?php echo lang('Child groups'); ?>
            </a>
        </li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="active">
            <?php
            $this->db->where('status', 1);
            if($this->input->post('search')) {
                $this->db->like('last_name', $this->input->post('search'));
                $this->db->or_like('first_name', $this->input->post('search'));
            }
            $activeChildren = $this->db->get('children')->result();
            ?>
            <?php if(!empty($activeChildren)): ?>
                <div class="clearfix">
                    <?php foreach ($activeChildren as $row): ?>
                        <?php if($this->child->is_checked_in($row->id)) continue; ?>
                        <div class="children-thumbs cursor">
                            <div class="children-thumb"
                                 onclick="window.location.href='<?php echo site_url('child/'.$row->id); ?>'"
                                 style="background-image: url('<?php echo $row->photo == "" ? base_url().'assets/img/content/no-image.png' : base_url().'assets/uploads/users/children/'.$row->photo; ?>');">
                                <?php if($this->child->countAllergies($row->id)>0): ?>
                                    <i class="fa fa-heart text-danger i-check-icons i-check-allergy"></i>
                                <?php endif; ?>
                                <?php if($this->child->countMeds($row->id)>0): ?>
                                    <i class="fa fa-medkit text-danger i-check-icons i-check-med"></i>
                                <?php endif; ?>
                                <?php if(!authorizedToChild($this->user->uid(), $row->id)): ?>
                                    <i class="fa fa-lock text-danger pull-right fa-2x"></i>
                                <?php endif; ?>
                                <span class="child-dob"> <?php echo format_date($row->bday, false); ?></span>
                                <span class="child-id">ID:
                                    <?php echo decrypt($row->national_id); ?></span>
                            </div>
                            <div class="child-info">
                                <a href="<?php echo site_url('/child/'.$row->id); ?>">
                                    <?php echo $row->last_name.', '.$row->first_name; ?>
                                </a>
                            </div>
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
                        </div>
                    <?php endforeach; ?>
                    <div class="clearfix"></div>
                    <hr/>
                    <?php foreach ($activeChildren as $row): ?>
                        <?php if(!$this->child->is_checked_in($row->id)) continue; ?>
                        <div class="children-thumbs cursor">
                            <div class="children-thumb"
                                 onclick="window.location.href='<?php echo site_url('child/'.$row->id); ?>'"
                                 style="background-image: url('<?php echo $row->photo == "" ? base_url().'assets/img/content/no-image.png' : base_url().'assets/uploads/users/children/'.$row->photo; ?>');">
                                <?php if($this->child->countAllergies($row->id)>0): ?>
                                    <i class="fa fa-heart text-danger i-check-icons i-check-allergy"></i>
                                <?php endif; ?>
                                <?php if($this->child->countMeds($row->id)>0): ?>
                                    <i class="fa fa-medkit text-danger i-check-icons i-check-med"></i>
                                <?php endif; ?>
                                <?php if(!authorizedToChild($this->user->uid(), $row->id)): ?>
                                    <i class="fa fa-lock text-danger pull-right fa-2x"></i>
                                <?php endif; ?>
                                <span class="child-dob"> <?php echo format_date($row->bday, false); ?></span>
                                <span class="child-id">ID:
                                    <?php echo decrypt($row->national_id); ?></span>
                            </div>
                            <div class="child-info">
                                <a href="<?php echo site_url('/child/'.$row->id); ?>">
                                    <?php echo $row->last_name.', '.$row->first_name; ?>
                                </a>
                            </div>
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
                        </div>
                    <?php endforeach; ?>

                </div>
            <?php else: ?>
                <a href="<?php echo site_url('children'); ?>" class="btn btn-primary"><i
                            class="fa fa-chevron-left"></i> <?php echo lang('back'); ?></a>
                <hr/>
                <div class="alert alert-danger">
                    <i class="fa fa-exclamation-triangle"></i> <?php echo lang('no_results_found'); ?></div>
            <?php endif; ?>
            <div class="clearfix"><br/></div>
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
            <?php if(!empty($inactiveChildren)): ?>
                <div class="clearfix">
                    <?php foreach ($inactiveChildren as $row): ?>
                        <div class="children-thumbs cursor">
                            <div class="children-thumb"
                                 onclick="window.location.href='<?php echo site_url('child/'.$row->id); ?>'"
                                 style="background-image: url('<?php echo $row->photo == "" ? base_url().'assets/img/content/no-image.png' : base_url().'assets/uploads/users/children/'.$row->photo; ?>');">
                                <span class="child-dob"> <?php echo format_date($row->bday, false); ?></span>
                                <span class="child-id">ID:
                                    <?php echo decrypt($row->national_id); ?></span>
                            </div>
                            <div class="child-info">
                                <a href="<?php echo site_url('/child/'.$row->id); ?>">
                                    <?php echo $row->last_name.', '.$row->first_name; ?>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <a href="<?php echo site_url('children'); ?>" class="btn btn-primary"><i
                            class="fa fa-chevron-left"></i> <?php echo lang('back'); ?></a>
                <hr/>
                <div class="alert alert-danger">
                    <i class="fa fa-exclamation-triangle"></i> <?php echo lang('no_results_found'); ?></div>
            <?php endif; ?>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="register">
            <?php $this->load->view('modules/children/register'); ?>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="groups">
            <?php $this->load->view('modules/children/groups'); ?>
        </div>
    </div>
</div>

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

    function getReport() {
        var d = $(".datepicker").datepicker('getDate');
        var datestring = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + (d.getDate());
        window.open('<?php echo site_url('children/roster?daily&date='); ?>' + datestring);
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>