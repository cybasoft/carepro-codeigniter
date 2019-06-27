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
            $image = 'error';            
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
        if($image !== 'error'){
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
            $status = $this->send_welcome_email($daycare_id,$activation_code,$data,$image);
            $result = array(
                'success' => $status,
                'error' => ''
            );
            return $result;
        }elseif($image === "error"){
            $result = array(
                'error' => $error,
                'success' => ''
            );
            return $result;
        }
    }

    //insert daycare info in database
    public function insert_daycare($data,$email,$activation_code){
        $address_data = array(
            'address_line_1' => $data['address_line_1'],
            'address_line_2' => $data['address_line_2'],
            'city' => $data['city'],
            'state' => $data['state'],
            'zip_code' => $data['zip'],
            'country' => $data['country'],
            'phone' => $data['phone'],
        );
        $this->db->insert('address', $address_data);
        $user_address = $this->db->insert_id();

        $this->db->insert('address', $address_data);
        $daycare_address = $this->db->insert_id();        

        $daycare_data = array(
            'name' => $data['name'],
            'employee_tax_identifier' => $data['employee_tax_identifier'],
            'address_id' => $daycare_address,
            'daycare_id' => $data['daycare_id'],
            'logo' => $data['logo'],            
        );
        $this->db->insert('daycare', $daycare_data);
    
        $insert_id = $this->db->insert_id();
        
        $store_id = array(
            'daycare_id' => $insert_id,
            'address_id' => $user_address
        );
        $this->db->where('email', $email);
        $this->db->update('users', $store_id);

        $setting_data = array(
            'name' => $data['name'],
            'email' => $email,
            'phone' => $data['phone'],
            'street' => $data['address_line_1'],
            'street2' => $data['address_line_2'],
            'city' => $data['city'],
            'state' => $data['state'],
            'postal_code' => $data['zip'],
            'country' => $data['country'],
            'logo' => $data['logo'],
            'tax_id' => $data['employee_tax_identifier'],
            'invoice_logo' => $data['logo'],
            'daycare_id' => $data['daycare_id']
        );
        foreach(special_options() as $options){
            $this->db->insert('daycare_settings', ['option_name' => $options,'daycare_id' => $insert_id]);
            foreach($setting_data as $settings=>$value){
               if($options === $settings){
                $this->db->where('option_name', $options);
                $this->db->update('daycare_settings', ['option_value' => $value]); 
               }
            }
        }
        logEvent($insert_id,"Daycare {$insert_id} added to the application.");
        $this->session->set_userdata('daycare_id',$insert_id);
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
        if(!file_exists($upload_folder)) {
            mkdir($upload_folder, 0777, TRUE);
            chmod($upload_folder, 0777);
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
        }else {
            $data = array('logo' => $this->upload->data());
            return $data;
        }
    }

    //function to send welcome email to daycare for login page
    public function send_welcome_email($daycare_id,$activation_code,$user_data,$image){
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
            'daycare_id' => $daycare_id,
            'image' => $image
        );
        $this->email->set_mailtype('html');
        $from = $this->config->item('smtp_user');
        $this->email->from($from, 'Daycare');
        $this->email->to($email);
        $this->email->subject('Daycare register');

        $body= $this->load->view('custom_email/welcome_email', $data, true);
        $this->email->message($body);        //Send mail
        if($this->email->send()){           
            $this->insert_daycare($user_data,$email,$activation_code);
            $status = $this->change_owner_status($email,$daycare_id);
            return $status;
        }   
        else{
            $logs = "[".date('m/d/Y h:i:s A', time())."]"."\n\r";           
            $logs .= $this->email->print_debugger('message');
            $logs .= "\n\r";
            file_put_contents('./application/logs/log_' . date("j.n.Y") . '.log', $logs, FILE_APPEND);
            $this->session->set_flashdata("subscription_error","Enable to sent welcome email. Please try again.");
        }
    }

    public function change_owner_status($to,$daycare_id){
        $get_status = $this->db->get('user_status');
        $result = $get_status->result_array();

        $owner_status = $result[3]['id'];
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
        if ($registered === "4"){            
            $status = "success";
            return $status;
        }
    }   
}
