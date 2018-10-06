<?php $this->load->view('child/childphoto'); ?>
<div class="card">
    <ul class="nav nav-pills nav-stacked" style="margin-top:5px;">
        <li <?php echo ($this->uri->segment(3) == '') ? 'class="active"' : ""; ?>><?php echo anchor('child/'.$child->id, '<i class="fa fa-home"></i>'.lang('dashboard')); ?></li>
        <li <?php echo ($this->uri->segment(3) == 'health') ? 'class="active"' : ""; ?>>
            <?php echo anchor('child/'.$child->id.'/health', '<i class="fa text-danger fa-medkit"></i>'.lang('health')); ?>
        </li>
        <li <?php echo ($this->uri->segment(3) == 'notes') ? 'class="active"' : ""; ?>>
            <?php echo anchor('child/'.$child->id.'/notes', '<i class="fa fa-book"></i>'.lang('notes')); ?>
        </li>
        <li <?php echo ($this->uri->segment(3) == 'photos') ? 'class="active"' : ""; ?>>
            <?php echo anchor('child/'.$child->id.'/photos', icon('portrait').' '.lang('photos')); ?>
        </li>
        <li <?php echo ($this->uri->segment(3) == 'billing') ? 'class="active"' : ""; ?>>
            <?php echo anchor('child/'.$child->id.'/billing', '<i class="fa text-info fa-credit-card"></i>'.lang('billing')); ?>
        </li>
        <li <?php echo ($this->uri->segment(3) == 'reports') ? 'class="active"' : ""; ?>>
            <?php echo anchor('child/'.$child->id.'/reports', '<i class="fa text-primary fa-clipboard"></i>'.lang('Reports')); ?>
        </li>
    </ul>

</div>