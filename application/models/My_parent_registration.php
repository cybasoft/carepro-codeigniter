<?php if(!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class My_parent_registration extends CI_Model
{
    //store parent
    public function store_parent($daycare_id){
        $this->load->model('ion_auth_model');
        $query = $this->db->get_where('daycare', array(
            'daycare_id' => $daycare_id
        ));
        $result_query = $query->result();
        $owner_id = $result_query[0]->id;
        $password = $this->ion_auth->hash_password($this->input->post('password'));        
        $first_name = $this->input->post('first_name');
        $last_name =$this->input->post('last_name');
        $data = array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'password' => $password,
            'active' => 0,
            'daycare_id' => $owner_id
        );
        $parent_name = $first_name .' '. $last_name;
        $this->send_activation_email($data,$daycare_id,$parent_name);
    }
    //insert parent to database
    public function insert_parent($data){
        $this->db->insert('users', $data);

        $insert_id = $this->db->insert_id();
        $group_id = 4;

        $users_groups = array(
            'user_id' => $insert_id,
            'group_id' => $group_id
        );
        $this->db->insert('users_groups',$users_groups);
    }

    //send activation email to owner for parent self registration
    public function send_activation_email($data,$daycare_id,$parent_name){
        $this->load->config('email');
        $this->load->library('email');
        $daycare_details = $this->db->get_where('daycare',array(
            'daycare_id' => $daycare_id
        ));
        $daycare = $daycare_details->result_array();        

        $user_details = $this->db->get_where('users',array(
            'daycare_id' => $daycare[0]['id']
        ));

        $users = $user_details->row_array();       
        $user_name = $users['name'];
        $user_email = $users['email'];

        $email_data = array(
            'user_name' => $user_name,
            'parent_name' => $parent_name,
            'firstname' => $data['first_name'],
            'lastname' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'daycare_id' => $daycare_id
        );
        $this->email->set_mailtype('html');
        $from = $this->config->item('smtp_user');
        $to = $user_email;
        $this->email->from($from, 'Daycare');
        $this->email->to($to);
        $this->email->subject('Parent Activation');

        $body= $this->load->view('owner_email/activate_parent_email', $email_data, true);
        $this->email->message($body);        //Send mail
        if($this->email->send()){
            $this->insert_parent($data);
            $this->session->set_flashdata("success","Parent registered successfully.");
            redirect($daycare_id.'/login');
        }   
        else{
            $this->session->set_flashdata("verify_email_error","Unable to send verification Email. Please try again.");
            redirect($daycare_id.'/register');
        }
    }
}