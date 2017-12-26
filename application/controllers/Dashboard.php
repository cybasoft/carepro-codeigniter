<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /*
     * default page
     */
    function index()
    {
        $this->load->model('my_invoice', 'invoice');
        if (auth() == true) {
            if (is('parent')) {
//			    $children = $this->db->get('children');
                //page('modules/family/index',compact('children'));
                echo lang('coming_soon');
                echo anchor('logout', 'logout');
                die();
            } else {
                page('dashboard/home');
            }
        } else {
            redirect('login', 'refresh');
        }
    }

    function lockscreen()
    {
        if (auth())
            $this->load->view('dashboard/lockscreen');
    }
    //todo suspend the previous session and create new using pin
    //todo encrypt pin
    function login()
    {
        $this->form_validation->set_rules('pin', lang('pin'), 'required|trim|xss_clean');
        if ($this->form_validation->run() == true) {
            $pin = $this->input->post('pin');

            $this->db->where('id', $this->user->uid());
            $this->db->where('pin', $pin);
            if ($this->db->get('users')->num_rows() > 0) {
                redirect('dashboard', 'refresh');
            } else {
                $this->setTimer($this->getTimer());
                flash('danger', 'Invalid pin!');;
            }

        } else {
            validation_errors();
            flash('danger');

        }
        redirectPrev();
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