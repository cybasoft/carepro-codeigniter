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
 * @param	mixed	$data
 * @param	string	$value
 * @param	mixed	$extra
 * @return	string
 */
function form_textarea($data = '', $value = '', $extra = '')
{
    $defaults = array(
        'name' => is_array($data) ? '' : $data
    );

    if ( ! is_array($data) OR ! isset($data['value']))
    {
        $val = $value;
    }
    else
    {
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
 * @param	mixed
 * @param	string
 * @param	mixed
 * @return	string
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
 * @param	mixed
 * @param	string
 * @param	mixed
 * @return	string
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

?>