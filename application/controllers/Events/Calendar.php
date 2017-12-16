<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @file      : Calendar
 * @author    : JMuchiri
 * @date      : 8/14/14
 * @Copyright 2017 A&M Digital Technologies

* https://amdtllc.com
 */
class Calendar extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		//redirect session
		$this->conf->setRedirect();
		$this->conf->authenticate();
		//local resources (models,libraries etc)
		$this->load->model('My_calendar', 'calendar');

		//local variables
		$this->module = 'modules/calendar/';
	}

	/*
	 * display main page
	 */
	function index()
	{
		if ($this->conf->isParent() == true && $this->conf->isStaff() == false) :
			$this->conf->page('family/calendar');
		else :
			$this->conf->page($this->module . 'index');
		endif;
	}

	function events()
	{
		$this->db->order_by('id');
		$query = $this->db->get('calendar')->result();
		// sending the encoded result to success page
		echo json_encode($query);
	}

	/*
	 * add event to db
	 */
	function add_event()
	{
		if (!$this->conf->isStaff()) {
			$this->conf->redirectPrev();
		} else {
			$this->form_validation->set_rules('title', 'Event title', 'required|trim|xss_clean');
			$this->form_validation->set_rules('start', 'Event start date', 'required|trim|xss_clean');
			$this->form_validation->set_rules('end', 'Event end date', 'required|trim|xss_clean');
			$this->form_validation->set_rules('desc', 'Details', 'required|trim|xss_clean');

			if ($this->form_validation->run() == TRUE) {
				$this->calendar->add_event();
			} else {
				validation_errors();
				$this->conf->msg('danger');
			}
			$this->conf->redirectPrev();
		}
	}

	/*
	 * update event
	 */
	function update_event()
	{
		if (!$this->conf->isStaff()) {
			$this->conf->redirectPrev();
		} else {

			$this->form_validation->set_rules('title', 'Event title', 'required|trim|xss_clean');
			$this->form_validation->set_rules('start', 'Event start date', 'required|trim|xss_clean');
			$this->form_validation->set_rules('end', 'Event end date', 'required|trim|xss_clean');
			$this->form_validation->set_rules('desc', 'Details', 'required|trim|xss_clean');

			if ($this->form_validation->run() == TRUE) {
				$this->calendar->update_event();
			} else {
				$this->conf->msg('danger', 'Error!');
			}
			$this->conf->redirectPrev();
		}
	}

	/*
	 * delete event
	 */
	function delete_event()
	{
		if (!$this->conf->isStaff()) {
			$this->conf->redirectPrev();
		} else {
			if ($this->calendar->delete_event()) {
				$this->conf->msg('success', 'Event has been delete');
			} else {
				$this->conf->msg('danger', 'Unable to delete event!');
			}
		}
	}
}