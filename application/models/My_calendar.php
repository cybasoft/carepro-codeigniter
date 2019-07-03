<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @file      : Calendar
 * @author    : JMuchiri
 * @date      : 8/14/14
 * @Copyright 2017 A&M Digital Technologies

* https://amdtllc.com
 */
class My_calendar extends CI_Model
{

	function  getEvents($id=null){
		if($id !==null){
			$this->db->where('id',$id);
		}
		return $this->db->get('calendar');
	}
	/*
	 * add event
	 */
	function add_event()
	{
		if($this->input->post('allDay') == 1) {
			$allDay = 'true';
		} else {
			$allDay = 'false';
		}
		// Values received via ajax
		$data = array(
			'title' => $this->input->post('title'),
			'start' => $this->input->post('start'),
			'start_t' => $this->input->post('start_t'),
			'end' => $this->input->post('end'),
			'end_t' => $this->input->post('end_t'),
			'description' => $this->input->post('desc'),
			'user_id' => $this->user->uid(),
			'allDay' => $allDay
		);

		$this->db->insert('calendar', $data); //insert to db

		if($this->db->affected_rows() > 0) { //successful
			$last_id = $this->db->insert_id();
			flash('success', lang('request_success'));
			//log event
			logEvent($id = NULL,"Added calendar event ID: {$last_id}",$care_id = NULL);
		} else {
			flash('danger', lang('request_error'));
		}
	}

	/*
	 * update event
	 */
	function update_event()
	{
		if($this->input->post('allDay') == 1) {
			$allDay = 'true';
		} else {
			$allDay = 'false';
		}
		$start_date = date("Y-m-d", strtotime($this->input->post('start')));
		$end_date = date("Y-m-d", strtotime($this->input->post('end')));		
		// Values received via ajax
		$data = array(
			'title' => $this->input->post('title'),
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
		if($this->db->affected_rows() > 0) { //successful
			//log event
			logEvent($id = NULL,"Updated calendar event ID: {$this->input->post('id')}",$care_id = NULL);
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
		$id=$this->input->post('event_id');

		$this->db->where('id', $id);
		$this->db->delete('calendar');
		if($this->db->affected_rows() > 0) { //successful
			//log event
			logEvent($user_id = NULL,"Deleted calendar event ID: {$id}",$care_id = NULL);
			return 'true';
		} else {
			return 'true';
		}
	}
}