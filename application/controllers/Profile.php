<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @file      : profile.php
 * @author    : JMuchiri
 *
 * @Copyright 2017 A&M Digital Technologies
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
		$this->form_validation->set_rules('phone2', lang('other_phone'), 'xss_clean|trim');
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

    /**
     * @return bool
     */
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

    /**
     * @return bool
     */
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

    /**
     * @return array
     */
	function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

    /**
     * @return bool
     */
	function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
			$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue')) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
    /*
         * upload photos to specific db
         * @param $id int
         * @param $db string
         */

    function uploadPhoto($id = "")
    {
        $upload_path = './assets/img/users/staff';
        $upload_db = 'children';

        if ($id == "") { //make sure there are arguments
            $this->conf->msg('danger', lang('request_error'));
            $this->conf->redirectPrev();
        }

        $config = array(
            'upload_path' => $upload_path,
            'allowed_types' => 'gif|jpg|png|jpeg',
            //'max_size'      => '100',
            'max_width' => '1240',
            'max_height' => '1240',
            'encrypt_name' => true,
        );
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload()) {
            $this->conf->msg('danger', lang('request_error'));
        } else {
            //delete if any exists
            $this->db->where('id', $id);
            $q = $this->db->get($upload_db);
            foreach ($q->result() as $r) {
                if ($r->photo !== "") :
                    @unlink($upload_path . '/' . $r->photo);
                    $data['photo'] = '';
                    $this->db->where('id', $id);

                    $this->db->update($upload_db, $data);
                endif;
            }
            //upload new photo
            $upload_data = $this->upload->data();
            $data_ary = array(
                'photo' => $upload_data['file_name']
            );

            $this->db->where('id', $id);
            $this->db->update($upload_db, $data_ary);
            $data = array('upload_data' => $upload_data);
            if ($data) {
                $this->conf->msg('success', lang('request_success'));
            } else {
                $this->conf->msg('danger', lang('request_error'));
            }
        }
        $this->conf->redirectPrev();
    }


}