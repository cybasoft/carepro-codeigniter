
<table class="table table-bordered parent-info">
	<?php
	foreach($this->child->getParents($this->child->getID())->result() as $u): //iterate through users
		?>
		<tr>
			<td class="col-sm-2">
				<div>
					<?php if($this->users->user($u->user_id)->photo !== ""): ?>
						<img class="img-circle img-responsive img-thumbnail"
							 src="<?php echo base_url() . 'assets/companies/'.$this->company->company()->code.'/images/staff/' . $this->users->user($u->user_id)->photo; ?>"/>
					<?php else: ?>
						<img class="img-circle img-responsive img-thumbnail"
							 src="<?php echo base_url(); ?>'assets/images/no-image.png"/>
					<?php endif; ?>
				</div>

			</td>
			<td>
                    <span class="label-text parent-name"><?php echo $u->last_name; ?>
						, <?php echo $u->first_name; ?></span>
				<hr/>
				<table>
					<tr>
						<td><span class="glyphicon glyphicon-inbox"></span>
							<span class="label label-info"><?php echo $u->email; ?></span></td>
					</tr>

				</table>

				<table>
					<tr>
						<td><span class="glyphicon glyphicon-envelope"> </span></td>
						<td>
							<div class="parent-address">
								<?php
								if($this->users->user($u->user_id)->street != 0) {
									echo $this->users->user($u->user_id)->street;
									echo '. &nbsp;';
									echo $this->users->user($u->user_id)->city;
									echo ', &nbsp;';
									echo $this->users->user($u->user_id)->state;
									echo '&nbsp;';
									echo $this->users->user($u->user_id)->zip;
									echo '&nbsp; ';
									echo $this->users->user($u->user_id)->country;
								}
								?>
							</div>
						</td>
					</tr>
					<tr>
						<td><span class="glyphicon glyphicon-lock"></span></td>
						<td>
                                    <span class="label label-success show-pin" title="<?php echo $this->users->user($u->user_id)->pin; ?>">
										<?php echo lang('view') . ' ' . lang('pin'); ?>
									</span>


						</td>
					</tr>
				</table>
				<hr/>
				<a href="<?php echo site_url('children/remove_parent/' . $u->user_id); ?>" class="btn btn-danger btn-sm pull-right delete">
					<span class="glyphicon glyphicon-trash"></span>
					<?php echo lang('remove'); ?>
				</a>


			</td>
		</tr>

	<?php
	endforeach;
	?>
</table>

<script>
	$('.assign-user').hide();
	$('.assign-user-btn').click(function () {
		$('.assign-user').toggle().load('<?php echo site_url('children/assign_parent'); ?>');
	});
</script>