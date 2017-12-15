<?php

echo '<span class="h3">'.lang('update').' '.lang('address').'</span>';
echo '<hr/>';

$street = array(
    'name'  => 'street',
    'id'    => 'street',
    'class' => 'form-control',
    'value' => $my_street,
    'size'  => 30,
);
$city = array(
    'name'  => 'city',
    'id'    => 'city',
    'class' => 'form-control',
    'value' => $my_city,
    'size'  => 30,
);
$state = array(
    'name'  => 'state',
    'id'    => 'state',
    'class' => 'form-control',
    'value' => $my_state,
    'size'  => 30,
);
$zip_code = array(
    'name'  => 'zip_code',
    'id'    => 'zip_code',
    'class' => 'form-control',
    'value' => $my_zip,
    'size'  => 30,
);
$country = array(
    'name'  => 'country',
    'id'    => 'country',
    'class' => 'form-control',
    'value' => $my_country,
    'size'  => 30,
);
$home_phone = array(
    'name'  => 'home_phone',
    'id'    => 'home_phone',
    'class' => 'form-control',
    'value' => $my_phone,
    'size'  => 30,
);

$label_attr = array(
    'class' => 'input-group-addon'
);

echo form_open('auth/change_address', 'id="addr_form"');
echo '<div class="input-group">';
echo form_label('street:', 'street', $label_attr);
echo form_input($street);
echo '</div>';
echo '<div class="input-group">';
echo form_label('city:', 'city', $label_attr);
echo form_input($city);
echo '</div>';
echo '<div class="input-group">';
echo form_label('state:', 'state', $label_attr);
echo form_input($state);
echo '</div>';
echo '<div class="input-group">';
echo form_label('zip code:', 'zip_code', $label_attr);
echo form_input($zip_code);
echo '</div>';
echo '<div class="input-group">';
echo form_label('country:', 'country', $label_attr);
echo form_input($country);
echo '</div>';

echo '<hr/>';

echo '<div class="input-group">';
echo form_label('phone:', 'home_phone', $label_attr);
echo form_input($home_phone);
echo '</div>';

echo '<hr/>';

echo '<button class="btn btn-primary">'.lang('update').'</button>';

echo form_close();
?>
<script>
    //$('#addr_form').hide();
    $('#change_addr').click(function () {
        $('#addr_form').show();
        $(this).hide();
        x = 0;
        y = document.height;
        window.scroll(x, y);
    })
</script>
<div id="update_address"></div>