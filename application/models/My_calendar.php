<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @file      : Calendar
 * @author    : JMuchiri
 * @date      : 8/14/14
 * @Copyright 2017 A&M Digital Technologies

 * https://amdtllc.com
 */
class My_calendar extends CI_Model
{

	function  getEvents($id = null)
	{
		if ($id !== null) {
			$this->db->where('id', $id);
		}
		return $this->db->get('calendar');
	}
	/*
	 * add event
	 */
	function add_event()
	{
		$UNLIMITED = "Unlimited";
		$daycare_id = $this->session->userdata('daycare_id');
		$plans = $this->session->userdata('plans');
		$calendar = $this->db->get_where('calendar', array(
			'daycare_id' => $daycare_id
		))->result_array(); //daycare plan
		$plan_invoices_events = $plans['calender_events']; //plan calender_events count
		$calendar_count = count($calendar);

		if ($calendar_count < $plan_invoices_events || $plan_invoices_events == $UNLIMITED) {
			if ($this->input->post('allDay') == 1) {
				$allDay = 'true';
			} else {
				$allDay = 'false';
			}
			// Values received via ajax
			$title = $this->input->post('title');
			$data = array(
				'title' => $title,
				'start' => $this->input->post('start'),
				'start_t' => $this->input->post('start_t'),
				'end' => $this->input->post('end'),
				'end_t' => $this->input->post('end_t'),
				'description' => $this->input->post('desc'),
				'user_id' => $this->user->uid(),
				'daycare_id' => $daycare_id,
				'allDay' => $allDay
			);

			$this->db->insert('calendar', $data); //insert to db

			if ($this->db->affected_rows() > 0) { //successful
				flash('success', lang('request_success'));
				//log event
				logEvent($id = NULL, "Added calendar event {$title}", $care_id = NULL);
			} else {
				flash('danger', lang('request_error'));
			}
		} else {
			$error = "error";
			return $error;
		}
	}

	/*
	 * update event
	 */
	function update_event()
	{
		if ($this->input->post('allDay') == 1) {
			$allDay = 'true';
		} else {
			$allDay = 'false';
		}
		$start_date = date("Y-m-d", strtotime($this->input->post('start')));
		$end_date = date("Y-m-d", strtotime($this->input->post('end')));
		// Values received via ajax
		$title = $this->input->post('title');
		$data = array(
			'title' => $title,
			'start' => $start_date,
			'start_t' => $this->input->post('start_t'),
			'end' => $end_date,
			'end_t' => $this->input->post('end_t'),
			'description' => $this->input->post('desc'),
			'allDay' => $allDay
		);

		// update the records
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('calendar', $data);
		if ($this->db->affected_rows() > 0) { //successful
			//log event
			logEvent($id = NULL, "Updated calendar event {$title}", $care_id = NULL);
			flash('success', lang('request_success'));
		} else {
			flash('danger', lang('request_error'));
		}
	}

	/*
	 * delete event
	 */
	function delete_event()
	{
		$id = $this->input->post('event_id');

		$calendar_details = $this->db->get_where('calendar', array('id' => $id))->row();
		$this->db->where('id', $id);
		$this->db->delete('calendar');
		if ($this->db->affected_rows() > 0) { //successful
			//log event
			logEvent($user_id = NULL, "Deleted calendar event {$calendar_details->title}", $care_id = NULL);
			return 'true';
		} else {
			return 'true';
		}
	}
}
