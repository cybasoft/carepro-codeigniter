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
    function index($daycare_id = NULL)
    {            
        $this->load->model('my_invoice', 'invoice');
        if($daycare_id === NULL){                     
            if(is(['super','admin','manager'])) {
                page('dashboard/home');
    
            } elseif(is('parent')) {
                $children = $this->parent->getChildren();
                page('parent/parent_dashboard', compact('children'));
    
            } elseif(is('staff')) {
                redirect('rooms');
    
            } else {
                $this->dashboard_page('dashboard/pending',$data = [],$daycare_id);
            }
        }else{
            $daycare_details = $this->db->get_where('daycare', array(
                'daycare_id' => $daycare_id
            ));
            $daycare = $daycare_details->row_array();
            if($daycare['logo'] !== ''){
                $logo = $daycare['logo'];
            }else{
                $logo = '';        
            }     
            $this->session->set_userdata('company_logo',$logo);
            if(is(['super','admin','manager'])) {
                page('dashboard/home');
    
            } elseif(is('parent')) {
                $children = $this->parent->getChildren();
                page('parent/parent_dashboard', compact('children'));
    
            } elseif(is('staff')) {
                redirect('rooms');
    
            } else {                
                $this->dashboard_page('dashboard/pending',$data = [],$daycare_id);
            }
        }
    }

    function dashboard_page($page, $data = [],$daycare_id)
    {   
        $ci = &get_instance();
        $data['page'] = $page;
        $data['daycare_id'] = $daycare_id;        
        if(is('parent')) {
            $ci->load->view('layouts/template', $data);
        } else {
            $ci->load->view('layouts/template', $data);
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