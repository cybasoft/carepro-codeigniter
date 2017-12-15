<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @file      : children.php
 * @author    : John
 * @date      : 8/9/14
 * @Copyright 2014 icoolpix.com
 */
class Children extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->conf->setRedirect();

		$this->conf->allow('admin,manager,staff');

		$this->load->model('My_invoice', 'invoice');
		$this->module = 'modules/children/';
	}

	/*
	 * default page
	 * @return void
	 */
	function index()
	{
		$this->conf->page($this->module . 'index');
	}

	function child($id)
	{
		$this->session->set_userdata('view_child_id', $id);

		$data['child'] = $this->children->child($id);
		$this->conf->page($this->module . 'child/index', $data);
	}


	/*
	 * child registration form
	 * @return void
	 */

	function register()
	{
		$this->conf->page($this->module . 'register');
	}

	/*
	 * validate and add child record to db
	 * @params 0
	 * @return void
	 */
	function add_child()
	{
		$this->form_validation->set_rules('fname', lang('first_name'), 'required|trim|xss_clean');
		$this->form_validation->set_rules('lname', lang('last_name'), 'required|trim|xss_clean');
		$this->form_validation->set_rules('ssn', lang('social_security'), 'required');
		$this->form_validation->set_rules('bday', lang('birthday'), 'required|trim|xss_clean');
		$this->form_validation->set_rules('gender', lang('gender'), 'required|trim|xss_clean');
		if ($this->form_validation->run() == TRUE) {
			$this->children->add_child();
		} else {
			validation_errors();
			$this->conf->msg('danger');
		}
		redirect('children', 'refresh');
	}

	/*
	 * validate and update child information
	 * @params int $id
	 * @return void
	 */

	function updateChild()
	{
		$this->form_validation->set_rules('fname', lang('first_name'), 'required|trim|xss_clean');
		$this->form_validation->set_rules('lname', lang('last_name'), 'required|trim|xss_clean');
		$this->form_validation->set_rules('ssn', lang('social_security'), 'trim|xss_clean');
		$this->form_validation->set_rules('bday', lang('birthday'), 'required|trim|xss_clean');
		$this->form_validation->set_rules('blood_type', lang('birthday'), 'required|trim|xss_clean');
		$this->form_validation->set_rules('gender', lang('gender'), 'required|trim|xss_clean');
		$this->form_validation->set_rules('child_status', lang('status'), 'required|trim|xss_clean');
		if ($this->form_validation->run() == TRUE) {
			$this->children->update_child();
		} else {
			$this->conf->msg('danger', lang('request_error'));
		}
		redirect('child/' . $this->children->getID(), 'refresh');
	}

	/*
	 * deleting is currently disable. Only sets record as inactive
	 * @return void
	 */
	function deleteChild()
	{
		$this->conf->allow('admin');

		$this->db->where('id', $this->children->getID());
		if ($this->db->update('children', array('status', 0))) {
			$this->conf->msg('success', lang('request_success'));
		} else {
			$this->conf->msg('danger', lang('request_error'));
		}
		redirect('children', 'refresh');
	}

	/*
	 * upload photos to specific db
	 * @param $id int
	 * @param $db string
	 */

	function upload_photo($id = "")
	{
		if (!$this->conf->isStaff()) $this->conf->redirectPrev();

		$upload_path = './assets/img/children';
		$upload_db = 'children';

		if (!file_exists($upload_path)) {
			mkdir($upload_path, 755, true);
		}

		if ($id == "") { //make sure there are arguments
			$this->conf->msg('danger', lang('request_error'));
			$this->conf->redirectPrev();
		}

		$config = array(
			'upload_path' => $upload_path,
			'allowed_types' => 'gif|jpg|png|jpeg',
			//'max_size'      => '100',
			'max_width' => '1240',
			'max_height' => '1240',
			'encrypt_name' => true,
		);
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload()) {
			$this->conf->msg('danger', lang('request_error'));
		} else {
			//delete if any exists
			$this->db->where('id', $id);
			$q = $this->db->get($upload_db);
			foreach ($q->result() as $r) {
				if ($r->photo !== "") :
					unlink($upload_path . '/' . $r->photo);
				$data['photo'] = '';
				$this->db->where('id', $id);

				$this->db->update($upload_db, $data);
				endif;
			}
			//upload new photo
			$upload_data = $this->upload->data();
			$data_ary = array(
				'photo' => $upload_data['file_name']
			);

			$this->db->where('id', $id);
			$this->db->update($upload_db, $data_ary);
			$data = array('upload_data' => $upload_data);
			if ($data) {
				$this->conf->msg('success', lang('request_success'));
			} else {
				$this->conf->msg('danger', lang('request_error'));
			}
		}

		$this->conf->redirectPrev();
	}

	/////////////HEALTH///////////////
	function health()
	{
		$this->conf->page($this->module . 'health/index');
	}

	////////////NOTES/////////////////
	function notes()
	{
		$this->conf->page($this->module . 'child/notes');
	}

	///////////PICKUP CONTACT/////////
	function pickup()
	{
		$this->conf->page($this->module . 'child/pickup');
	}

	/////////INVOICE/////////////////
	function invoice($status = "")
	{
		$id = $this->children->getID();
		$data['status'] = $status;
		$this->conf->page($this->module . 'accounting/index', $data);
	}

	/////////EMERGENCY CONTACT/////////
	function emergency()
	{
		$data['eContact'] = $this->db->where('child_id', $this->children->getID())->get('child_emergency');
		$this->conf->page($this->module . 'child/emergency', $data);
	}

	/////////REPORTS//////////////////
	function reports()
	{
		$cid = $this->children->getID();
		$data['attendance'] = $this->db->where('child_id', $cid)->order_by('id', 'DESC')->get('child_checkin');
		$this->conf->page($this->module . 'reports/attendance', $data);
	}


	//check this user and parent association
	function is_mychild()
	{
		$this->db->where('child_id', $this->children->getID());
		$this->db->where('user_id', $this->users->uid());
		$query = $this->db->get('child_users');
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	/*
	 * check_in
	 */
	function check_in($id)
	{
		$this->childBelongs($id);

		$data = array(
			'child_id' => $id,
			'parents' => $this->children->getParents($id)->result()
		);
		$this->load->view($this->module . 'child/check_in', $data);
	}

	/*
	 * check_out
	 */
	function check_out($id)
	{
		$this->childBelongs($id);

		$data = array(
			'child_id' => $id,
			'parents' => $this->children->getParents($id)->result()
		);
		$this->load->view($this->module . 'child/check_out', $data);
	}

	/*
	 * check in
	 */

	function checkIn($child_id)
	{
		$this->childBelongs($child_id);

		$this->form_validation->set_rules('pin', lang('pin'), 'required|trim|xss_clean');
		if ($this->form_validation->run() == true) {
			$parent = $this->input->post('parent_id');
			$pin = $this->input->post('pin');
			$this->children->check_in($child_id, $parent, $pin);
		} else {
			validation_errors();
			$this->conf->msg('danger');
		}
		$this->conf->redirectPrev();
	}

	/*
	 * check out
	 */
	function checkOut($child_id)
	{
		$this->childBelongs($child_id);

		$this->form_validation->set_rules('pin', lang('pin'), 'required|trim|xss_clean');
		if ($this->form_validation->run() == true) {
			$parent = $this->input->post('parent_id');
			$pin = $this->input->post('pin');
			$this->children->check_out($child_id, $parent, $pin);
		} else {
			validation_errors();
			$this->conf->msg('danger');
		}
		$this->conf->redirectPrev();
	}

	/*
	 * assign parent
	 */
	function assign_parent()
	{
		$this->load->view($this->module . 'child/assign_parent');
	}

	function assign()
	{
		$this->form_validation->set_rules('parent', lang('parent'), 'required|trim|xss_clean|callback_user_not_assigned');
		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'user_id' => $this->input->post('parent'),
				'child_id' => $this->child->getID()
			);
			if ($this->db->insert('child_users', $data)) {
				$this->conf->msg('success', lang('request_success'));
			}
		} else {
			$this->conf->msg('danger');
			validation_errors();
		}
		$this->conf->redirectPrev();
	}

	/*
	 * user_not_assigned
	 * ensure user has not already been assigned
	 */
	function user_not_assigned()
	{
		$user_id = $this->input->post('parent');
		$child_id = $this->child->getID();

		$this->db->where('user_id', $user_id);
		$this->db->where('child_id', $child_id);
		$query = $this->db->get('child_users');
		if ($query->num_rows() > 0) {
			$this->form_validation->set_message('user_not_assigned', lang('user_already_assigned'));
			$this->conf->msg('danger', lang('request_error'));
			return false;
		} else {
			return true;
		}
	}

	/*
	 * remove_parent
	 */
	function remove_parent($id)
	{
		$this->db->where('user_id', $id);
		$this->db->where('child_id', $this->child->getID());
		if ($this->db->delete('child_users')) {
			$this->conf->msg('success', lang('request_success'));
		} else {
			$this->conf->msg('danger', lang('request_error'));
		}

		$this->conf->redirectPrev();
	}

	function roster()
	{
		$children = $this->db->get('children')->result();
		$this->load->view('modules/children/roster', compact('children'));
	}
}