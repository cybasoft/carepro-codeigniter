<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Filename: ${FILE_NAME}
 * User: John Muchiri
 * Date: 11/9/2014
 */
class MY_user extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function update_user_data($id)
	{
		$data = array(
			'pin' => $this->input->post('pin'),
			'phone' => $this->input->post('phone'),
			'phone2' => $this->input->post('phone2'),
			'street' => $this->input->post('street'),
			'street2' => $this->input->post('street2'),
			'city' => $this->input->post('city'),
			'state' => $this->input->post('state'),
			'zip' => $this->input->post('zip'),
			'country' => $this->input->post('country')
		);
		$this->db->where('user_id', $id);
		if ($this->db->update('user_data', $data))
			return true;
		return false;
	}

	function users()
	{
		//$this->db->select('*,users.id as uid');
		$this->db->select('*');
		$this->db->from('users');
		//$this->db->join('user_data', 'user_data.user_id = users.id');
		return $this->db->get();
	}

	function user($id = null)
	{
		if ($id == null) {
			$uid = $this->uid();
		} else {
			$uid = $id;
		}
		$this->checkData($uid);

		$this->db->select('*');
		$this->db->where('users.id', $uid);
		$this->db->from('users');
		$this->db->join('user_data', 'user_data.user_id=users.id');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row();
		}
		return false;
		//return $this->db->get('users')->row();
	}

	/**
	 * @param null $id
	 * @param null $item
	 * @return string
	 */
	function userData($id = null, $item = null)
	{
		if ($id == null) {
			$uid = $this->uid();
		} else {
			$uid = $id;
		}
		$this->db->where('user_id', $uid);
		$data = $this->db->get('user_data');
		if ($item == null)
			return $data->row();

		if ($data->num_rows() > 0)
			return $data->row()->$item;
		return "";
	}

	/**
	 * @param $user
	 * @param $group
	 * @return bool
	 */
	function in_group($user, $group)
	{
		$this->db->select('*');
		$this->db->where('groups.name', $group);
		$this->db->where('users_groups.user_id', $user);
		$this->db->from('users_groups');
		$this->db->join('groups', 'users_groups.group_id=groups.id');
		if ($this->db->get()->num_rows() > 0)
			return true;
		return false;
	}

	function uid()
	{
		return $this->session->userdata('user_id');
	}

	function thisUser($item)
	{
		/*registered session data on login
		- user_id
		- username
		- status
		 */
		return $this->session->userdata($item);
	}

	/*
	 * get details of current logged in user
	 * @param string, int
	 * @return string, int
	 */

	function getUser($id = "", $item)
	{
		if ($id !== "") {
			$this->db->where('id', $id);
			$q = $this->db->get('users');
			foreach ($q->result() as $row) {
				return $row->$item;
			}
		}
		return false;
	}


	function getCount()
	{
		return $this->users()->num_rows();
	}

	function checkData($uid)
	{
		$this->db->where('user_id', $uid);
		if ($this->db->get('user_data')->num_rows() == 0) {
			$data['user_id'] = $uid;
			$this->db->insert('user_data', $data);
		}
	}

	/*
	 * get photo of user
	 */
	function getPhoto($uid = "", $class = 'img-circle')
	{
		if ($uid = "") {
			$id = $this->uid();
		} else {
			$id = $uid;
		}
		if ($this->users->user($id)->photo !== "") {
			echo '<img class="' . $class . '"
         src="' . base_url() . 'assets/img/users/staff/' . $this->users->user($id)->photo . '"/>';
		} else {
			echo '<img class="' . $class . '"
         src="' . base_url() . 'assets/img/content/no-image.png"/>';
		}

	}
}