<?php if($this->conf->isParent()==true
	&& $this->conf->isStaff()==false): ?>
<?php $this->load->view('family/inc/home'); ?>
	<?php else: ?>
<?php $this->load->view('inc/home'); ?>
<?php endif; ?>