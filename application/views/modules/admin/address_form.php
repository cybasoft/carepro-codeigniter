<?php
$phone = array(
	'name' => 'phone',
	'class' => 'form-control',
	'placeholder' => lang('phone'),
	'value' => $this->conf->company()->phone,
	'size' => 30,
);
$fax = array(
	'name' => 'fax',
	'class' => 'form-control',
	'placeholder' => lang('fax'),
	'value' => $this->conf->company()->fax,
	'size' => 30,
);
$email = array(
	'name' => 'email',
	'class' => 'form-control',
	'placeholder' => lang('email'),
	'value' => $this->conf->company()->email,
	'size' => 30,
);
$website = array(
	'name' => 'website',
	'class' => 'form-control',
	'placeholder' => lang('website'),
	'value' => $this->conf->company()->website,
	'size' => 30,
);

$street = array(
	'name' => 'street',
	'class' => 'form-control',
	'placeholder' => lang('street'),
	'value' => $this->conf->company()->street,
	'size' => 30,
);
$city = array(
	'name' => 'city',
	'class' => 'form-control',
	'placeholder' => lang('city'),
	'value' => $this->conf->company()->city,
	'size' => 30,
);
$state = array(
	'name' => 'state',
	'class' => 'form-control',
	'placeholder' => lang('state'),
	'value' => $this->conf->company()->state,
	'size' => 30,
);
$zip = array(
	'name' => 'zip',
	'class' => 'form-control',
	'placeholder' => 'Zip',
	'value' => $this->conf->company()->zip,
	'size' => 30,
);


$button = array(
	'class' => 'btn btn-primary',
);
?>
<div class="row">
	<?php
	echo form_open('settings/update_company_address');
	?>
	<div class="col-xs-12 col-md-6 col-lg-6">
		<?php
		echo '<div class="input-group">';
		echo '<span class="label label-default">' . $email['placeholder'] . ':</span>';
		echo form_input($email);
		echo '</div>';
		echo '<div class="input-group">';
		echo '<span class="label label-default">' . $phone['placeholder'] . ':</span>';
		echo form_input($phone);
		echo '</div>';
		echo '<div class="input-group">';
		echo '<span class="label label-default">' . $fax['placeholder'] . ':</span>';
		echo form_input($fax);
		echo '</div>';
		echo '<div class="input-group">';
		echo '<span class="label label-default">' . $website['placeholder'] . ':</span>';
		echo form_input($website);
		echo '</div>';
		?>
	</div>
	<div class="col-xs-12 col-md-6 col-lg-6">
		<?php
		echo '<div class="input-group">';
		echo '<span class="label label-default">' . $street['placeholder'] . ':</span>';
		echo form_input($street);
		echo '</div>';
		echo '<div class="input-group">';
		echo '<span class="label label-default">' . $city['placeholder'] . ':</span>';
		echo form_input($city);
		echo '</div>';
		echo '<div class="input-group">';
		echo '<span class="label label-default">' . $state['placeholder'] . ':</span>';
		echo form_input($state);
		echo '</div>';
		echo '<div class="input-group">';
		echo '<span class="label label-default">' . $zip['placeholder'] . ':</span>';
		echo form_input($zip);
		echo '</div>';
		echo '<div class="input-group">';
		echo '<span class="label label-default">' . lang('country') . ':</span>';
		?>
		<select name="country" class="form-control">
			<option>--<?php echo lang('select'); ?>--</option>
			<?php foreach($this->daycare->countries() as $abbr => $name): ?>
				<option <?php echo $abbr == $this->conf->company()->country ? 'selected' : ''; ?>
					value="<?php echo $abbr; ?>"><?php echo $name; ?></option>
			<?php endforeach; ?>
		</select>
		<?php
		echo '</div><br/>';
		echo '<button class="btn btn-primary">' . lang('update') . '</button>';
		?>
	</div>

<?php echo form_close(); ?>
</div>
