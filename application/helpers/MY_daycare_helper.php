<?php
/**
 * @package     daycarepro
 * @copyright   2017 A&M Digital Technologies
 * @author      John Muchiri
 * @link        https://amdtllc.com
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
/**
 * easy date stamp for database entry
 * return date time stamp
 * @return false|string
 */
function date_stamp()
{
    return date('Y-m-d H:i:s');
}

/**
 * format date based on config settings
 * @param $date
 * @return false|string
 */
function format_date($date, $time = true, $timestamp = false)
{
    if($timestamp == true)
        $date = date('Y-m-d H:i:s', $date);

    $format = get_option('date_format');
    if($format == "")
        return date('d M Y H:ia', strtotime($date));

    if($time == false)
        return date('d M Y', strtotime($date));
    return date($format, strtotime($date));
}

function format_time($time, $timestamp = false)
{
    return date('H:i:s', $time);
}

/**
 * set flash messages for next page load
 * @param string $type
 * @param string $msg
 */
function flash($type = "", $msg = "")
{
    switch ($type) {
        case 'danger':
            $icon = 'exclamation';
            break;
        case 'success':
            $icon = 'check';
            break;
        case 'info':
            $icon = 'info';
            break;
        case 'warning':
            $icon = 'warning';
            break;
        default:
            $icon = 'info';
            break;
    }
    if($type == "error")
        $type = "danger";
    $ci = &get_instance();
    if(validation_errors()) {
        if($msg == "") {
            $e = validation_errors('<div class="alert alert-danger alert-dismissable"><span class="fa fa-exclamation-triangle"></span>', '</div>');
            $msg = $e;
            $type = 'error';
            $icon = 'danger';
        }
    } else {
        $msg = '<div class="alert alert-'.$type.' alert-dismissable"><span class="fa fa-info"></span>'.$msg.'</div>';
    }

    $ci->session->set_flashdata('message', $msg);
    $ci->session->set_flashdata('type', $type);
    $ci->session->set_flashdata('icon', $icon);


//        $tempdata = array(
//            'message' => $msg,
//            'type' =>$type,
//            'icon'=>$icon);
//
//        $ci->session->set_tempdata($tempdata, NULL, 4);
}

/**
 * set session to redirect previous
 */
function setRedirect()
{
    $ci = &get_instance();
    if(isset($_SERVER['HTTP_REFERER'])) {
        $ci->session->set_userdata('last_page', $_SERVER['HTTP_REFERER']);
    } else {
        $ci->session->set_userdata('last_page', base_url());
    }
}

/**
 * @return mixed
 */
function last_page()
{
    return $_SERVER['HTTP_REFERER'];
}

/**
 * redirect to previous page
 */
function redirectPrev($msg = array(),$tab ='')
{
    $ci = &get_instance();
    if(!empty($msg)) {
        flash('info', $msg);
    }
    if(!empty($tab))
        $tab = '#'.$tab;

    redirect($ci->session->userdata('last_page').$tab);
}

/**
 * Check if user is in a group
 * @param $group
 * @return bool
 */
function is($group)
{
    $ci = &get_instance();
    auth(true);

    if($ci->ion_auth->in_group($group))
        return true;
    return false;
}

/**
 * check if authenticated or send to login
 * @return bool
 */
function auth($redirect = false)
{
    if(logged_in() == true) {
        return true;
    } else {
        if($redirect)
            redirect('auth/login', 'refresh');
        return false;
    }
}

/**
 * check if you is in requested group
 * @param $id
 * @param $group
 * @return bool
 */
function in_group($id, $group)
{
    $ci = &get_instance();
    $query = $ci->db
        ->where('users_groups.user_id', $id)
        ->where('groups.name', $group)
        ->from('groups')
        ->join('users_groups', 'users_groups.group_id=groups.id')
        ->count_all_results();
    if($query>0)
        return true;
    return false;
}

/**
 * @param $option
 * @param $value
 * @return bool|string
 */
function selected_option($option, $value)
{
    if($option == $value) {
        return 'selected';
    }
    return false;
}

/**
 * @param $option
 * @param $value
 * @return bool|string
 */
function checked_option($option, $value)
{
    if($option == $value) {
        return 'checked';
    }
    return false;
}

function related($db, $field1, $value1, $field2, $value2)
{
    $ci = &get_instance();
    $res = $ci->db->where($field1, $value1)
        ->where($field2, $value2)
        ->get($db)->result();
    if(count((array)$res)>0) {
        return true;
    }
    return false;

}

/*
* encrypt
* encrypt text
* @params string
* @return string
*/
function encrypt($msg)
{
    $ci = &get_instance();
    $ci->conf->check_encrypt_key();
    return $ci->encryption->encrypt($msg);
}

/*
* decrypt
* decrypt text
* @params string
* @return string
*/
function decrypt($msg)
{
    $ci = &get_instance();
    $ci->conf->check_encrypt_key();
    return $ci->encryption->decrypt($msg);
}

