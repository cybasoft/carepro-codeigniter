<?php defined('BASEPATH') or exit('No direct script access allowed');

class Homepage extends CI_Controller
{

    function index(){
        if ($this->ion_auth->logged_in()) {
           // redirect('dashboard', 'refresh');
        }
        $plans = $this->db->get('subscription_plans')->result_array();
        $data = array(
            'plans' => $plans
        );
        $this->load->view('front/index',$data);
    }
}