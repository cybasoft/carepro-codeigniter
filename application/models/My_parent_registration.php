<?php if(!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class My_parent_registration extends CI_Model
{
    public function store_parent($daycare_id){
        $this->load->model('ion_auth_model');
        $query = $this->db->get_where('daycare', array(
            'daycare_id' => $daycare_id
        ));
        $result_query = $query->result();
        $owner_id = $result_query[0]->id;
        $password = $this->ion_auth->hash_password($this->input->post('password'));        
        $data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'password' => $password,
            'daycare_id' => $owner_id
        );
        $this->db->insert('users', $data);

        $insert_id = $this->db->insert_id();
        $group_id = 4;

        $users_groups = array(
            'user_id' => $insert_id,
            'group_id' => $group_id
        );
        $this->db->insert('users_groups',$users_groups);
    }
}