<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class: my_health
 * User: John Muchiri
 * Email: jgmuchiri@gmail.com
 * Date: 11/29/2014
 * 
 * http://icoolpix.com
 * info@icoolpix.com
 * Copyright 2014 All Rights Reserved
 */
class my_health extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}
	function add_allergy()
	{
		$data = array(
			'child_id' => $this->getID(),
			'allergy' => $this->input->post('allergy'),
			'reaction' => $this->input->post('reaction'),
		);
		$this->db->insert('child_allergy', $data);
		if($this->db->affected_rows() > 0) {
			$this->conf->msg('success', lang('request_success'));
		} else {
			$this->conf->msg('warning', lang('no_change_to_db'));
		}
	}


	function add_med()
	{
		$data = array(
			'child_id' => $this->getID(),
			'med_name' => $this->input->post('med_name'),
			'med_notes' => $this->input->post('med_notes')
		);
		$this->db->insert('child_meds', $data);
		if($this->db->affected_rows() > 0) {
			$this->conf->msg('success', lang('request_success'));
		} else {
			$this->conf->msg('warning', lang('no_change_to_db'));
		}
	}
}