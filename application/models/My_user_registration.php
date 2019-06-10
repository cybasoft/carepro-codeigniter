<?php

class My_user_registration extends CI_Model
{
    //store owner data
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
            'email' => $email,
        );
        $this->session->set_userdata($session_data);

        $query = $this->db->get_where('users', array(
            'activation_code' => $activation_code
        ));
        $count = $query->num_rows();
        if ($count !== 0) {
            $activation_code = $this->generate_activation_code();
        }       

        //get plan details
        $get_plan = $this->db->get_where('subscription_plans',array(
            'plan' => $this->session->userdata('plan'),
        ));
        $selected_plan = $get_plan->result();

        //get user status detail
        $get_status = $this->db->get('user_status');
        $owner_status = $get_status->result_array();

        $data = array(
            'name' => $user_name,
            'email' => $email,
            'password' => $password,
            'activation_code' => $activation_code,
            'selected_plan' => $selected_plan[0]->id,          
            'owner_status' => $owner_status[0]['id'],
            'active' => 0
        );
        $status = $this->send_confirmation_email($email,$user_name,$activation_code,$data);
        return $status;
    }

    //generate activation code for email verification
    public function generate_activation_code()
    {
        $this->load->helper('string');
        $activation_code = random_string('alnum', 30);
        return $activation_code;
    }
    public function insert_user($data, $activation_code){
        $user_data = array(
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'activation_code' => $activation_code,
            'selected_plan' => $data['selected_plan'],
            'owner_status' => $data['owner_status'],
            'active' => 0
        );
        $this->db->insert('users', $user_data);

        $insert_id = $this->db->insert_id();
        $group_id = 1;

        $users_groups = array(
            'user_id' => $insert_id,
            'group_id' => $group_id
        );
        $this->db->insert('users_groups', $users_groups);
    }

    //send confirmation email to owner
    public function send_confirmation_email($user_email,$user_name, $activation_code,$data){        
        $this->load->config('email');
        $this->load->library('email');

        $email_data = array(
            'activation_code' => $activation_code,
            'user_name' => $user_name,
            'registered_success' => '',
            'payment_success' => ''
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
            $this->insert_user($data,$activation_code);
            $status = array(
                'success' => $user_name,
                'error' => ''
            );
            return $status;            
        }   
        else{
            $status = array(
                'success' => '',
                'error' => 'error'
            );
            return $status;            
        }
    }
}
