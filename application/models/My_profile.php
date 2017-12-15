<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class MY_profile extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function change_pin()
	{
		$data = array(
			'pin' => $this->input->post('pin')
		);
		$this->db->where('user_id', $this->users->uid());
		if($this->db->update('user_data', $data))
			return true;
		return false;
	}

	function change_email()
	{
		$data = array(
			'email' => $this->input->post('email')
		);
		$this->db->where('id', $this->users->uid());
		if($this->db->update('users', $data))
			return true;
		return false;
	}

	function change_password()
	{
		$this->load->model('ion_auth_model', 'auth');
		$data = array(
			'password' => $this->auth->hash_password($this->input->post('new_password'))
		);
		$this->db->where('id', $this->users->uid());
		if($this->db->update('users', $data))
			return true;
		return false;
	}

	function update_user_data()
	{
		$data = array(
			'phone' => $this->input->post('phone'),
			'phone2' => $this->input->post('phone2'),
			'street' => $this->input->post('street'),
			'street2' => $this->input->post('street2'),
			'city' => $this->input->post('city'),
			'state' => $this->input->post('state'),
			'zip' => $this->input->post('zip'),
			'country' => $this->input->post('country')
		);
		$this->db->where('user_id', $this->users->uid());
		if($this->db->update('user_data', $data))
			return true;
		return false;
	}
}