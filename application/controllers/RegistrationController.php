<?php
use phpDocumentor\Reflection\Types\Null_;

if (!defined('BASEPATH')) exit('No direct script access allowed');

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
        $this->load->view('registration/index');
    }

    public function plan()
    {
        $price = $this->input->post('price');
        $plan = $this->input->post('plan');
        $data = array(
            'plan' => $plan,
            'price' => $price
        );
        $this->session->set_userdata($data);
        redirect('user/register');
    }

    //owner registration
    public function create()
    {
        $tables = $this->config->item('tables', 'ion_auth');

        $this->form_validation->set_rules('name', lang('name'), 'required|xss_clean|min_length[2]');
        $this->form_validation->set_rules('email', lang('email'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]',array('is_unique', 'This Email is already registered.'));
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
            $status = $this->My_user_registration->store_user();            
            if($status['success'] !== ''){
                $this->load->view('registration/success' ,$status);
            }elseif($status['error'] !== ''){
                $this->session->set_flashdata("verify_email_error","Unable to send verification Email. Please try again.");
            redirect('user/register');
            }
        } else {
            set_flash(['email', 'name', 'address_line_1', 'address_line_2', 'city', 'state', 'zip_code', 'country', 'phone', 'password']);
            validation_errors();
            flash('danger');
            redirect('user/register');
        }
    }

    //subscription  page
    public function subscription()
    {
        $this->output->cache(0);        
        $this->load->view('registration/subscription_page');
    }

    //create parent
    public function create_parent($daycare_id = NULL)
    {
        $tables = $this->config->item('tables', 'ion_auth');

        $this->form_validation->set_rules('first_name', lang('first_name'), 'required|xss_clean|min_length[2]');
        $this->form_validation->set_rules('last_name', lang('last_name'), 'required|xss_clean|min_length[2]');
        $this->form_validation->set_rules('email', lang('email'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]',array('is_unique', 'This Email is already registered.'));
        $this->form_validation->set_rules('phone', lang('phone'), 'required|xss_clean');
        $this->form_validation->set_rules('password', lang('password'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', lang('password_confirm'), 'required');

        if ($this->form_validation->run() == true) {
            $this->My_parent_registration->store_parent($daycare_id);
        } else {
            set_flash(['email', 'first_name', 'last_name', 'phone', 'password']);
            validation_errors();
            flash('danger');
            redirect($daycare_id . '/register');
        }
    }
}
