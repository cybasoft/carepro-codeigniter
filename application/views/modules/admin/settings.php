<?php
$name = array(
    'name'        => 'company_name',
    'class'       => 'form-control',
    'placeholder' => lang('company'),
    'value'       => $this->conf->company()->name,
    'size'        => 30,
);
$slogan = array(
    'name'        => 'slogan',
    'class'       => 'form-control',
    'placeholder' => lang('slogan'),
    'value'       => $this->conf->company()->slogan,
    'size'        => 30,
);
$encrypt_key = array(
    'name'        => 'encrypt_key',
    'class'       => 'form-control',
    'placeholder' => lang('encryption_key'),
    'value'       => $this->conf->company()->encrypt_key,
    'size'        => 30,
);
$paypal_email = array(
    'name'        => 'paypal_email',
    'class'       => 'form-control',
    'placeholder' => lang('paypal_email'),
    'value'       => $this->conf->company()->paypal_email,
    'size'        => 30,
);
$google_analytics = array(
    'name'        => 'google_analytics',
    'class'       => 'form-control',
    'placeholder' => lang('google_analytics'),
    'value'       => $this->conf->company()->google_analytics,
    'size'        => 30,
);

$currency = array(
    'name'        => 'currency',
    'class'       => 'form-control',
    'placeholder' => lang('currency'),
    'value'       => $this->conf->company()->currency,
    'size'        => 30,
);
$curr_symbol = array(
    'name'        => 'curr_symbol',
    'class'       => 'form-control',
    'placeholder' => lang('currency_symbol'),
    'value'       => $this->conf->company()->curr_symbol,
    'size'        => 30,
);

?>
<div>
    <?php echo form_open('settings/update_settings');
    echo '<span class="label label-default">'.lang('company').'</span>';
    echo form_input($name);
    echo '<span class="label label-default">'.lang('slogan').'</span>';
    echo form_input($slogan);
    echo br();
    echo '<span class="label label-default">'.lang('google_analytics').'</span>';
    echo form_input($google_analytics);
    echo br();
    echo '<span class="label label-danger">'.lang('encryption_key').'</span>';
    if($this->conf->company()->encrypt_key ==""){
        echo form_input($encrypt_key);
        echo '<div class="alert alert-danger">'.lang('encryption_key_warning').'</div>';
    }else{
        echo $this->conf->company()->encrypt_key;
        echo form_hidden('encrypt_key',$this->conf->company()->encrypt_key);
        echo br();
        echo br();
    }
    echo '<span class="label label-default">'.lang('paypal_email').'</span>';
    echo form_input($paypal_email);

    echo '<span class="label label-default">'.lang('currency').'</span>';
    echo form_input($currency);
    echo '<span class="label label-default">'.lang('currency_symbol').'</span>';
    echo form_input($curr_symbol);
    ?>
</div>
<br/>
<div class="input-group">
    <span class="input-group-addon"><?php echo lang('timezone'); ?>: </span>
    <select class="form-control" name="time_zone">
        <?php
        foreach ($this->daycare->timezones() as $time => $zone) {
            echo '<option value="' . $time . '" ';
            echo $this->conf->selected_option($this->conf->company()->time_zone, $time);
            echo '>' . $zone . '</option>';
        }
        ?>
    </select>


</div>
<br/>

<!--div class="input-group alert-info">
        <span class="input-group-addon">Allow registration:</span>
        <span></span>

        <div class="input-group-addon">
            <input type="radio" name="allow_reg" class="form-control"
                   value="1" <?php echo $this->conf->checked_option($this->conf->company()->allow_reg, 1); ?>/>
            <span class="input-group-addon">Yes</span>
        </div>
        <div class="input-group-addon">

            <input type="radio" name="allow_reg" class="form-control"
                   value="0" <?php echo $this->conf->checked_option($this->conf->company()->allow_reg, 0); ?>/>
            <span class="input-group-addon">No</span>
        </div>

    </div-->

<!--div class="input-group alert-danger">
    <span class="input-group-addon"><?php echo lang('maintenance'); ?></span>
    <span></span>

    <div class="input-group-addon">
        <input type="radio" name="maintenance" class="form-control"
               value="1" <?php echo $this->conf->checked_option($this->conf->company()->maintenance, 1); ?>/>
        <span class="input-group-addon"><?php echo lang('yes'); ?></span>
    </div>
    <div class="input-group-addon">
        <input type="radio" name="maintenance" class="form-control"
               value="0" <?php echo $this->conf->checked_option($this->conf->company()->maintenance, 0); ?>/>
        <span class="input-group-addon"><?php echo lang('no'); ?></span>
    </div>

</div-->
<br/>
<?php if ($this->conf->company()->maintenance==1): ?>
    <div class="input-group">
        <span class="input-group-addon"><?php echo lang('version'); ?>: </span>
        <input type="text" name="version" class="form-control"
               value="<?php echo $this->conf->company()->version; ?>"
               required=""/>
    </div><br/>
<?php endif; ?>


<button class="btn btn-primary"><?php echo lang('update'); ?></button>
<?php echo form_close(); ?>
