<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class MY_profile extends CI_Model
{
	function change_pin()
	{
		$data = array(
			'pin' => $this->input->post('pin')
		);
		$this->db->where('id', $this->user->uid());
		if($this->db->update('users', $data))
			return true;
		return false;
	}

	function change_email()
	{
		$data = array(
			'email' => $this->input->post('email')
		);
		$this->db->where('id', $this->user->uid());
		if($this->db->update('users', $data))
			return true;
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
		$data = array(
			'phone' => $this->input->post('phone'),
			'phone2' => $this->input->post('phone2'),
			'address' => $this->input->post('address')
		);
		$this->db->where('id', $this->user->uid());
		if($this->db->update('users', $data))
			return true;
		return false;
	}
}