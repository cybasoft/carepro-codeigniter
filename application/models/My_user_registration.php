<?php

class My_user_registration extends CI_Model
{
    public function store_user()
    {
        $this->load->model('ion_auth_model');
        $password = $this->ion_auth->hash_password($this->input->post('password'));

        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => $password,
            'address_line_1' => $this->input->post('address_line_1'),
            'address_line_2' => $this->input->post('address_line_2'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'pin' => $this->input->post('zip_code'),
            'country' => $this->input->post('country'),
            'phone' => $this->input->post('phone'),
        );
        $this->db->insert('users', $data);

        $insert_id = $this->db->insert_id();
        $group_id = 5;

        $users_groups = array(
            'user_id' => $insert_id,
            'group_id' => $group_id
        );
        $this->db->insert('users_groups',$users_groups);
    }
}
