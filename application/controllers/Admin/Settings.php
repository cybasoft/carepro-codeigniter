<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @file      : settings.php
 * @author    : John
 * @date      : 8/9/14
 * @Copyright 2014 icoolpix.com
 */
class Settings extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->conf->setRedirect();

		$this->conf->allow('admin,manager');

		$this->load->model('My_settings', 'settings');

		//variables
		$this->module = 'modules/admin/';

	}

	function index()
	{
		$this->conf->page($this->module . 'index');
	}

	/*
	 * submit settings changes to db
	 * @return void
	 */

	function update_settings()
	{
		$this->form_validation->set_rules('company_name', 'Company Name', 'required|trim|xss_clean');
		$this->form_validation->set_rules('slogan', 'Slogan', 'trim|xss_clean');
		//$this->form_validation->set_rules('maintenance', 'Maintenance', 'required|trim|xss_clean|integer');
		//$this->form_validation->set_rules('allow_reg', 'Allow Registration', 'required|trim|xss_clean');
		$this->form_validation->set_rules('encrypt_key', 'Encryption Key', 'required|trim|xss_clean');
		$this->form_validation->set_rules('paypal_email', 'Paypal email', 'required|trim|xss_clean');
		$this->form_validation->set_rules('version', 'Version', 'trim|xss_clean');
		$this->form_validation->set_rules('google_analytics', 'Google analytics code', 'trim|xss_clean');
		$this->form_validation->set_rules('currency', lang('currency'), 'trim|xss_clean');
		$this->form_validation->set_rules('curr_symbol', lang('curr_symbol'), 'trim|xss_clean');

		if ($this->form_validation->run() == TRUE) {
			if ($this->company->update_settings()) {
				$this->conf->msg('success', lang('request_success'));
			} else {
				$this->conf->msg('danger', lang('request_error'));
			}
		} else {
			validation_errors();
			$this->conf->msg('danger');
		}

		$this->conf->redirectPrev();
	}

	/*
	 * update company address
	 */
	function update_company_address()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|valid_email');
		$this->form_validation->set_rules('phone', 'Phone', 'required|trim|xss_clean');
		$this->form_validation->set_rules('fax', 'Fax', 'trim|xss_clean');
		$this->form_validation->set_rules('website', 'Website', 'required|trim|xss_clean');
		$this->form_validation->set_rules('street', 'Street', 'required|trim|xss_clean');
		$this->form_validation->set_rules('city', 'City', 'required|trim|xss_clean');
		$this->form_validation->set_rules('state', 'State', 'required|trim|xss_clean');
		$this->form_validation->set_rules('zip', 'Zipcode', 'required|trim|xss_clean|integer');

		if ($this->form_validation->run() == TRUE) {

			if ($this->company->update_address()) {
				$this->conf->msg('success', lang('request_success'));
			} else {
				$this->conf->msg('danger', lang('request_error'));
			}
		} else {
			validation_errors();
			$this->conf->msg('danger');
		}

		$this->conf->redirectPrev();
	}

	/*
	 * purge payments for a child
	 */
	function purge_payments()
	{
		$this->conf->page($this->module . 'purge_payments');
	}

	/*
	 * purge all charges from child record
	 */
	function purge_charges()
	{
		$this->conf->page($this->module . 'purge_charges');
	}

	/*
	 * completely delete a child and associated data
	 */
	function purge_child()
	{
		$this->conf->page($this->module . 'purge_child');
	}

	function upload_logo()
	{
		$upload_path = './assets/img';

		$config = array(
			'upload_path' => $upload_path,
			'allowed_types' => 'gif|jpg|png|jpeg',
			'max_size' => '2048',
			'max_width' => '500',
			'max_height' => '112',
			'encrypt_name' => false,
		);

		if (!file_exists($upload_path . '/logo.png')) {
			mkdir($upload_path, 755, true);
		}

		//delete current logo
		if (file_exists($upload_path . '/logo.png')) {
			unlink($upload_path . '/logo.png');
		}

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('company_logo')) {
			$errors['errors'] = $this->upload->display_errors();
			$this->conf->msg('danger', lang('request_error') . implode('', $errors));
		} else {
			$upload_data = $this->upload->data();
			$data = array('upload_data' => $upload_data);
			if ($data) {
				$this->conf->msg('success', lang('request_success'));
			} else {
				$this->conf->msg('danger', lang('request_error'));
			}
		}
		redirect('settings', 'refresh');

	}

	function delete_logo()
	{
		$this->conf->msg('danger', lang('feature_disabled_in_demo'));
		$this->conf->redirectPrev();

		$file_path = './assets/img/logo.png';
		if (file_exists($file_path)) {
			unlink($file_path); //delete logo from directory
		}
		$this->conf->redirectPrev();
	}
}