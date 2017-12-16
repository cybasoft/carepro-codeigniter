<ol class="breadcrumb alert-success">
    <li class="active">
         <span class="h3">
                <?php echo $child->lname . ', ' . $child->fname; ?>
            </span>
    </li>
</ol>

<div class="tabs-left">
    <ul class="nav nav-tabs">
		<li><a href="#dashboard" data-toggle="tab">
				<i class="fa fa-dashboard"></i>
				<span class="hidden-xs"><?php echo lang('dashboard'); ?></span>
			</a>
        </li>
		<li><a href="#health" data-toggle="tab">
				<i class="fa fa-heart"></i>
				<span class="hidden-xs"><?php echo lang('health'); ?></span>
			</a>
        </li>
		<li><a href="#notes" data-toggle="tab">
				<i class="fa fa-list-alt"></i>
				<span class="hidden-xs"><?php echo lang('notes'); ?></span>
			</a>
        </li>
		<li><a href="#p_invoice" data-toggle="tab">
				<i class="fa fa-usd"></i>
				<span class="hidden-xs"><?php echo lang('invoice'); ?></span>
			</a>
        </li>
		<li><a href="#paymethod" data-toggle="tab">
				<i class="fa fa-credit-card"></i>
				<span class="hidden-xs"><?php echo lang('payment_method'); ?></span>
			</a>
        </li>
		<li>
			<a href="#pickup" role="tab" data-toggle="tab">
				<i class="fa fa-user"></i>
				<span class="hidden-xs"><?php echo lang('pickup'); ?></span>
			</a>
        </li>
        <li><a href="#attendance" role="tab" data-toggle="tab">
				<i class="fa fa-check"></i>
				<span class="hidden-xs"><?php echo lang('attendance'); ?></span>
			</a>
        </li>
        <li><a href="#emergency" role="tab" data-toggle="tab">
				<i class="fa fa-phone-alt"></i>
				<span class="hidden-xs"><?php echo lang('emergency_contact'); ?></span>
			</a>
		</li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="dashboard">
            <!--photo-->
            <div class="child-thumb pull-right">
                <?php
                if ($child->photo !== "") {
                    echo '<img class="img-square img-responsive img-thumbnail" src="'
                        . base_url() . 'assets/img/uploads/' . $child->photo . '"/>';
                } else {
                    echo '<img class="img-square img-responsive img-thumbnail" src="'
                        . base_url() . 'assets/img/content/no-image.png"/>';
                }
                ?>
            </div>


            <div class="btn-group">
                    <span class="btn btn-default disabled">
                        <span class="label label-default"><?php echo lang('birthday'); ?></span>
                        <?php echo date('d-M, Y', strtotime($child->bday)); ?>
                    </span>
                    <span class="btn btn-default disabled">
                        <span class="label label-default"><?php echo lang('enrolled'); ?></span>
                        <?php echo $child->enroll_date !== "" ? date('d-M, Y', $child->enroll_date) : ''; ?>
                    </span>

                <div class="clearfix"></div>
                <h4>
                    <?php echo lang('status'); ?>:
                    <?php echo lang($this->conf->db_read('child_status', $child->status, 'status_name')); ?>
                </h4>
                <hr/>
            </div>
        </div>

        <!--health-->
        <div class="tab-pane" id="health">
            <?php $this->load->view('modules/children/health/index'); ?>
        </div>

        <!--notes-->
        <div class="tab-pane" id="notes">
            <?php
            $this->db->where('child_id', $child->id);
            $notes = $this->db->get('child_notes');
            if ($notes->num_rows() == 0) :
                echo '<div class="alert alert-danger">' . lang('nothing_to_display') . '</div>';
            else :
                foreach ($notes->result() as $note) :
            ?>
                    <div class="children-notes pull-left">
                        <div class="children-notes-title">
                            <?php
                            if ($note->date !== "") {
                                echo date('d-M-y G:i', $note->date);
                            }
                            echo ' By ';
                            echo $this->users->user($note->user_id)->username;
                            ?>
                        </div>
                        <div class="children-notes-content"><?php echo $note->content; ?></div>
                    </div>
                <?php endforeach;
                endif; ?>
        </div>

        <!--charges-->
        <div class="tab-pane" id="p_invoice">
            <?php $this->load->view('modules/family/invoice'); ?>
        </div>


        <!--payment methods-->
        <div class="tab-pane" id="paymethod">
            <?php //$this->load->view('modules/children/accounting/pay_method'); ?>
        </div>

        <!--pickup-->
        <div class="tab-pane" id="pickup">
            <?php $this->load->view('modules/child/pickup'); ?>
        </div>
        <!--attendance-->
        <div class="tab-pane" id="attendance">
            <?php $this->load->view('modules/children/reports/attendance'); ?>
        </div>
        <!--emergency-->
        <div class="tab-pane" id="emergency">
            <?php $this->load->view('modules/children/emergency'); ?>
        </div>
    </div>

</div>