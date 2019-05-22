<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->title = lang('dashboard');
        auth(true);
    }

    /*
     * default pagek
     */
    function index()
    {        
        $this->load->model('my_invoice', 'invoice');

        if(is(['super','admin','manager'])) {
            page('dashboard/home');

        } elseif(is('parent')) {
            $children = $this->parent->getChildren();
            page('parent/parent_dashboard', compact('children'));

        } elseif(is('staff')) {
            redirect('rooms');

        } else {
            page('dashboard/pending');
        }
    }

    function lockscreen()
    {
        $this->conf->setTimer(1);
        if(auth(true)) {
            //check cookie
            $this->load->view('dashboard/lockscreen');
        }
    }

//todo suspend the previous session and create new using pin
//todo encrypt pin
    function login()
    {
        $this->form_validation->set_rules('pin', lang('pin'), 'required|trim|xss_clean');
        if($this->form_validation->run() == true) {
            $pin = $this->input->post('pin');
            $this->db->where('id', $this->user->uid());
            $this->db->where('pin', $pin);
            if($this->db->get('users')->num_rows()>0) {
                $msg = lang('Welcome back');
                $status = 'success';
                $this->conf->setTimer(0);
            } else {
                $this->conf->setTimer(1);
                $msg = lang('Invalid pin!');
                $status = 'error';
            }
        } else {

            $msg = strip_tags(trim(validation_errors()));
            $status = 'error';
        }
        $status = strip_tags($status);
        $msg = strip_tags($msg);
        flash($status, $msg);
    }

}