/**
 * @return bool
 */
function logged_in()
{
    $ci = &get_instance();
    if($ci->ion_auth->logged_in() == true)
        return true;
    return false;
}


/*
* log events to database
* logs changes made by users
* @param string
* @return boolean
*/
function logEvent($event)
{
    $ci = &get_instance();
    $data = array(
        'user_id' => $ci->users->uid(),
        'date' => time(),
        'event' => $event
    );
    if($ci->db->insert('event_log', $data))
        return true;
    return false;
}

/**
 * Allow specific group to access
 * @param $g
 * @return bool
 */
function allow($group)
{
    $ci = &get_instance();
    auth(true);
    $groups = explode(',', $group);
    $data = array();
    for ($i = 0; $i<count($groups); $i++) {
        if($ci->ion_auth->in_group($groups[$i]) == true) {
            $data = array('1' => 1);
            break;
        }
    }
    if(empty($data)) {
        flash('danger', lang('access_denied'));
        if($ci->input->is_ajax_request()) {
            return 'error';
        }
        redirectPrev('ajax');
        exit();
    } else {
        return true;
    }

}


/*
* msg()
* @params $type, $msg
* call status messages
*/
function page($page, $data = array())
{
    $ci = &get_instance();
    $data['page'] = $page;
    if(is('parent')) {
        $ci->load->view('layouts/parent-template', $data);
    } else {
        $ci->load->view('layouts/admin-template', $data);
    }
}

function parents_page($page, $data = array())
{
    $ci = &get_instance();
    $data['page'] = $page;

}

function demo()
{
    $ci = &get_instance();

    $seg1 = $ci->uri->segment(1);
    $seg2 = $ci->uri->segment(2);
    $seg3 = $ci->uri->segment(3);
    $seg4 = $ci->uri->segment(4);

    if($ci->users->uid()>0) {
        if(get_option('demo_mode') == 1) {
            $ci->load->helper('language');

            //prevent all post methods
            if(!is('super')) {
                if($ci->input->server('REQUEST_METHOD') == 'POST' && $seg1 !== "child") {
                    flash('danger', lang('feature_disabled_in_demo'));
                    redirectPrev();
                }
            }
            //prevent delete
            if(strstr($seg1, 'delete')
                || strstr($seg2, 'delete')
                || strstr($seg3, 'delete')
                || strstr($seg4, 'delete')
                || strstr($seg4, 'remove')
            ) {
                flash('danger', lang('feature_disabled_in_demo'));
                redirectPrev();
            }
        }
    }
}

