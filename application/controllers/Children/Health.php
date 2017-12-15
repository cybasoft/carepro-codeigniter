<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Filename: ${FILE_NAME}
 * User: John Muchiri
 * Date: 11/10/2014
 */
class health extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

        //redirect session
		$this->conf->setRedirect();

		$this->conf->authenticate();

		$this->load->model('My_child', 'child');
	}

	/*
	 * add allergy
	 * @return void
	 */

	function add_allergy()
	{
		$this->form_validation->set_rules('allergy', 'Allergy Name', 'required|trim|xss_clean');
		if ($this->form_validation->run() == TRUE) {
			$this->child->add_allergy($this->child->getID());
		} else {
			$this->conf->msg('danger', lang('request_error'));
		}
		$this->conf->redirectPrev();
	}

	/*
	 * delete allergy
	 */
	function delete_allergy($id)
	{
		$this->db->where('child_id', $this->child->getID());
		$this->db->where('id', $id);
		$this->db->delete('child_allergy');
		if ($this->db->affected_rows() > 0) {
			$this->conf->msg('success', lang('request_success'));
		} else {
			$this->conf->msg('danger', lang('request_error'));
		}
		$this->conf->redirectPrev();
	}

	/*
	 * add medication
	 * @return void
	 */
	function add_med($id)
	{

		$this->form_validation->set_rules('med_name', lang('medication'), 'required|trim|xss_clean');

		if ($this->form_validation->run() == TRUE) {
			$this->child->add_med($id);
		} else {
			$this->conf->msg('danger', lang('request_error'));
		}
		$this->conf->redirectPrev();
	}

	/*
	 * delete medication
	 * @return void
	 */
	function delete_med($id)
	{
		$this->db->where('child_id', $this->child->getID());
		$this->db->where('id', $id);
		$this->db->delete('child_meds');
		if ($this->db->affected_rows() > 0) {
			$this->conf->msg('success', lang('request_success'));
		} else {
			$this->conf->msg('danger', lang('request_error'));
		}
		//go back
		$this->conf->redirectPrev();
	}

	/*
	 * add food pref
	 */
	function add_foodpref()
	{
		$this->form_validation->set_rules('food', lang('food'), 'required|trim|xss_clean');
		$this->form_validation->set_rules('food_time', lang('time'), 'required|trim|xss_clean');
		$this->form_validation->set_rules('comment', lang('comment'), 'trim|xss_clean');

		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'child_id' => $this->child->getID(),
				'food' => $this->input->post('food'),
				'food_time' => $this->input->post('food_time'),
				'comment' => $this->input->post('comment')
			);
			if ($this->db->insert('child_foodpref', $data)) {
				$this->conf->msg('success', lang('request_success'));
			}
		} else {
			$this->conf->msg('danger');
			validation_errors();
		}
		$this->conf->redirectPrev();

	}

	/*
	 * delete food pref
	 */
	function delete_food($id = "")
	{
		if ($id !== "" & is_numeric($id)) {
			//make sure its the parent authorized or admin
			if ($this->conf->isStaff() == true || $this->is_mychild()) {
				$this->db->where('id', $id);
				$this->db->delete('child_foodpref');
				if ($this->db->affected_rows() > 0) {
					$this->conf->msg('success', lang('request_success'));
				} else {
					$this->conf->msg('danger', lang('request_error'));
				}
			}

		}
		$this->conf->redirectPrev();
	}

	function add_insurance()
	{
		$this->form_validation->set_rules('p_name', 'Policy name', 'required|trim|xss_clean');
		$this->form_validation->set_rules('p_num', 'Policy number', 'required|trim|xss_clean');
		$this->form_validation->set_rules('g_num', 'Group number', 'required|trim|xss_clean');
		$this->form_validation->set_rules('expiry', 'Expiry date', 'required|trim|xss_clean');
		if ($this->form_validation->run() == TRUE) {
			if ($this->children->add_insurance()) {
				$this->conf->msg('success', lang('request_success'));
			} else {
				$this->conf->msg('danger', lang('request_error'));
			}
		}
		$this->conf->redirectPrev();
	}

	function delete_insurance($id)
	{
		if ($this->children->delete_insurance($id)) {
			$this->conf->msg('success', lang('request_success'));
		} else {
			$this->conf->msg('danger', lang('request_danger'));
		}
		$this->conf->redirectPrev();
	}

}