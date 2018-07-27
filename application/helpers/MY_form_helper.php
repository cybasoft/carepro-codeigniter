<?php
/**
 * @package     daycarepro app
 * @copyright   2018 A&M Digital Technologies
 * @author      John Muchiri
 * @link        https://amdtllc.com
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
/**
 * Textarea field
 *
 * @param    mixed  $data
 * @param    string $value
 * @param    mixed  $extra
 *
 * @return    string
 */
function form_textarea($data = '', $value = '', $extra = '')
{
    $defaults = array(
        'name' => is_array($data) ? '' : $data
    );

    if(!is_array($data) OR !isset($data['value'])) {
        $val = $value;
    } else {
        $val = $data['value'];
        unset($data['value']); // textareas don't use the value attribute
    }

    return '<textarea '._parse_form_attributes($data, $defaults)._attributes_to_string($extra).'>'
        .html_escape($val)
        ."</textarea>\n";
}

/**
 * Email Input Field
 *
 * @param    mixed
 * @param    string
 * @param    mixed
 *
 * @return    string
 */
function form_email($data = '', $value = '', $extra = '')
{
    $defaults = array(
        'type' => 'email',
        'name' => is_array($data) ? '' : $data,
        'value' => $value
    );

    return '<input '._parse_form_attributes($data, $defaults)._attributes_to_string($extra)." />\n";
}

/**
 * Date Input Field
 *
 * @param    mixed
 * @param    string
 * @param    mixed
 *
 * @return    string
 */
function form_date($data = '', $value = '', $extra = '')
{
    $defaults = array(
        'type' => 'date',
        'name' => is_array($data) ? '' : $data,
        'value' => $value
    );

    return '<input '._parse_form_attributes($data, $defaults)._attributes_to_string($extra)." />\n";
}

/**
 * Time Input Field
 *
 * @param    mixed
 * @param    string
 * @param    mixed
 *
 * @return    string
 */
function form_time($data = '', $value = '', $extra = '')
{
    $defaults = array(
        'type' => 'time',
        'name' => is_array($data) ? '' : $data,
        'value' => $value
    );

    return '<input '._parse_form_attributes($data, $defaults)._attributes_to_string($extra)." />\n";
}

/**
 * Form Value
 *
 * Grabs a value from the POST array for the specified field so you can
 * re-populate an input field or textarea. If Form Validation
 * is active it retrieves the info from the validation class
 *
 * @param    string $field       Field name
 * @param    string $default     Default value
 * @param    bool   $html_escape Whether to escape HTML special characters or not
 *
 * @return    string
 */
function set_value($field, $default = '', $html_escape = TRUE)
{
    $CI =& get_instance();

    $value = (isset($CI->form_validation) && is_object($CI->form_validation) && $CI->form_validation->has_rule($field))
        ? $CI->form_validation->set_value($field, $default)
        : $CI->input->post($field, FALSE);

    //check session for that value

    $sessionField = $CI->session->flashdata($field);

    if(isset($sessionField) && $default == '') {
        $value = $sessionField;
    }

    isset($value) OR $value = $default;
    return ($html_escape) ? html_escape($value) : $value;
}

?>