<?php

class My_user_registration extends CI_Model
{
    public function store_user(){
        $this->load->model('ion_auth_model');
        $password = $this->ion_auth->hash_password($this->input->post('password'));   

        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => $password,
            'address_1' => $this->input->post('address_line_1'),
            'address_2' => $this->input->post('address_line_2'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'zip' => $this->input->post('zip_code'),
            'country' => $this->input->post('country'),
            'phone' => $this->input->post('phone'),
        );
        print_r($data);
        exit();
    }
}