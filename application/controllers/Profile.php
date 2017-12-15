<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @file      : profile.php
 * @author    : John
 * @date      : 8/9/14
 * @Copyright 2014 icoolpix.com
 */
class Profile extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		//redirect session
		$this->conf->setRedirect();

		//authenticate
		$this->conf->authenticate();

		$this->load->model('My_profile', 'profile');

		//local variables
		$this->module = 'modules/profile/';

	}

	function index()
	{
		$user_data = $this->db->query("SElECT * FROM user_data WHERE user_id={$this->users->uid()}");
		$data = array(
			'user' => $this->user->user(),
			'user_data' => $user_data->row()
		);
		$this->conf->page($this->module . 'index', $data);

	}

	/*
	 * change pin
	 */
	function change_pin()
	{
		$this->form_validation->set_rules('pin', lang('pin'), 'required|integer|xss_clean|trim|min_length[4]');
		if ($this->form_validation->run() === TRUE) {
			if ($this->profile->change_pin()) {
				$this->conf->msg('success', lang('request_success'));
			} else {
				$this->conf->msg('danger', lang('request_error'));
			}
		} else {
			validation_errors();
			$this->conf->msg('danger');
		}
		redirect('profile');
	}

	/*
	 * change email
	 */
	function update_email()
	{
		$this->form_validation->set_rules('password', lang('password'), 'required|xss_clean|trim|callback_validate_password');
		$this->form_validation->set_rules('email', lang('email'), 'required|valid_email|xss_clean|trim|callback_email_check');
		if ($this->form_validation->run() === TRUE) {
			if ($this->profile->change_email()) {
				$this->conf->msg('success', lang('request_success'));
			} else {
				$this->conf->msg('danger', lang('request_error'));
			}
		} else {
			validation_errors();
			$this->conf->msg('danger');
		}
		redirect('profile');
	}

	/*
	 * change password
	 */
	function change_password()
	{

		$this->form_validation->set_rules('password', lang('old_password'), 'required|callback_validate_password');
		$this->form_validation->set_rules('new_password', lang('new_password'), 'required|min_length[6]|max_length[15]|matches[new_password_confirm]');
		$this->form_validation->set_rules('new_password_confirm', lang('new_password'), 'required');
		if ($this->form_validation->run() == false) {
			validation_errors();
			$this->conf->msg('danger');
		} else {
			if ($this->profile->change_password()) {
				$this->conf->msg('success', lang('request_success'));
			} else {
				$this->conf->msg('danger', lang('request_error'));
			}
		}
		redirect('profile', 'refresh');
	}

	function update_user_data()
	{
		$this->form_validation->set_rules('phone', lang('phone'), 'required|xss_clean|trim');
		$this->form_validation->set_rules('phone2', lang('other_phone'), 'rxss_clean|trim');
		$this->form_validation->set_rules('street', lang('street'), 'required|xss_clean|trim');
		$this->form_validation->set_rules('street2', lang('street2'), 'xss_clean|trim');
		$this->form_validation->set_rules('city', lang('city'), 'required|xss_clean|trim');
		$this->form_validation->set_rules('state', lang('state'), 'required|xss_clean|trim');
		$this->form_validation->set_rules('zip', lang('zip'), 'required|xss_clean|trim');
		$this->form_validation->set_rules('country', lang('country'), 'xss_clean|trim');

		if ($this->form_validation->run() === TRUE) {
			if ($this->profile->update_user_data()) {
				$this->conf->msg('success', lang('request_success'));
			} else {
				$this->conf->msg('danger', lang('request_error'));
			}

		} else {
			validation_errors();
			$this->conf->msg('danger');

		}

		redirect('profile', 'refresh');

	}


	function validate_password()
	{
		$this->load->model('ion_auth_model', 'auth');
		$password = $this->auth->hash_password_db($this->users->uid(), $this->input->post('password'));
		if ($password) {
			return true;
		} else {
			$this->form_validation->set_message('validate_password', lang('password_error'));
			return false;
		}
	}
	function email_check()
	{
		$this->load->model('ion_auth_model', 'auth');
		$email = $this->auth->email_check($this->input->post('email'));
		if ($email) {
			$this->form_validation->set_message('email_check', lang('email_check_error'));
			return false;
		} else {
			return true;
		}
	}
	function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
			$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue')) {
			return TRUE;
		} else {
			return FALSE;
		}
	}


}