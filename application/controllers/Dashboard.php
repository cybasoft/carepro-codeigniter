<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

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
        $daycare_id = $this->session->userdata('owner_daycare_id');
        $this->load->model('my_invoice', 'invoice');
        $all_daycares = $this->db->select('dy.*,us.email')
                        ->from('daycare as dy')
                        ->join('users as us','us.daycare_id = dy.id')->group_by('dy.id')
                        ->get()->result_array();                       
        $all_users = $this->db->select('us.*,ug.*')
                     ->from('users as us')
                     ->join('users_groups as ug','ug.user_id = us.id')
                     ->where('group_id', 1)
                     ->get()->result_array();
        if ($daycare_id === NULL) {
            if (is(['super', 'admin', 'manager'])) {
                page('dashboard/home');
            } elseif (is('parent')) {
                $children = $this->parent->getChildren();
                page('parent/parent_dashboard', compact('children'));
            } elseif (is('staff')) {
                // redirect('rooms');
                page('parent/parent_dashboard', compact('children'));
            } elseif (is('owner')) {
                page('dashboard/owner', compact('all_daycares','all_users'));
            } else {
                $this->dashboard_page('dashboard/pending', $data = [], $daycare_id);
            }
        } else {
            $daycare_details = $this->db->get_where('daycare', array(
                'daycare_id' => $daycare_id
            ));
            $daycare = $daycare_details->row_array();

            $address_details = $this->db->get_where('address', array(
                'id' => $daycare['address_id']
            ));
            $address = $address_details->row_array();

            if ($daycare['logo'] !== '') {
                $logo = $daycare['logo'];
            } else {
                $logo = '';
            }
            $this->session->set_userdata('company_logo', $logo);
            $this->session->set_userdata('company_name', $daycare['name']);
            if (is(['super', 'admin', 'manager'])) {
                dashboard_page('dashboard/home', compact('daycare', 'address'), $daycare_id);
            } elseif (is('parent')) {
                $children = $this->parent->getChildren();
                dashboard_page('parent/parent_dashboard', compact('children'), $daycare_id);
            } elseif (is('staff')) {
                // redirect('rooms');
                dashboard_page('dashboard/home', compact('daycare', 'address'), $daycare_id);
            } elseif (is('owner')) {
                page('dashboard/owner', compact('all_daycares','all_users'));
            } else {
                dashboard_page('dashboard/pending', $data = [], $daycare_id);
            }
        }
    }

    function lockscreen()
    {
        $this->conf->setTimer(1);
        if (auth(true)) {
            //check cookie
            $this->load->view('dashboard/lockscreen');
        }
    }

    //todo suspend the previous session and create new using pin
    //todo encrypt pin
    function login()
    {
        $this->form_validation->set_rules('pin', lang('pin'), 'required|trim|xss_clean');
        if ($this->form_validation->run() == true) {
            $pin = $this->input->post('pin');
            $this->db->where('id', $this->user->uid());
            $users = $this->db->get('users')->row_array();
            $user_password = $users['password'];
            if (password_verify($pin, $user_password)) {
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
