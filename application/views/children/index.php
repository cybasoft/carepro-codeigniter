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
        <button type="button" data-toggle="popover"
                class="popover-toggle btn btn-lg btn-danger btn-sm btn-flat reportsBtn">
            <i class="fa fa-clipboard-list"></i> <?php echo lang('reports'); ?></button>
    </div>
    <div class="col-md-5">
        <a href="<?php echo site_url('reports/roster?active'); ?>" target="_blank"
           class="btn btn-success btn-flat btn-sm">
            <span class="fa fa-print"></span>
            <?php echo lang('active'); ?>
        </a>
        <a href="<?php echo site_url('reports/roster?inactive'); ?>" target="_blank"
           class="btn btn-danger btn-flat btn-sm">
            <span class="fa fa-print"></span>
            <?php echo lang('inactive'); ?>
        </a>
        <a href="<?php echo site_url('reports/roster'); ?>" target="_blank"
           class="btn btn-warning btn-flat btn-sm">
            <span class="fa fa-print"></span>
            <?php echo lang('print all'); ?>
        </a>
    </div>
</div>
<br/>
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
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="active">
            <i class="fa fa-allergies text-danger"></i>
            <?php echo lang('allergy'); ?> &nbsp; | &nbsp;
            <i class="fa fa-pills text-danger"></i>
            <?php echo lang('meds'); ?>
            <hr/>
            <?php
            $this->db->where('status', 1);
            if($this->input->post('search')) {
                $this->db->like('last_name', $this->input->post('search'));
                $this->db->or_like('first_name', $this->input->post('search'));
            }
            $activeChildren = $this->db->get('children')->result();
            ?>
            <?php if(!empty($activeChildren)): ?>
                <?php foreach ($activeChildren as $row): ?>
                    <?php if(!$this->child->checkedIn($row->id)) continue; ?>

                    <div class="children-thumbs cursor">
                        <div class="children-thumb"
                             onclick="window.location.href='<?php echo site_url('child/'.$row->id); ?>'"
                             style="background-image: url('<?php echo $this->child->photo($row->photo); ?>');">

                            <span class="i-check-timer">
                                <?php echo $this->child->checkinCounter($row->id); ?>
                            </span>

                            <?php if(!authorizedToChild($this->user->uid(), $row->id)): ?>
                                <i class="fa fa-lock text-danger pull-right fa-2x"></i>
                            <?php endif; ?>

                            <span class="child-dob"> <?php echo lang('DOB').': '.format_date($row->bday, false); ?></span>
                            <span class="child-id">ID:<?php echo decrypt($row->national_id); ?></span>

                        </div>

                        <div class="child-info">
                            <a href="<?php echo site_url('/child/'.$row->id); ?>">
                                <?php echo $row->last_name.', '.$row->first_name; ?>
                            </a>
                        </div>

                        <?php if($this->child->checkedIn($row->id) == 1) : ?>
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

                        <div class="health-icons">
                            <?php if($this->child->countAllergies($row->id)>0): ?>
                                <i class="fa fa-allergies text-danger i-check-icons i-check-allergy"></i>
                            <?php endif; ?>
                            <?php if($this->child->countMeds($row->id)>0): ?>
                                <i class="fa fa-pills text-danger i-check-icons i-check-med"></i>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="clearfix"></div>
                <hr/>

                <?php foreach ($activeChildren as $row): ?>
                    <?php if($this->child->checkedIn($row->id)) continue; ?>
                    <div class="children-thumbs cursor">
                        <div class="children-thumb"
                             onclick="window.location.href='<?php echo site_url('child/'.$row->id); ?>'"
                             style="background-image: url('<?php echo $this->child->photo($row->photo); ?>');">

                            <?php if(!authorizedToChild($this->user->uid(), $row->id)): ?>
                                <i class="fa fa-lock text-danger pull-right fa-2x"></i>
                            <?php endif; ?>

                            <span class="child-dob"> <?php echo lang('DOB').': '.format_date($row->bday, false); ?></span>
                            <span class="child-id">ID:<?php echo decrypt($row->national_id); ?></span>

                        </div>

                        <div class="child-info">
                            <a href="<?php echo site_url('/child/'.$row->id); ?>">
                                <?php echo $row->last_name.', '.$row->first_name; ?>
                            </a>
                        </div>

                        <?php if($this->child->checkedIn($row->id) == 1) : ?>
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

                        <div class="health-icons">
                            <?php if($this->child->countAllergies($row->id)>0): ?>
                                <i class="fa fa-allergies text-danger i-check-icons i-check-allergy"></i>
                            <?php endif; ?>
                            <?php if($this->child->countMeds($row->id)>0): ?>
                                <i class="fa fa-pills text-danger i-check-icons i-check-med"></i>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

            <?php else: ?>

                <a href="<?php echo site_url('children'); ?>" class="btn btn-primary">
                    <i class="fa fa-chevron-left"></i> <?php echo lang('back'); ?>
                </a>
                <hr/>
                <div class="alert alert-danger">
                    <i class="fa fa-exclamation-triangle"></i> <?php echo lang('no_results_found'); ?>
                </div>

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
                                 style="background-image: url('<?php echo $row->photo == "" ? base_url().'assets/img/content/no-image.png' : base_url().'assets/uploads/children/'.$row->photo; ?>');">
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

                <div class="callout callout-warning">
                    <?php echo lang('no_results_found'); ?></div>
            <?php endif; ?>
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
</script>

<?php $this->load->view('reports/report-form-popover'); ?>