/*
* check if system is in maintenance mode
* @params 0
* redirect to prev
*/
function maintenance()
{
    $ci = &get_instance();

    if(get_option('maintenance_mode') == 1 && !is('admin')) {
        $ci->load->helper('language');
        die('<div style="color:red; font-size:26px; text-align:center; font-family:Tahoma; width: 600px; margin: 0 auto;">'
            .lang('maintenance_mode').'
</div>');
    }
}

/**
 * Lang override default and return text even if not translation found
 *
 * Fetches a language variable and optionally outputs a form label
 *
 * @param    string $text The language line
 * @param    string $for The "for" value (id of the form element)
 * @param    array $attributes Any additional HTML attributes
 * @return    string
 */
function lang($text, $for = '', $attributes = array())
{
    $line = get_instance()->lang->line($text);
    if($for !== '') {
        $line = '<label for="'.$for.'"'._stringify_attributes($attributes).'>'.$line.'</label>';
    }
    if($line == "") {
        $text = str_replace('_', ' ', $text);
        $text = ucwords($text);
        return $text;
    }

    return $line;
}

/**
 * dump and die
 *
 * @param $array
 */
function dd($array)
{
    print_r($array);
    die();
}

/**
 * @param $num
 * @return mixed
 */
function uri_segment($num)
{
    $ci = &get_instance();
    return $ci->uri->segment($num);
}

/**
 * @param $page
 * @return string
 */
function set_active($page)
{
    $uri = uri_string();
    if(is_array($page)) {
        $uri = uri_segment(1);
        if(in_array($uri, $page))
            return 'active';
    }
    return ($page == $uri) ? 'active' : '';
}

function moneyFormat($amount)
{
    return get_option('currency_symbol').number_format($amount, 2);
}

function authorizedToChild($staff_id, $child_id)
{
    if(is('admin') || is('manager'))
        return true;
    $ci = &get_instance();

    //test staff assigment
    $staff = $ci->db
        ->from('child_room')
        ->join('child_room_staff', 'child_room_staff.room_id=child_room.room_id')
        ->where('child_room_staff.user_id', $staff_id)
        ->where('child_room.child_id', $child_id)
        ->count_all_results();
    if($staff>0)
        return true;

    //test parent
    $parent = $ci->db->from('child_parents')
        ->where('child_id', $child_id)
        ->where('user_id', $staff_id)
        ->count_all_results();
    if($parent>0)
        return true;

    return false;
}

function valid_date($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
//    return $d && $d->format($format) === $date;
    return true;
}

/**
 * @param $in
 * @param $out
 * @return string
 */
function checkinTimer($in, $out)
{
    $start = new DateTime($in);
    $end = new DateTime($out);
    $timeDiff = $end->diff($start);
//    $strDiff    = $timeDiff->h . " Hours, " . $timeDiff->i . " Minutes";
    return $timeDiff;
}

function special_options()
{
    $options = array(
        'company_name', 'slogan',
        'email', 'phone', 'fax', 'street', 'street2', 'city', 'state', 'postal_code', 'country',
        'timezone', 'google_analytics', 'currency_symbol', 'date_format',
        'allow_registration', 'allow_reset_password', 'enable_captcha',
        'demo_mode', 'maintenance_mode', 'use_smtp', 'smtp_user', 'smtp_pass', 'smtp_host', 'smtp_port',
        'logo', 'invoice_logo',
        'stripe_pk_live', 'stripe_sk_live', 'stripe_pk_test', 'stripe_sk_test', 'paypal_email', 'paypal_locale'
    );
    return $options;
}

function protected_special_option($option)
{
    if(in_array($option, special_options())) {
        return true;
    }
    return false;
}

/**
 * retrieve option in options table
 *
 * @param $name
 * @return string
 */
function get_option($name, $default = '')
{
    $ci = &get_instance();
    $name = trim($name);
    if($ci->db->table_exists('options')) {
        $res = $ci->db->where('option_name', $name)
            ->limit(1)
            ->get('options');
    } else {
        return '';
    }
    if($res->num_rows()>0) {
        $value = $res->row()->option_value;
        if(empty($value))
            return $default;

        $data = @unserialize($value);
        if($value === 'b:0;' || $data !== false) {
            return unserialize($value);
        } else {
            return $value;
        }
    }
    return $default;
}

/**
 * sets an option in options table
 *
 * @param $name
 * @param $value
 * @return bool
 */
function add_option($name, $value, $special = false)
{
    if(empty($name))
        return false;

    if($special == false && protected_special_option($name)) {
        flash('error', sprintf(lang('You are using a protected option'), $name));
        return false;
    }

    if(is_object($value))
        $value = clone $value;

    if(is_array($value))
        $value = serialize($value);

    $ci = &get_instance();
    $ci->db->insert('options', [
        'option_name' => $name,
        'option_value' => $value
    ]);
    if($ci->db->affected_rows()>0)
        return true;
    return false;
}

/**
 * updates an option in options table
 *
 * @param $name
 * @param $value
 * @return bool
 */
function update_option($name, $value, $special = false)
{
    if(empty($name))
        return false;

    if(is_object($value))
        $value = clone $value;

    if(is_array($value))
        $value = serialize($value);

    $ci = &get_instance();
    $test = $ci->db->where('option_name', $name)->from('options')->count_all_results();
    if($test>0) {
        $ci->db->where('option_name', $name);
        $ci->db->update('options', ['option_value' => $value]);
        if($ci->db->affected_rows()>0)
            return true;
    } else {
        add_option($name, $value, $special);
    }
    return false;
}

/**
 * @param $name
 * @return bool
 */
function remove_option($name)
{
    if(empty($name))
        return false;

    if(protected_special_option($name)) {
        flash('error', sprintf(lang('You are using a protected option'), $name));
        return false;
    }
    $ci =& get_instance();
    $ci->db->where('option_name', $name)->delete('options');
    return true;
}

function email_config()
{
    if(get_option('use_smtp') == 1) {
        $config['protocol'] = 'smtp'; //sendmail, smtp, mail
        $config['smtp_host'] = get_option('smtp_host');
        $config['smtp_user'] = get_option('smtp_user');
        $config['smtp_pass'] = get_option('smtp_pass');
        $config['smtp_port'] = get_option('smtp_port');
    } else {
        $config['protocol'] = 'mail';
    }
    $config['mailtype'] = 'html';
    //do not change
    $config['crlf'] = "\r\n";
    $config['newline'] = "\r\n";
    return $config;
}

function g_decor($name)
{
    switch ($name) {
        case 'admin':
            return 'danger';
            break;
        case 'manager':
            return 'success';
            break;
        case 'staff':
            return 'primary';
            break;
        case 'parent':
            return 'default';
            break;
        default:
            return 'warning';
            break;
    }
}

function blood_types()
{
    $types = [
        'A-', 'A+', 'B-', 'B+', 'AB-', 'AB+', 'O-', 'O+'
    ];
    $res = array();
    foreach ($types as $type) {
        $res[$type] = $type;
    }
    return $res;
}

if(!function_exists('assets()')) {
    function assets($item = '')
    {
        return base_url().'assets/'.$item;
    }
}

function user_id(){
    $ci = &get_instance();
    return $ci->session->userdata('user_id');
}
?>