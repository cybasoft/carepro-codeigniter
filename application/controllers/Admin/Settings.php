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
		$upload_path = './assets/img/';

		$config = array(
			'upload_path' => $upload_path,
			'allowed_types' => 'gif|jpg|png|jpeg',
			'max_size' => '2048',
			'max_width' => '500',
			'max_height' => '112',
			'encrypt_name' => false,
		);

		if (!file_exists($upload_path . $this->config->item('logo', 'company'))) {
			mkdir($upload_path, 755, true);
		}

		//delete current logo
		if (file_exists($upload_path . $this->config->item('logo', 'company'))) {
			@unlink($upload_path . $this->config->item('logo', 'company'));
		}

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('logo')) {
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

		$file_path = './assets/img/' . $this->config->item('logo', 'company');
		if (file_exists($file_path)) {
			@unlink($file_path); //delete logo from directory
		}
		$this->conf->redirectPrev();
	}
}