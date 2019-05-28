<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class MY_profile extends CI_Model
{

    function change_pin()
    {
        $data = array(
            'zip_code' => $this->input->post('pin')
        );
        $get_users_details = $this->db->get_where('users',array(
            'id' => $this->user->uid()
        ));
        $users = $get_users_details->row_array();
        $this->db->where('id', $users['address_id']);
        if($this->db->update('address', $data))
            return true;
        return false;
    }

    function change_email()
    {
        $email = $this->input->post('email');

        $this->db->where('id', $this->user->uid());
        if($this->db->update('users', ['email' => $email])) {
            session(['email' => $email]);
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    function change_password()
    {
        $this->load->model('ion_auth_model', 'auth');
        $data = array(
            'password' => $this->auth->hash_password($this->input->post('new_password'))
        );
        $this->db->where('id', $this->user->uid());
        if($this->db->update('users', $data))
            return true;
        return false;
    }

    /**
     * @return bool
     */
    function update_user_data()
    {
        $data = [
            'phone' => $this->input->post('phone'),
            'address_line_1' => $this->input->post('address_line_1'),
            'address_line_2' => $this->input->post('address_line_2'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'country' => $this->input->post('country')
        ];

        $get_users_details = $this->db->get_where('users',array(
            'id' => $this->user->uid()
        ));
        $users = $get_users_details->row_array();
        $this->db->where('id', $users['address_id']);
        if($this->db->update('address', $data)) {
            session($data); //update session data
            return true;
        }
        
        return false;
    }
}