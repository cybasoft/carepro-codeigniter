<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class My_parent extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function page($page, $data = array())
	{
		$data['page'] = $page;
		$this->load->view('parent/inc/home', $data);
	}

	/**
	 * @return mixed
	 */
	function parents()
	{
		$this->db->where('users_groups.group_id', 4);
		$this->db->select('users_groups.user_id,users_groups.group_id,users.*');
		$this->db->from('users');
		$this->db->join('users_groups', 'users_groups.user_id=users.id');
		return $this->db->get();
	}

	/**
	 * @return mixed
	 */
	function parent()
	{
		$this->db->where('users_groups.group_id', 4);
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('users_groups', 'users_groups.user_id=users.id');
		return $this->db->get();
	}

	/*
	 * selected child belongs to logged in parent
	 */
	function child_belongs_to_parent($child, $parent)
	{
		$this->db->where('user_id', $parent);
		$this->db->where('child_id', $child);
		$query = $this->db->get('child_parents');
		if ($query->num_rows() > 0)
			return true;
		return false;
	}

	function register_child()
	{
		$data = array(
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'national_id' => encrypt($this->input->post('national_id')),
			'bday' => $this->input->post('bday'),
			'gender' => $this->input->post('gender'),
			'enroll_date' => time(),
			'last_update' => time()
		);
		$this->db->insert('children', $data);
		$last_id = $this->db->insert_id();

		if ($this->db->affected_rows() > 0) {
			flash('success', lang('request_success'));
		} else {
			flash('warning', lang('request_error'));
		}

		//associate to this parent
		$data2 = array(
			'child_id' => $last_id,
			'user_id' => $this->user
		);
		$this->db->insert('child_parents', $data2);
		redirect(site_url('parents/view_child/' . $last_id)); //go to child record
	}

	/**
	 * @param $parent_id
	 * @return mixed
	 */
	function getChildren($parent_id)
	{
		$this->db->select('*');
		$this->db->where('child_parents.user_id', $parent_id);
		$this->db->from('children');
		$this->db->join('child_parents', 'children.id=child_parents.child_id');
		return $this->db->get();
	}

	/**
	 * @param null $parent_id
	 * @return mixed
	 */
	function totalChildren($parent_id = null)
	{
		if ($parent_id == null) {
			return $this->getChildren($this->user->uid())->num_rows();
		} else {
			return $this->getChildren($parent_id)->num_rows();
		}

	}
}