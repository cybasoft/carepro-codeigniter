<div class="row no-print">
	<div class="col-lg-4">
		<div class="callout callout-info">
			<h4>
				<?php echo $this->children->child()->lname . ', ' . $this->children->child()->fname; ?>
				<em class="label">
				<?php echo lang($this->children->status($this->children->child()->status)); ?>
			</em>
			</h4>

			<p>
				<span><?php echo lang('birthday'); ?>:</span>
				<span class="label label-info"><?php echo date('d-M, Y', strtotime($this->children->child()->bday)); ?></span>
				<span><?php echo lang('enrolled'); ?></span>
				<span class="label label-info">
					<?php echo $this->children->child()->enroll_date !== "" ? date('d-M, Y', $this->children->child()->enroll_date) : ''; ?>
				</span>

			</p>

		</div>
	</div>

	<div class="col-lg-8">
		<div class="callout callout-info">
			<?php echo anchor('child/'.$this->child->getID(),'<i class="fa fa-home"></i>'.lang('dashboard'),'class="btn btn-app bg-orange"'); ?>
			<?php echo anchor('child/health','<i class="fa fa-medkit"></i>'.lang('health'),'class="btn btn-app bg-yellow"'); ?>
			<?php echo anchor('child/notes','<i class="fa fa-book"></i>'.lang('notes'),'class="btn btn-app bg-blue"'); ?>
			<?php echo anchor('child/pickup','<i class="glyphicon glyphicon-phone-alt"></i>'.lang('pickup'),'class="btn btn-app bg-olive"'); ?>
			<?php echo anchor('child/invoice','<i class="fa fa-credit-card"></i>'.lang('invoice'),'class="btn btn-app bg-black"'); ?>
			<?php echo anchor('child/emergency','<i class="fa fa-ambulance"></i>'.lang('emergency'),'class="btn btn-app bg-maroon"'); ?>
			<?php echo anchor('child/reports','<i class="fa fa-table"></i>'.lang('reports'),'class="btn btn-app bg-purple"'); ?>
		</div>
	</div>
</div>