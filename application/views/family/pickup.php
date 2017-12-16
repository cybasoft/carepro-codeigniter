<div class="row">
	<?php foreach ($pickups as $pickup) : ?>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<table class="table table-bordered parent-info">
				<tr>
					<td class="col-sm-2">
						<div data-toggle="modal" data-target="#new-pickup-photo">
							<?php
						if ($pickup->photo !== "") {
							echo '<img class="img-circle img-responsive img-thumbnail"
         src="' . base_url() . 'assets/img/pickup/' . $pickup->photo . '"/>';

						} else {
							echo '<img class="img-circle img-responsive img-thumbnail"
         src="' . base_url() . 'assets/img/content/no-image.png"/>';
						}

						?>

						</div>
					</td>
					<td>
						<span
							class="label-text parent-name"><?php echo $pickup->lname . ', ' . $pickup->fname; ?></span>
						|
						<span class="alert-info"> <?php echo $pickup->relation; ?></span>
						<hr/>
						<table>
							<tr>
								<td><span class="fa fa-phone"></span>
									<span class="label label-success"><?php echo $pickup->cell; ?></span></td>
							</tr>
							<tr>
								<td><span class="fa fa-phone"></span>
									<span class="label label-info"><?php echo $pickup->other_phone; ?></span></td>
							</tr>

						</table>

						<table>
							<tr>
								<td><span class="fa fa-envelope"> </span></td>
								<td>
									<div class="parent-address">
										<?php
									echo $pickup->address;
									?>
									</div>
								</td>
							</tr>
							<tr>
								<td><span class="fa fa-lock"></span></td>
								<td class="label label-danger">
									<?php echo $pickup->pin; ?>
								</td>
							</tr>
						</table>

						<span class="fa fa-trash cursor"
							  onclick="deletePickup('<?php echo $pickup->id; ?>');"></span>

					</td>
				</tr>
		</table>
	</div>
	<?php endforeach; ?>
</div>


<script type="text/javascript">
	function deletePickup(id) {
		if (confirm('<?php echo lang('confirm_delete_item'); ?>')) {
			window.location.href = '<?php echo site_url('pickup/delete_pickup'); ?>/' + id;
		}
	}
</script>