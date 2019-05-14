<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class RegistrationController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('My_user_registration');
        $this->load->model('My_daycare_registration');
        $this->load->model('My_parent_registration');
        $this->load->helper('url_helper');
    }
    public function index()
    {
       $price = $this->input->post('price');
       $plan = $this->input->post('plan');
       $session_data = array(
        'plan' => $plan,
        'price' => $price
       );
       $this->session->set_userdata($session_data);
       $this->load->view('registration/index');
    }

    //owner registration
    public function create()
    {
        $tables = $this->config->item('tables', 'ion_auth');

        $this->form_validation->set_rules('name', lang('name'), 'required|xss_clean|min_length[2]');
        $this->form_validation->set_rules('email', lang('email'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
        $this->form_validation->set_rules('password', lang('password'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', lang('password_confirm'), 'required');
        $this->form_validation->set_rules('phone', lang('phone'), 'required|xss_clean');
        $this->form_validation->set_rules('address_line_1', lang('address_line_1'), 'required|xss_clean');
        $this->form_validation->set_rules('city', lang('city'), 'required|xss_clean');
        $this->form_validation->set_rules('state', lang('state'), 'required|xss_clean');
        $this->form_validation->set_rules('zip_code', lang('zip_code'), 'required|xss_clean');
        $this->form_validation->set_rules('country', lang('country'), 'required|xss_clean');
        $this->form_validation->set_rules('phone', lang('phone'), 'required|xss_clean');

        if ($this->form_validation->run() == true) {
            $this->My_user_registration->store_user();
        } else {
            set_flash(['email', 'name', 'address_line_1', 'address_line_2', 'city', 'state', 'zip_code', 'country', 'phone', 'password']);
            validation_errors();
            flash('danger');
            redirect('user/register');
        }
    }

    //daycare registration
    public function daycare_register()
    {
        $this->load->view('registration/daycare_register');
    }

    //daycare registration 
    public function store_daycare()
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
            $success_status = $this->My_daycare_registration->store();
            if($success_status === NULL){
                // $this->session->set_flashdata("message","Daycare registered successfully.");
                // redirect('daycare');
            }else{
                $this->session->set_flashdata("error",$success_status);
                $this->load->view('registration/daycare_register');
            }
        } else {
            set_flash(['name', 'employee_tax_identifier','logo', 'address_line_1', 'address_line_2', 'city', 'state', 'zip_code', 'country', 'phone']);
            validation_errors();
            flash('danger');
            redirect('daycare');
        }
    }
    //function to send verification email
    public function email_verified($activation_code = NULL)
    {
        $owner_status = $this->My_user_registration->status[1];
        $data = array(
            'owner_status' => $owner_status,
        );
        $this->db->where('activation_code', $activation_code);
        $this->db->update('users', $data);

        $query = $this->db->get_where('users', array(
            'activation_code' => $activation_code
        ));
        $check_status = $query->row_array();
        $confirmed = $check_status['owner_status'];
        if ($confirmed === "confirmed"){
            $selected_plan = $this->session->userdata('plan');

            $query = $this->db->get_where('subscription_plans',array(
                'plan' => $selected_plan
            ));
            $plan_details = $query->result();
            $this->load->view('stripe_payment/index' , $plan_details[0]);
        }
    }

    //subscription  page
    public function subscription(){
        $this->load->view('registration/subscription_page');
    }

    //create parent
    public function create_parent($daycare_id = NULL){
        $tables = $this->config->item('tables', 'ion_auth');

        $this->form_validation->set_rules('first_name', lang('first_name'), 'required|xss_clean|min_length[2]');
        $this->form_validation->set_rules('last_name', lang('last_name'), 'required|xss_clean|min_length[2]');
        $this->form_validation->set_rules('email', lang('email'), 'required|valid_email|is_unique['.$tables['users'].'.email]');
        $this->form_validation->set_rules('phone', lang('phone'), 'required|xss_clean');
        $this->form_validation->set_rules('password', lang('password'), 'required|min_length['.$this->config->item('min_password_length', 'ion_auth').']|max_length['.$this->config->item('max_password_length', 'ion_auth').']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', lang('password_confirm'), 'required');
    
        if($this->form_validation->run() == true) {
            $this->My_parent_registration->store_parent($daycare_id);   
            redirect($daycare_id.'/login');
        }else{
            set_flash(['email', 'first_name', 'last_name', 'phone', 'password']);
            validation_errors();
            flash('danger');
            redirect($daycare_id.'/register');
        }
    }
}
