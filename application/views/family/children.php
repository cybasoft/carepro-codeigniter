<div class="row">
	<div class="col-md-12">
		<?php if($children->num_rows() > 0): ?>
			<?php foreach($children->result() as $row): ?>
				<div class="col-sm-3 col-md-3 col-lg-3" style="width:320px">
					<div class="box box-solid box-success">
						<div class="box-header">
							<div class="box-title">
								<?php echo $row->lname . ', ' . $row->fname; ?>
							</div>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-sm-5 col-md-5 col-lg-5 image pull-left">
									<div>
										<?php
										if($row->photo !== "") {
											echo '<img class="img-circle"
         src="' . base_url() . 'assets/companies/' . $this->company->company()->code . '/images/children/' . $row->photo . '" style="width: 120px; height:120px"/>';
										} else {
											echo '<img class="img-circle"
         src="' . base_url() . 'assets/images/no-image.png" style="width: 120px; height:120px"/>';
										}
										?>
									</div>
								</div>
								<div class="col-sm-7 col-md-7 col-lg-7 pull-right">
									<span class="label label-info"><?php echo lang('birthday'); ?></span><br/>
									<?php echo $row->bday; ?>
									<br/>

									<div class="bg-warning">
                    <span
						class="badge"><?php echo $this->child->totalRecords('child_notes', $row->id); ?></span>
										<?php echo lang('notes'); ?>
									</div>
									<div class="bg-warning">
                    <span
						class="badge"><?php echo $this->child->totalrecords('child_meds', $row->id); ?></span>
										<?php echo lang('medications'); ?>
									</div>
									<div class="bg-warning">
                    <span
						class="badge"><?php echo $this->child->totalRecords('child_allergy', $row->id); ?></span>
										<?php echo lang('allergies'); ?>
									</div>

									<br/>
									<span class="label label-info"><?php echo lang('status'); ?></span>
									<?php echo lang($this->children->status($row->status)); ?>
								</div>
							</div>
						</div>
						<div class="box-footer">
							<a href="<?php echo site_url('family/viewchild/' . $row->child_id); ?>"
							   class="btn btn-info btn-flat btn-sm viewChild">
								<span class="glyphicon glyphicon-eye-open"></span> <?php echo lang('open'); ?>
							</a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		<?php else: ?>
			<div class="callout callout-danger">
				<h4>There are children associated with your profile.
					If this is a mistake and your child has been registered,
					please contact a staff member.</h4>

				<p class="text-bold">Phone: <?php echo $this->conf->company()->phone; ?></p>

				<p class="text-bold">Email: <?php echo $this->conf->company()->email; ?></p>
			</div>
		<?php endif; ?>
	</div>
</div>