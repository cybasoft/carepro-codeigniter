<?php

class My_user_registration extends CI_Model
{
    public $plans = array(
        'basic' => '0',
        'silver' => '1',
        'gold' => '2'
    );
    public $status = array(
        '0' => 'draft',
        '1' => 'confirmed',
        '2' => 'subscribed',
        '3' => 'registered'
    );
    public function store_user()
    {
        $this->load->model('ion_auth_model');
        $this->load->library('session');

        $password = $this->ion_auth->hash_password($this->input->post('password'));
        $activation_code = $this->generate_activation_code();
        $email = $this->input->post('email');
        $user_name =  $this->input->post('name');
        $session_data = array(
            'user_name' => $user_name,
            'plan' => 0,
            'email' => $email,
            'price' => 35
        );
        $this->session->set_userdata($session_data);

        $query = $this->db->get_where('users', array(
            'activation_code' => $activation_code
        ));
        $count = $query->num_rows();
        if ($count !== 0) {
            $activation_code = $this->generate_activation_code();
        }
        $data = array(
            'name' => $user_name,
            'email' => $email,
            'password' => $password,
            'activation_code' => $activation_code,
            'selected_plan' => '0',
            'address_line_1' => $this->input->post('address_line_1'),
            'address_line_2' => $this->input->post('address_line_2'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'pin' => $this->input->post('zip_code'),
            'country' => $this->input->post('country'),
            'phone' => $this->input->post('phone'),
            'owner_status' => $this->status[0],
        );
        $this->send_confirmation_email($email,$user_name,$activation_code,$data);
    }

    public function generate_activation_code()
    {
        $this->load->helper('string');
        $activation_code = random_string('alnum', 30);
        return $activation_code;
    }
    public function insert_user($data){
        $this->db->insert('users', $data);

        $insert_id = $this->db->insert_id();
        $group_id = 5;

        $users_groups = array(
            'user_id' => $insert_id,
            'group_id' => $group_id
        );
        $this->db->insert('users_groups', $users_groups);
    }
    public function send_confirmation_email($user_email,$user_name, $activation_code,$data){
        $this->load->config('email');
        $this->load->library('email');
        
        $email_data = array(
            'activation_code' => $activation_code,
            'user_name' => $user_name,
        );
        $this->email->set_mailtype('html');
        $from = $this->config->item('smtp_user');
        $to = $user_email;
        $this->email->from($from, 'Daycare');
        $this->email->to($to);
        $this->email->subject('Email verification');

        $body= $this->load->view('owner_email/confirm_email', $email_data, true);
        $this->email->message($body);        //Send mail
        if($this->email->send()){
            $this->session->set_flashdata("verify_email","Please check your email to confirm your account.");
            $this->insert_user($data);
            $this->load->view('registration/success');
        }   
        else{
            $this->session->set_flashdata("verify_email_error","Enable to sent verification email. Please try again.");
            $this->load->view('registration/index');
        }
    }
}
