
    <?php $this->load->view('modules/child/childphoto'); ?>
    <ul class="nav nav-pills nav-stacked" style="margin-top:5px;">
        <li class="text-left"><?php echo anchor('child/' . $child->id, '<i class="fa fa-home"></i>' . lang('dashboard'), 'class=" bg-orange"'); ?></li>
        <li>
            <?php echo anchor('child/' . $child->id . '/health', '<i class="fa fa-medkit"></i>' . lang('health'), 'class="bg-yellow"'); ?>
        </li>
        <li>
            <?php echo anchor('child/' . $child->id . '/notes', '<i class="fa fa-book"></i>' . lang('notes'), 'class="bg-blue"'); ?>
        </li>
        <li>
            <?php echo anchor('child/' . $child->id . '/pickup', '<i class="fa fa-phone"></i>' . lang('pickup'), 'class="bg-olive"'); ?>
        </li>
        <li>
            <?php echo anchor('child/' . $child->id . '/invoice', '<i class="fa fa-credit-card"></i>' . lang('invoice'), 'class="bg-black"'); ?>
        </li>
        <li>
            <?php echo anchor('child/' . $child->id . '/emergency', '<i class="fa fa-ambulance"></i>' . lang('emergency'), 'class="bg-maroon"'); ?>
        </li>
        <li>
            <?php echo anchor('child/' . $child->id . '/reports', '<i class="fa fa-table"></i>' . lang('reports'), 'class="bg-purple"'); ?>
        </li>
    </ul>
</div>