<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class RegistrationController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('My_user_registration');
        $this->load->model('My_daycare_registration');
    }
    public function index()
    {
        $this->load->view('registration/index');
    }
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
            redirect('daycare');
        } else {
            set_flash(['email', 'name', 'address_line_1', 'address_line_2', 'city', 'state', 'zip_code', 'country', 'phone', 'password']);
            validation_errors();
            flash('danger');
            redirect('user/register');
        }
    }

    //daycare registration
    public function daycare_register(){
        $this->load->view('registration/daycare_register');
    }

    public function store_daycare(){

        $this->form_validation->set_rules('name', lang('name'), 'required|xss_clean|min_length[2]');
        $this->form_validation->set_rules('employee_tax_identifier', lang('employee_tax_identifier'), 'required|xss_clean');
        $this->form_validation->set_rules('address_line_1', lang('address_line_1'), 'required|xss_clean');
        $this->form_validation->set_rules('city', lang('city'), 'required|xss_clean');
        $this->form_validation->set_rules('state', lang('state'), 'required|xss_clean');
        $this->form_validation->set_rules('zip_code', lang('zip_code'), 'required|xss_clean');
        $this->form_validation->set_rules('country', lang('country'), 'required|xss_clean');
        $this->form_validation->set_rules('phone', lang('phone'), 'required|xss_clean');

        if ($this->form_validation->run() == true) {
            $this->My_daycare_registration->store();
            redirect('payment');
        } else {
            set_flash(['name', 'employee_tax_identifier', 'address_line_1', 'address_line_2', 'city', 'state', 'zip_code', 'country', 'phone']);
            validation_errors();
            flash('danger');
            redirect('daycare');
        }
    }
}