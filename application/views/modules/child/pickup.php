<?php $this->load->view($this->module . 'nav'); ?>
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8">

		<table class="table table-bordered parent-info">
			<?php
		$this->db->where('child_id', $child->id);
		$pickups = $this->db->get('child_pickup');
		foreach ($pickups->result() as $pickup) : //iterate through users
		?>
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
						<hr/>
						<!--div class="parent-actions pull-right">
                            <a data-toggle="tooltip"
                               data-placement="top"
                               title="Send email"
                               class="send-mail"
                               href="<?php echo base_url(); ?>parent/send_email"><img
                                    src="<?php echo base_url(); ?>assets/img/email.png"/></a>
                        </div>-->

						<span class="fa fa-trash cursor"
							  onclick="deletePickup('<?php echo $pickup->id; ?>');"></span>

						<form action="<?php echo site_url('pickup/uploadPhoto/' . $pickup->id); ?>"
							  class="input-group col-lg-6 pull-right" enctype="multipart/form-data" method="post"
							  accept-charset="utf-8">
							<input class="form-control" type="file" name="userfile" size="20">
                    <span class="input-group-btn">
                        <button class="btn btn-info" type="submit">Upload</button>
                    </span>
						</form>

					</td>
				</tr>
			<?php endforeach; ?>
		</table>

	</div>
	<div class="col-lg-4 col-md-4 col-sm-4">
		<div class="box box-solid box-primary">
			<div class="box-header"><div class="box-title"></div> </div>
			<div class="box-body">
				<?php echo form_open('pickup/add_pickup_contact/') ?>
				<input class="form-control" type="text" name="fname" placeholder="<?php echo lang('first_name'); ?>"
					   required=""/>
				<input class="form-control" type="text" name="lname" placeholder="<?php echo lang('last_name'); ?>"
					   required=""/>
				<input class="form-control" type="text" name="cell" placeholder="<?php echo lang('cellphone'); ?>"
					   required=""/>
				<input class="form-control" type="text" name="other_phone"
					   placeholder="<?php echo lang('other_phone'); ?>"/>
				<input class="form-control" type="text" name="relation"
					   placeholder="<?php echo lang('relation'); ?>" required=""/>
				<input class="form-control" type="text" name="pin" placeholder="<?php echo lang('pin'); ?>"
					   required=""/>
				<textarea class="form-control" name="address"
						  placeholder="<?php echo lang('address'); ?>"></textarea>
				<button class="btn btn-primary"><?php echo lang('submit'); ?></button>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function deletePickup(id) {
		if (confirm('<?php echo lang('confirm_delete_item'); ?>')) {
			window.location.href = '<?php echo site_url('pickup/delete_pickup'); ?>/' + id;
		}
	}
</script>

