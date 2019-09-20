<?php
use phpDocumentor\Reflection\Types\Null_;

if (!defined('BASEPATH')) exit('No direct script access allowed');

class DaycareController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('My_daycare_registration');
        $this->load->helper('url_helper');
        $this->load->model('ion_auth_model', 'auth');
    }
    public function index($activation_code = NULL)
    {
        $data['activation_code'] = $activation_code;
        $query = $this->db->get_where('users', array(
            'activation_code' => $activation_code
        ));
        $user_details = $query->row_array();
        $user_status = $user_details['owner_status'];
        $daycare = $user_details['daycare_id'];

        if ($daycare !== NULL) {
            $daycare_details = $this->db->get_where('daycare', array(
                'id' => $daycare
            ));
            $daycare_data = $daycare_details->row_array();
            $daycare_id = $daycare_data['daycare_id'];
        }
        if ($user_status === "3") {
            $this->load->view('registration/daycare_register', $data);
        } elseif ($user_status === "4") {
            redirect('login');
        }
    }

    //daycare registration 
    public function store_daycare($activation_code = NULL)
    {

        $this->form_validation->set_rules('name', lang('name'), 'required|xss_clean|min_length[2]');
        $this->form_validation->set_rules('employee_tax_identifier', lang('employee_tax_identifier'), 'required|xss_clean');
        $this->form_validation->set_rules('address_line_1', lang('address_line_1'), 'required|xss_clean');
        $this->form_validation->set_rules('city', lang('city'), 'required|xss_clean');
        $this->form_validation->set_rules('state', lang('state'), 'required|xss_clean');
        $this->form_validation->set_rules('zip_code', lang('zip_code'), 'required|xss_clean');
        $this->form_validation->set_rules('country', lang('country'), 'required|xss_clean');
        $this->form_validation->set_rules('phone', lang('phone'), 'required|xss_clean');

        if ($this->form_validation->run() == true) {
            $success_status = $this->My_daycare_registration->store($activation_code);
            if($success_status['success'] !== ''){
                $daycare_id = $this->session->userdata('daycare_id');                
                $user_details = $this->db->where('daycare_id',$daycare_id)->get('users');
                $users = $user_details->row_array();               
                $email = $users['email'];
                $password = $users['password'];
                if ($this->ion_auth->login($email, $password)) {
                    redirect('dashboard', 'refresh');
                }  
            }elseif($success_status['error'] !== ''){
                $data['activation_code'] = $activation_code;
                $this->session->set_flashdata("error", $success_status['error']);
                $this->load->view('registration/daycare_register', $data);
            }
            
        } else {
            set_flash(['name', 'employee_tax_identifier', 'logo', 'address_line_1', 'address_line_2', 'city', 'state', 'zip_code', 'country', 'phone']);
            validation_errors();
            flash('danger');
            redirect('daycare');
        }
    }
    //function to send verification email
    public function email_verified($activation_code = NULL)
    {
        $query = $this->db->get_where('users', array(
            'activation_code' => $activation_code
        ));
        $check_status = $query->row_array();
        $selected_plan = $check_status['selected_plan'];
        $user_status = $check_status['owner_status'];
        $daycare = $check_status['daycare_id'];

        $get_status = $this->db->get('user_status');
        $result = $get_status->result_array();

        $query = $this->db->get_where('subscription_plans', array(
            'id' => $selected_plan
        ));
        $plan_details = $query->row_array();
        $plan_data = array(
            'plan' => $plan_details['plan'],
            'children' => $plan_details['children'],
            'staff_members' => $plan_details['staff_members'],
            'calender_events' => $plan_details['calender_events'],
            'news_module' => $plan_details['news_module'],
            'rooms' => $plan_details['rooms'],
            'invoices' => $plan_details['invoices'],
            'files' => $plan_details['files'],
            'price' => $plan_details['price'],
            'activation_code' => $activation_code
        );

        if ($user_status === "1") {

            $owner_status = $result[1]['id'];
            $data = array(
                'owner_status' => $owner_status,
            );
            $this->db->where('activation_code', $activation_code);
            $this->db->update('users', $data);            
            $this->load->view('front/registration/subscribe', $plan_data);
        }
        if ($daycare !== NULL) {
            $daycare_details = $this->db->get_where('daycare', array(
                'id' => $daycare
            ));
            $daycare_data = $daycare_details->row_array();
            $daycare_id = $daycare_data['daycare_id'];
        }

        if ($user_status === "2") {            
            $this->load->view('front/registration/subscribe', $plan_data);
        } elseif ($user_status === "3") {
            redirect('daycare/' . $activation_code);
        } elseif ($user_status === "4") {
            redirect('login');
        }
    }
}
