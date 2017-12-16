<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Conf extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
        ini_set("error_log", base_url() . 'php-error.log');

        $this->load->model('My_tasks', 'tasks');
        $this->load->model('My_child', 'child');
        $this->load->model('My_user', 'users');
        $this->load->model('My_mailbox', 'mail');
        $this->load->model('My_broadcast', 'broadcast');
        $this->load->model('My_cron', 'cron');

        //init login checks
        $this->loginInit();
        //disable changes to db in demo mode
        $this->demo();
        //check if site in in maintenance
        $this->maintenance();
        //enforce encryption
        $this->check_encrypt_key();
        $this->setRedirect(); //remember current page
    }

    function loginInit()
    {
        if ($this->logged_in() == true) {
            date_default_timezone_set($this->config->item('timezone', 'company'));
        }
    }

    function logged_in()
    {
        if ($this->ion_auth->logged_in() == true)
            return true;
        return false;
    }

    function authenticate()
    {
        if ($this->logged_in() == true) {
            return true;
        } else {
            redirect('login', 'refresh');
            return false;
        }
    }

    function settings()
    {
        return $this->db->get('settings')->row();
    }

    function setting($item)
    {
        return $this->db->get('settings')->row()->$item;
    }

    function demo()
    {
        if ($this->users->uid() > 0) {
            if ($this->settings()->demo_mode == 1) {
                $this->load->helper('language');
                if ($_POST) {
                    $this->msg('danger', lang('feature_disabled_in_demo'));
                    $this->redirectPrev();
                }
            }
        }

    }

    /*
     * page()
     * @params $page $data
     * loads default header, footer and defined view
     */

    function msg($type = "", $msg = "")
    {
        switch ($type) {
            case 'danger':
                $icon = 'exclamation-sign';
                break;
            case 'success':
                $icon = 'ok';
                break;
            case 'info':
                $icon = 'info-sign';
                break;
            case 'warning':
                $icon = 'warning-sign';
                break;
            default:
                $icon = 'info-sign';
                break;
        }

        if (validation_errors() == true && $msg == "") {
            $e = validation_errors('<p class="alert alert-danger alert-dismissable"><span class="fa fa-warning-sign"></span>', '</p>');
            $this->session->set_flashdata('message', '<div class="msg">' . $e . '</div>');
        } else {
            $this->session->set_flashdata(
                'message',
                '<p id="msg" class="msg alert alert-' . $type .
                ' alert-dismissable"><span class="fa fa-' . $icon . '"></span> ' . $msg . '</p>'
            );
        }


    }

    /*
     * setRedirect()
     * @params 0
     * set redirect session
     * to set controller page for redirect use $this->conf->setRedirect();
     **/

    function redirectPrev()
    {
        redirect($this->session->userdata('last_page'));
    }

    /*
     * redirectPrev()
     * @params 0
     * redirect to prev
     */

    function maintenance()
    {
        $this->load->model('My_user', 'user');
        $this->db->where('user_id', $this->users->uid());
        $this->db->where('group_id', 1);
        $result = $this->db->get('users_groups')->num_rows();

        if ($this->settings()->maintenance == 1 && $result <= 0) {
            $this->load->helper('language');
            die('<div style="color:red; font-size:26px; text-align:center; font-family:Tahoma; width: 600px; margin: 0 auto;">'
                . lang('maintenance_mode') . '</div>');

        }
    }

    /*
     * msg()
     * @params $type, $msg
     * call status messages
     */

    function version()
    {
        return '1.0.11';
    }

    function page($page, $data = array())
    {
        $data['page'] = $page;

        $this->load->view('index', $data);
    }

    function setRedirect()
    {
        if (isset($_SERVER['HTTP_REFERER'])) {
            $this->session->set_userdata('last_page', $_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_userdata('last_page', base_url());
        }
    }

    /*
     * isAdmin()
     * super admins
     */
    function isAdmin()
    {
        $this->authenticate();
        //if($this->ion_auth->is_admin()) {
        $group = 'admin';
        if ($this->ion_auth->in_group($group))
            return true;
        return false;
    }

    /*
     * isManager()
     * daycare owners
     */
    function isManager()
    {
        $this->authenticate();
        $group = 'manager';
        if ($this->ion_auth->in_group($group))
            return true;
        return false;
    }

    /*
     * isStaff
     */
    function isStaff()
    {
        $this->authenticate();
        $group = 'staff';
        if ($this->ion_auth->in_group($group))
            return true;
        return false;
    }

    /*
     * isParent()
     */
    function isParent()
    {
        $this->authenticate();
        $group = 'parent';
        if ($this->ion_auth->in_group($group))
            return true;
        return false;
    }

    /*
     * super
     */
    function isSuper()
    {
        $this->authenticate();
        $group = 'super';
        if ($this->ion_auth->in_group($group))
            return true;
        return false;
    }

    function in_group($id, $group)
    {
        $this->db->where('users_groups.user_id', $id);
        $this->db->where('groups.name', $group);
        $this->db->select('*');
        $this->db->from('groups');
        $this->db->join('users_groups', 'users_groups.group_id=groups.id');
        $query = $this->db->get();
        if ($query->num_rows > 0)
            return true;
        return false;
    }
    /*
     * restrict access to user groups
     */
    //todo use one time page auth
    function restrict_to($group)
    {
        switch ($group) {
            case 'admin':
                if ($this->isAdmin() == false) $this->redirectPrev();
                break;
            case 'manager':
                if ($this->isManager() == false) $this->redirectPrev();
                break;
            case 'staff':
                if ($this->isStaff() == false) $this->redirectPrev();
                break;
            case 'parent':
                if ($this->isParent() == false) $this->redirectPrev();
                break;
        }
    }

    function allow($g)
    {
        $this->authenticate();

        $groups = explode(',', $g);
        $data = array();
        for ($i = 0; $i < count($groups); $i++) {
            if ($this->ion_auth->in_group($groups[$i]) == true) {
                $data = array('1' => 1);
                break;
            }

        }

        if (empty($data)) {
            $this->conf->msg('danger', lang('access_denied'));
            $this->redirectPrev();
            exit();
        } else {
            return true;
        }

    }


    function sess($item)
    {
        return $this->session->userdata($item);
    }

    function db_read($db, $id, $item)
    {
        $this->db->where('id', $id);
        $this->db->limit(1);
        foreach ($this->db->get($db)->result() as $row) {
            return $row->$item;
        }
        return '';
    }

    function totalRecords($db, $data = array())
    {
        if (!empty($data)) {
            foreach ($data as $field => $key) {
                $this->db->where($field, $key);
            }
        }
        $query = $this->db->get($db);
        return $query->num_rows();
    }

    function checked_option($option, $value)
    {
        if ($option == $value) {
            return 'checked';
        }
        return false;
    }

    function selected_option($option, $value)
    {
        if ($option == $value) {
            return 'selected';
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
        $this->check_encrypt_key();
        return $this->encryption->encrypt($msg);
    }


    /*
     * decrypt
     * decrypt text
     * @params string
     * @return string
     */
    function decrypt($msg)
    {
        $this->check_encrypt_key();
        return $this->encryption->decrypt($msg);
    }

    /*
     * check_encrypt_key
     * verify encryption key is set
     * @params none
     * @return void
     */
    function check_encrypt_key()
    {
        $this->load->helper('language');
        if ($this->logged_in()) {
            if (empty($this->config->item('encryption_key'))) {
                $this->msg('danger', lang('encryption_key_warning'));
                //redirect('admin#settings');
            }
        }
    }

    /*
     * log
     * logs changes made by users
     * @param string
     * @return boolean
     */
    function log($event)
    {
        $data = array(
            'user_id' => $this->users->uid(),
            'date' => time(),
            'event' => $event
        );
        if ($this->db->insert('event_log', $data))
            return true;
        return false;
    }

}