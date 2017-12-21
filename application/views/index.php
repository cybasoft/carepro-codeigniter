<?php if(is('parent')==true
	&& is('staff')==false): ?>
<?php $this->load->view('parent/inc/home'); ?>
	<?php else: ?>
<?php $this->load->view('inc/home'); ?>
<?php endif; ?>