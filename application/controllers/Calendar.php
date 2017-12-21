<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @file      : Calendar
 * @author    : JMuchiri
 * @Copyright 2017 A&M Digital Technologies
* https://amdtllc.com
 */
class Calendar extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		//redirect session
		setRedirect();
		auth();
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
		if (is('parent') == true && is('staff') == false) :
			page('parent/calendar');
		else :
			page($this->module . 'index');
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
	function addEvent()
	{
		if (!is('staff')) {
			redirectPrev();
		} else {
			$this->form_validation->set_rules('title', 'Event title', 'required|trim|xss_clean');
			$this->form_validation->set_rules('start', 'Event start date', 'required|trim|xss_clean');
			$this->form_validation->set_rules('end', 'Event end date', 'required|trim|xss_clean');
			$this->form_validation->set_rules('desc', 'Details', 'trim|xss_clean');

			if ($this->form_validation->run() == TRUE) {
				$this->calendar->add_event();
			} else {
				validation_errors();
				flash('danger');
			}
			redirectPrev();
		}
	}

	/*
	 * update event
	 */
	function updateEvent()
	{
		if (!is('staff')) {
			redirectPrev();
		} else {

			$this->form_validation->set_rules('title', 'Event title', 'required|trim|xss_clean');
			$this->form_validation->set_rules('start', 'Event start date', 'required|trim|xss_clean');
			$this->form_validation->set_rules('end', 'Event end date', 'required|trim|xss_clean');
			$this->form_validation->set_rules('desc', 'Details', 'required|trim|xss_clean');

			if ($this->form_validation->run() == TRUE) {
				$this->calendar->update_event();
			} else {
				flash('danger', 'Error!');
			}
			redirectPrev();
		}
	}

	/*
	 * delete event
	 */
	function deleteEvent()
	{
		if (!is('staff')) {
			redirectPrev();
		} else {
			if ($this->calendar->delete_event()) {
				flash('success', 'Event has been delete');
			} else {
				flash('danger', 'Unable to delete event!');
			}
		}
	}
}