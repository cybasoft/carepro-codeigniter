<div class="row">
	<div class="col-lg-12">
		<div class="callout callout-info">
			<h3><?php echo $user->username; ?></h3>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<div class="box box-solid box-primary">
			<div class="box-header"><h3 class="box-title"><?php echo lang('user_information'); ?></h3></div>
			<div class="box-body">
				<?php echo form_open('users/update_user'); ?>
				<table class="table">
					<tr>
						<td><?php echo lang('first_name'); ?></td>
						<td><input type="text" name="first_name" value="<?php echo $user->first_name; ?>"
								   class="form-control" required=""/></td>
					</tr>
					<tr>
						<td><?php echo lang('last_name'); ?></td>
						<td><input type="text" name="last_name" value="<?php echo $user->last_name; ?>"
								   class="form-control"
								   required=""/></td>
					</tr>
					<tr>
						<td><?php echo lang('email'); ?></td>
						<td><input type="text" name="email" value="<?php echo $user->email; ?>" class="form-control"
								   required=""/></td>
					</tr>
					<tr>
						<td></td>
						<td><?php echo lang('password'); ?>
							<input type="password" name="password" value="" class="form-control"/>
							<?php echo lang('password_confirm'); ?>
							<input type="password" name="password_confirm" value="" class="form-control"/>
						</td>
					</tr>
					<tr>

					</tr>
					<?php if($this->conf->isAdmin() == true): ?>
						<tr>
							<td><?php echo lang('edit_user_groups_heading'); ?></td>
							<td>

								<?php foreach($groups as $group): ?>
									<label class="checkbox">
										<?php
										$gID = $group['id'];
										$checked = null;
										$item = null;
										$type='checkbox';
										$g_name=$group['name'];
										foreach($currentGroups as $grp) {
											if($gID == $grp->id) {
												$checked = ' checked="checked"';
												break;
											}
										}
										if($this->conf->in_group($this->users->uid(), 'admin') && $group['id']==1) {
											$type ='disabled"';
										} else {
											$type = 'disabled"';
										}
										?>
										<input type="checkbox" <?php echo $type; ?> name="groups[]"
											   value="<?php echo $group['id']; ?>" <?php echo $checked; ?>>
									<?php  echo $g_name; ?>
									</label>
								<?php endforeach ?>
								<?php echo form_hidden('id', $user->id); ?>
							</td>
						</tr>
					<?php endif; ?>
					<tr>
						<td></td>
						<td>
							<button class="btn btn-primary"><?php echo lang('submit'); ?></button>
						</td>
					</tr>
				</table>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>

	<div class="col-lg-6">
		<div class="box box-solid box-primary">
			<div class="box-header"><h3 class="box-title"><?php echo lang('address'); ?></h3></div>
			<div class="box-body">
				<?php echo form_open('user/update_user_data/' . $user->id); ?>
				<table class="table">
					<tr>
						<td><?php echo lang('pin'); ?></td>
						<td>
							<input type="text" name="pin" value="<?php echo $userData->pin; ?>"
								   class="form-control" required=""/>
						</td>
					</tr>
					<tr>
						<td><?php echo lang('street'); ?></td>
						<td>
							<input type="text" name="street" value="<?php echo $userData->street; ?>"
								   class="form-control" required=""/>
						</td>
					</tr>
					<tr>
						<td><?php echo lang('street2'); ?></td>
						<td><input type="text" name="street2" value="<?php echo $userData->street2; ?>"
								   class="form-control"/></td>
					</tr>
					<tr>
						<td><?php echo lang('city'); ?></td>
						<td><input type="text" name="city" value="<?php echo $userData->city; ?>"
								   class="form-control" required=""/></td>
					</tr>
					<tr>
						<td><?php echo lang('state'); ?></td>
						<td><input type="text" name="state" value="<?php echo $userData->state; ?>"
								   class="form-control" required=""/></td>
					</tr>
					<tr>
						<td><?php echo lang('zip_code'); ?></td>
						<td><input type="text" name="zip" value="<?php echo $userData->zip; ?>"
								   class="form-control" required=""/></td>
					</tr>
					<tr>
						<td><?php echo lang('country'); ?></td>
						<td><input type="text" name="country" value="<?php echo $userData->country; ?>"
								   class="form-control" required=""/></td>
					</tr>
					<tr>
						<td></td>
						<td>
							<button class="btn btn-primary"><?php echo lang('submit'); ?></button>
						</td>
					</tr>
				</table>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>

	<div class="col-lg-6">
		<div class="box-lg-6">
			<div class="box box-solid box-primary">
				<div class="box-header"><h3 class="box-title"><?php echo lang('photo'); ?></h3></div>
				<div class="box-body">
					<table class="table no-border">
						<tr>
							<td style="width:200px">
								<?php
								if($this->users->user($user->id)->photo !== "") {
									echo '<img class="img-circle img-thumbnail"
         src="' . base_url() . 'assets/companies/' . $this->company->company()->code . '/images/staff/' . $this->users->user($user->id)->photo . '"/>';
								} else {
									echo '<img class="img-circle img-thumbnail"
         src="' . base_url() . 'assets/images/no-image.png"/>';
								}
								?>
							</td>
							<td>
								<?php echo form_open_multipart('users/upload_photo/' . $user->id, 'class="input-group"'); ?>
								<input class="form-control" type="file" name="userfile" size="20"/>
                        <span class="input-group-btn">
                            <button class="btn btn-info" type="submit"><?php echo lang('update'); ?></button>
                        </span>
								<?php echo form_close(); ?>
							</td>
						</tr>
					</table>


				</div>
			</div>
		</div>
	</div>

</div>
