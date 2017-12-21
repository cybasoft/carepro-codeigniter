<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @file      : landing.php
 * @author    : JMuchiri
 * @Copyright 2017 A&M Digital Technologies
 */
class Landing extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        setRedirect();
    }

    function page($page, $data = array())
    {
        $this->load->view('landing/header');
        $this->load->view('landing/' . $page, $data);
        $this->load->view('landing/footer');

    }

    function index()
    {
        $this->page('login');
    }

    function load($page)
    {
        $this->page($page);
    }

    public function reg($username, $password, $email, $additional_data = array(), $groups = array())
    {
        $this->store_salt = $this->config->item('store_salt', 'ion_auth');
        $this->load->model('ion_auth_model');
        $this->ion_auth->trigger_events('pre_register');
        $manual_activation = $this->config->item('manual_activation', 'ion_auth');
        if ($this->ion_auth->email_check($email)) {
            $this->ion_auth->set_error('account_creation_duplicate_email');
            return FALSE;
        }

        // IP Address
        $ip_address = $this->input->ip_address();
        $salt = $this->store_salt ? $this->salt() : FALSE;
        $password = $this->ion_auth->hash_password($password, $salt);
        // Users table.
        $data = array(
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'ip_address' => $ip_address,
            'created_on' => time(),
            'last_login' => time(),
            'active' => ($manual_activation === false ? 1 : 0)

        );
        if ($this->ion_auth->store_salt) {
            $data['salt'] = $salt;
        }
        //filter out any data passed that doesnt have a matching column in the users table
        //and merge the set user data and the additional data
        $user_data = array_merge($this->ion_auth->_filter_data('users', $additional_data), $data);
        $this->ion_auth->trigger_events('extra_set');
        $this->db->insert('users', $user_data);
        $id = $this->db->insert_id();
        //create data

        $this->db->insert('user_data', array('user_id' => $id));
        if (!empty($groups)) {
            //add to groups
            foreach ($groups as $group) {
                $this->ion_auth->add_to_group($group, $id);

            }
        }
        //add to default group if not already set
        $default_group = $this->ion_auth->where('name', $this->config->item('default_reg_group', 'ion_auth'))->group()->row();
        if ((isset($default_group->id) && empty($groups)) || (!empty($groups) && !in_array($default_group->id, $groups))) {
            $this->ion_auth->add_to_group($default_group->id, $id);
        }
        $this->ion_auth->trigger_events('post_register');
        return (isset($id)) ? $id : FALSE;
    }

    public function subscribe()
    {
        $this->load->library('email');
        $this->form_validation->set_rules('email', lang('email'), 'required|trim|xss_clean|valid_email');
        if ($this->form_validation->run() == true) {

            $email = $this->input->post('email');
            $this->email->from($email, 'DaycarePRO Visitor');
            $this->email->to('amdtllc@gmail.com');
            $this->email->subject('Mailing list subscription: DaycarePro');
            $this->email->message('No content');
            if ($this->email->send()) {
                flash('success', 'Thank you! We will keep you in the loop of what is happening here!');
            } else {
                flash('danger', 'An error has occurred! Please try again');
            }

        } else {
            validation_errors();
            flash('danger');
        }
        redirectPrev();
        //echo $this->email->print_debugger();

    }

    function send_mail()
    {
        $this->load->library('email');
        $this->form_validation->set_rules('name', lang('name'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('email', lang('email'), 'required|trim|xss_clean|valid_email');
        $this->form_validation->set_rules('subject', 'Subject', 'required|trim|xss_clean');
        $this->form_validation->set_rules('message', 'Message', 'required|trim|xss_clean');
        if ($this->form_validation->run() == true) {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $subject = $this->input->post('subject');
            $message = $this->input->post('message');
            $this->email->from($email, $name);
            $this->email->to('amdtllc@gmail.com');
            $this->email->subject($subject);
            $this->email->message($message);
            if ($this->email->send()) {
                flash('success', 'Thank you! Your message has been sent!');
            } else {
                flash('danger', 'An error has occurred! Please try again or contact us by another means');
            }
        } else {
            validation_errors();
            flash('danger');
        }
        redirectPrev();
    }

    function error404()
    {
        if (logged_in()) :
            page('errors/404_in');
        else :
            $this->load->view('landing/header');
            $this->load->view('errors/404');
            $this->load->view('landing/footer');
        endif;
    }

    function error500()
    {
        if (logged_in()) :
            page('errors/500_in');
        else :
            $this->load->view('landing/header');
            $this->load->view('errors/500');
            $this->load->view('landing/footer');
        endif;

    }


}