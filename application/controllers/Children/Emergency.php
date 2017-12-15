<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Filename: ${FILE_NAME}
 * User: John Muchiri
 * Date: 11/11/2014
 */
class emergency extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

        //redirect session
		$this->conf->setRedirect();

		if ($this->conf->isParent() == true && $this->conf->isStaff() ! ==true) {
			$this->conf->redirectPrev();
		}

		$this->load->model('My_child', 'child');
	}
	/*
	 * add emergency contact
	 */
	function add_contact()
	{
		$this->form_validation->set_rules('fname', lang('first_name'), 'required|trim|xss_clean');
		$this->form_validation->set_rules('lname', lang('last_name'), 'required|trim|xss_clean');
		$this->form_validation->set_rules('other_phone', lang('other_phone'), 'trim|xss_clean|integer');
		$this->form_validation->set_rules('cell', lang('cellphone'), 'required|trim|xss_clean|integer');
		if ($this->form_validation->run() == TRUE) {
			$this->child->add_emergency_contact();
		} else {
			$this->conf->msg('danger', lang('request_error'));
		}
		$this->conf->redirectPrev();
	}

	/*
	 * delete contact
	 */
	function delete_contact($contact_id)
	{
		$this->db->where('child_id', $this->child->getID()); //only able to delete selected child note
		$this->db->where('id', $contact_id);
		if ($this->db->delete('child_emergency')) {
			$this->conf->msg('success', lang('request_success'));
		} else {
			$this->conf->msg('danger', lang('request_error'));
		}
		$this->conf->redirectPrev();
	}

}