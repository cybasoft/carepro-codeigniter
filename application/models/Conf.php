<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Conf extends CI_Model
{

    function __construct()
    {
//        reload_company();
        init_company();
//        dd(session('company_top_nav_bg_color'));

        if(!empty(session('timezone')))
            date_default_timezone_set(session('timezone'));
        else
            date_default_timezone_set('America/New_York');

        $this->load->model('My_child', 'child');
        $this->load->model('My_user', 'user');
        $this->load->model('My_cron', 'cron');
        $this->load->model('My_mailer', 'mailer');
        $this->load->model('My_rooms', 'rooms');
        $this->load->model('My_parent', 'parent');

        //disable changes to db in demo mode
        demo();
        //check if site in in maintenance
        maintenance();
        //enforce encryption
        //$this->check_encrypt_key();
        setRedirect(); //remember current page

        //enable profiler in dev
        if(ENVIRONMENT == 'testing') {
            $this->output->enable_profiler(TRUE);
//            $this->console->exception(new Exception('test exception'));
//            $this->console->debug('Debug message');
//            $this->console->info('Info message');
//            $this->console->warning('Warning message');
//            $this->console->error('Error message');
            $this->console->info($this->session->userdata);
        }
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
     *
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

    function stripImage($text)
    {
        $text = preg_replace("/<img[^>]+./", " ", $text);
        $text = str_replace(']]>', ']]>', $text);
        return $text;
    }
}