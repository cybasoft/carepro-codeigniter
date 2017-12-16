<div class="row no-print">
	<div class="col-lg-4">
		<div class="callout callout-info">
			<?php
		if ($child->photo !== "") {
			echo '<img class="img-circle pull-left"
         src="' . base_url() . 'assets/img/users/children/' . $child->photo . '" style="width:80px; height:80px"/>';
		} else {
			echo '<img class="img-circle"
         src="' . base_url() . 'assets/img/content/no-image.png" style="width: 80px; height:60px"/>';
		}
		?>
			<h4>
				<?php echo $this->child->child()->lname . ', ' . $this->child->child()->fname; ?>
				<em class="label">
					<?php echo lang($this->child->status($this->child->child()->status)); ?>
				</em>
			</h4>

			<p>
				<span><?php echo lang('birthday'); ?>:</span>
				<span class="label label-info"><?php echo date('d-M, Y', strtotime($this->child->child()->bday)); ?></span>
			</p>

		</div>
	</div>

	<div class="col-lg-8">
		<div class="callout callout-info">
			<?php echo anchor(uri_string(), '<i class="fa fa-home"></i>' . lang('dashboard'), 'class="btn btn-app bg-orange"'); ?>
			<?php echo anchor(uri_string() . '?p=health', '<i class="fa fa-medkit"></i>' . lang('health'), 'class="btn btn-app bg-yellow"'); ?>
			<?php echo anchor(uri_string() . '?p=notes', '<i class="fa fa-book"></i>' . lang('notes'), 'class="btn btn-app bg-blue"'); ?>
			<?php echo anchor(uri_string() . '?p=pickup', '<i class="fa fa-phone-alt"></i>' . lang('pickup'), 'class="btn btn-app bg-olive"'); ?>
			<?php echo anchor(uri_string() . '?p=invoice', '<i class="fa fa-credit-card"></i>' . lang('invoice'), 'class="btn btn-app bg-black"'); ?>
			<?php echo anchor(uri_string() . '?p=emergency', '<i class="fa fa-ambulance"></i>' . lang('emergency'), 'class="btn btn-app bg-maroon"'); ?>
			<?php echo anchor(uri_string() . '?p=reports', '<i class="fa fa-table"></i>' . lang('reports'), 'class="btn btn-app bg-purple"'); ?>
		</div>
	</div>
</div>