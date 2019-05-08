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
        $password = $this->ion_auth->hash_password($this->input->post('password'));
        $activation_code = $this->generate_activation_code();
        $email = $this->input->post('email');

        $query = $this->db->get_where('users', array(
            'activation_code' => $activation_code
        ));
        $count = $query->num_rows();
        if ($count !== 0) {
            $activation_code = $this->generate_activation_code();
        }
        $data = array(
            'name' => $this->input->post('name'),
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
        $this->db->insert('users', $data);

        $insert_id = $this->db->insert_id();
        $group_id = 5;

        $users_groups = array(
            'user_id' => $insert_id,
            'group_id' => $group_id
        );
        $this->db->insert('users_groups', $users_groups);
        $this->send_confirmation_email($email, $activation_code);
    }

    public function generate_activation_code()
    {
        $this->load->helper('string');
        $activation_code = random_string('alnum', 30);
        return $activation_code;
    }

    public function send_confirmation_email($user_email, $activation_code){
        $this->load->config('email');
        $this->load->library('email');
        
        $data = array(
            'activation_code' => $activation_code
        );
        $this->email->set_mailtype('html');
        $from = $this->config->item('smtp_user');
        $to = $user_email;
        $this->email->from($from, 'Daycare');
        $this->email->to($to);
        $this->email->subject('Email verification');

        $body= $this->load->view('owner_email/confirm_email', $data, true);
        $this->email->message($body);        //Send mail
        if($this->email->send()){
            $this->session->set_flashdata("success","Verification email is sent successfully.");            
        }
        else{
            $this->session->set_flashdata("error","Enable to sent verification email. Please try again.");
        }
        redirect('user/register');
    }
}
