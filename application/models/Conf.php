<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Conf extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
        ini_set("error_log", base_url().'php-error.log');
        if(get_option('timezone') !== "")
            date_default_timezone_set(get_option('timezone'));

        $this->load->model('My_child', 'child');
        $this->load->model('My_user', 'users');
        $this->load->model('My_user', 'user');
        $this->load->model('My_cron', 'cron');
        $this->load->model('My_mailer', 'mailer');
        $this->load->model('My_rooms', 'rooms');

        //disable changes to db in demo mode
        demo();
        //check if site in in maintenance
        maintenance();
        //enforce encryption
        $this->check_encrypt_key();
        setRedirect(); //remember current page
    }


    /*
     * msg()
     * @params $type, $msg
     * call status messages
     */
    function page($page, $data = array())
    {
        $data['page'] = $page;
        $this->load->view('index', $data);
    }

    /**
     * @param $db
     * @param $id
     * @param $item
     * @return string
     */
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
        if(!empty($data)) {
            foreach ($data as $field => $key) {
                $this->db->where($field, $key);
            }
        }
        $query = $this->db->get($db);
        return $query->num_rows();
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
        if(logged_in()) {
            if(empty($this->config->item('encryption_key'))) {
                flash('danger', lang('encryption_key_warning'));
                //redirect('admin#settings');
            }
        }
    }

    //lockscreen timer
    function setTimer($time = 1)
    {
        $cookie = array(
            'name' => 'timer',
            'value' => $time,
            'expire' => '86500',
            'path' => '/',
            'secure' => TRUE
        );
        $this->input->set_cookie($cookie);

    }

    function getTimer()
    {
        $this->input->cookie('timer');
    }

}