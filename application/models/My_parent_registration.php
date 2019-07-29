<?php if(!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class My_parent_registration extends CI_Model
{
    //store parent
    public function store_parent($daycare_id)
    {        
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
            'true_password' => $this->input->post('password'),
            'active' => 0,
            'daycare_id' => $owner_id
        );
        $parent_name = $first_name .' '. $last_name;
        $this->send_activation_email($data,$daycare_id,$parent_name);
    }
    //insert parent to database
    public function insert_parent($data){
        $address_data = array(
            'phone' => $data['phone']
        );
        $this->db->insert('address',$address_data);
        $address_id = $this->db->insert_id();

        $user_data = array(
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'active' => $data['active'],
            'daycare_id' => $data['daycare_id'],
            'address_id' => $address_id
        );
        $this->db->insert('users', $user_data);

        $insert_id = $this->db->insert_id();
        $group_id = 4;

        $users_groups = array(
            'user_id' => $insert_id,
            'group_id' => $group_id
        );
        $this->db->insert('users_groups',$users_groups);
        $this->send_email($data);
    }

    //send email to registered parent
    public function send_email($data){
        $this->load->config('email');
        $this->load->library('email');
        $email_data = array(
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'logo' => $this->session->userdata('company_logo'),            
            'user_name' => $data['email'],
            'password' => $data['true_password'],
            'staff_firstname' => '',
            'name' => '',
            'daycare_name' => $this->session->userdata('company_name')
        );
        $this->email->set_mailtype('html');
        $from = $this->config->item('smtp_user');
        $to = $data['email'];
        $this->email->from($from, 'Daycare');
        $this->email->to($to);
        $this->email->subject('Daycare Invitation');

        $body = $this->load->view('custom_email/register_user_email', $email_data, true);
        $this->email->message($body);        //Send mail
        if ($this->email->send()) {
            $this->session->set_flashdata("verify_email", "Please check your email to confirm your account.");
        }
    }
    //send activation email to owner for parent self registration
    public function send_activation_email($data,$daycare_id,$parent_name){
        $this->load->config('email');
        $this->load->library('email');
        $daycare_details = $this->db->get_where('daycare',array(
            'daycare_id' => $daycare_id
        ));
        $daycare = $daycare_details->row_array();  

        $user_details = $this->db->get_where('users',array(
            'daycare_id' => $daycare['id']
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
            'daycare_id' => $daycare_id,
            'image' => $daycare['logo']
        );
        $this->email->set_mailtype('html');
        $from = $this->config->item('smtp_user');
        $to = $user_email;
        $this->email->from($from, 'Daycare');
        $this->email->to($to);
        $this->email->subject('Parent Activation');

        $body= $this->load->view('custom_email/activate_parent_email', $email_data, true);
        $this->email->message($body);        //Send mail
        if($this->email->send()){
            $this->insert_parent($data);
            $this->session->set_flashdata("success","Parent registered successfully.");
            redirect('login');
        }   
        else{
            $logs = "[".date('m/d/Y h:i:s A', time())."]"."\n\r";
            $logs .= $this->email->print_debugger('message');
            $logs .= "\n\r";
            file_put_contents('./application/logs/log_' . date("j.n.Y") . '.log', $logs, FILE_APPEND);
            $this->session->set_flashdata("verify_email_error","Unable to send verification Email. Please try again.");
            redirect('register');
        }
    }
}