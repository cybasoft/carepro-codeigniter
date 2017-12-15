<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class My_settings extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}


	/*
	 * update user
	 */
	function update_user($id)
	{
		$data = array(
			'fname' => $this->input->post('fname'),
			'lname' => $this->input->post('lname'),
			'email' => $this->input->post('email'),
			'activated' => $this->input->post('activated'),
			'user_type' => $this->input->post('user_type')
		);
		$this->db->where('id', $id);
		if($this->db->update('users', $data))
			return true;
		return false;
	}


}