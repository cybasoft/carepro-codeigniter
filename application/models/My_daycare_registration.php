<?php

class My_daycare_registration extends CI_Model
{   
    //Store information of daycare
    public function store($activation_code)
    {
        $image = '';
        $error = '';
        $daycare_id = $this->generate_unquie_daycareId();
        $file =  $this->store_logo($daycare_id);
        if(isset($file['error'])){
            $error =  $file['error'];
            if($error === "You did not select a file to upload."){
                $image = '';
            }
        }else if(isset($file['logo'])) {
            $image = $file['logo']['file_name'];
        }

        $query = $this->db->get_where('daycare', array(
            'daycare_id' => $daycare_id
        ));
        $count = $query->num_rows();
        if ($count !== 0) {
            $daycare_id = $this->generate_unquie_daycareId();
        }
        if($image !== '' || $image === ''){
            $data = array(
                'name' => $this->input->post('name'),
                'employee_tax_identifier' => $this->input->post('employee_tax_identifier'),
                'address_line_1' => $this->input->post('address_line_1'),
                'address_line_2' => $this->input->post('address_line_2'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'zip' => $this->input->post('zip_code'),
                'country' => $this->input->post('country'),
                'phone' => $this->input->post('phone'),
                'daycare_id' => $daycare_id,
                'logo' => $image
            );
            $this->send_welcome_email($daycare_id,$activation_code,$data);
        }else{
            return $error;
        }
    }

    //insert daycare info in database
    public function insert_daycare($data,$email){
        $this->db->insert('daycare', $data);
    
        $insert_id = $this->db->insert_id();
        
        $store_id = array(
            'daycare_id' => $insert_id,
        );
        $this->db->where('email', $email);
        $this->db->update('users', $store_id);
    }
    
    //Function to generate unique daycare id
    public function generate_unquie_daycareId(){
        $year = date("y");
        $month = date("m");
        $pin = mt_rand(1000, 9999);
        $daycare_id = $year . "-" . $month . "-" .$pin;

        return $daycare_id;
    }

    //function to store daycare logo
    public function store_logo($filename) {
        $upload_folder = './assets/uploads/daycare_logo';
        if(!file_exists($upload_folder)){
            if (!mkdir($upload_folder, 0777, true)) {//0777
                die('Failed to create folders...');
            }
        }
        $config['upload_path'] = $upload_folder;
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['max_size'] = 2000;
        $config['max_width'] = 1500;
        $config['max_height'] = 1500;    
        $config['file_name'] = $filename;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('logo')) {
            $error = array('error' => $this->upload->display_errors());
            return $error;
        } else {
            $data = array('logo' => $this->upload->data());
            return $data;
        }
    }

    //function to send welcome email to daycare for login page
    public function send_welcome_email($daycare_id,$activation_code,$user_data){
        $this->load->config('email');
        $this->load->library('email');

        $query = $this->db->get_where('users',array(
            'activation_code' => $activation_code
        ));
        $user_details = $query->result_array()[0];
        $email = $user_details['email'];
        $name = $user_details['name'];
        
        $data = array(
            'user_name' => $name,
            'daycare_id' => $daycare_id
        );
        $this->email->set_mailtype('html');
        $from = $this->config->item('smtp_user');
        $this->email->from($from, 'Daycare');
        $this->email->to($email);
        $this->email->subject('Daycare register');

        $body= $this->load->view('owner_email/welcome_email', $data, true);
        $this->email->message($body);        //Send mail
        if($this->email->send()){
            $this->insert_daycare($user_data,$email);
            $this->change_owner_status($email,$daycare_id);
        }   
        else{
            $this->session->set_flashdata("subscription_error","Enable to sent welcome email. Please try again.");
        }
    }

    public function change_owner_status($to,$daycare_id){
        $owner_status = $this->My_user_registration->status[3];
        $data = array(
            'owner_status' => $owner_status,
            'active' => 1
        );
        $this->db->where('email', $to);
        $this->db->update('users', $data);

        $query = $this->db->get_where('users', array(
            'email' => $to
        ));
        $check_status = $query->row_array();
        $registered = $check_status['owner_status'];
        if ($registered === "registered"){
            redirect(''.$daycare_id.'/login');
        }
    }
}
