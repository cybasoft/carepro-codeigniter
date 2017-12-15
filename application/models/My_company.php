<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class: my_company
 * User: John Muchiri
 * Email: jgmuchiri@gmail.com
 * Date: 11/19/2014
 *
 * http://icoolpix.com
 * info@icoolpix.com
 * Copyright 2014 All Rights Reserved
 */
class my_company extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function companies()
	{
		return $this->db->get('companies');
	}

	function company($id = null)
	{
		$cid = $this->conf->sess('company_id');
		if($id == null) {
			$this->db->where('id', $cid);
		} else if($cid == 0) {
			$this->msg('danger', lang('request_error') . ' > unable to find your company. Contact support');
			redirect('logout', 'refresh');
		} else {
			$this->db->where('id', $id);
		}
		return $this->db->get('companies')->row();
	}


	function create()
	{
		$rand = $this->randCompanyID();
		$data = array(
			'name' => $this->input->post('company_name'),
			'street' => $this->input->post('street'),
			'city' => $this->input->post('city'),
			'state' => $this->input->post('state'),
			'zip' => $this->input->post('zip'),
			'country' => $this->input->post('country'),
			'phone' => $this->input->post('c_phone'),
			'email' => $this->input->post('email'),
			'code' => $rand,
			'allow_reg' => 1,
			'currency' => 'USD',
			'curr_symbol' => '$',
			'date_format' => 'm-d-y',
			'reg_date'=>time()
		);
		if($this->db->insert('companies', $data)) {
			if($this->initCompany($rand)) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function initCompany($randID)
	{
		//create resource directory
		$path = 'assets/companies/' . $randID;
		if(!file_exists($path)) {
			mkdir($path, 0755, true);
			mkdir($path . '/images/staff', 0755, true);
			mkdir($path . '/images/children', 0755, true);
			mkdir($path . '/uploads/photos', 0755, true);
			mkdir($path . '/uploads/documents', 0755, true);
			mkdir($path . '/uploads/videos', 0755, true);
			return true;
		} else {
			return false;
		}

	}

	function randCompanyID()
	{
		return str_shuffle(substr(microtime(), -10));
	}

	function update_settings()
	{
		$data = array(
			'name' => $this->input->post('company_name'),
			'slogan' => $this->input->post('slogan'),
			'maintenance' => $this->input->post('maintenance'),
			//'allow_reg'=>$this->input->post('allow_reg'),
			'encrypt_key' => $this->input->post('encrypt_key'),
			'paypal_email' => $this->input->post('paypal_email'),
			'time_zone' => $this->input->post('time_zone'),
			'google_analytics' => $this->input->post('google_analytics'),
			'currency' => $this->input->post('currency'),
			'curr_symbol' => $this->input->post('curr_symbol')
		);
		//$this->db->where('id',$this->conf->sess('company_id'));
		$this->db->where('id', $this->conf->company()->id);
		if($this->db->update('companies', $data))
			return true;
		return false;
	}

	function update_address()
	{
		$data = array(
			'phone' => $this->input->post('phone'),
			'fax' => $this->input->post('fax'),
			'email' => $this->input->post('email'),
			'website' => $this->input->post('website'),
			'street' => $this->input->post('street'),
			'city' => $this->input->post('city'),
			'state' => $this->input->post('state'),
			'zip' => $this->input->post('zip'),
			'country' => $this->input->post('country')
		);
		$this->db->where('id', $this->conf->company()->id);
		if($this->db->update('companies', $data))
			return true;
		return false;
	}

	function logo()
	{
		if($this->company()->logo == ""):
			return '<img class=""
		 src="' . base_url() . 'assets/images/no-logo.png"/>';
		else:
			return '<img class=""
		 src="' . base_url() . 'assets/companies/' . $this->company()->code . '/' . $this->company()->logo . '"/>';
		endif;
	}


	function cid()
	{
		return $this->conf->sess('company_id');
	}
}