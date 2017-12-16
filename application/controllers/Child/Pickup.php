<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Filename: ${FILE_NAME}
 * User: John Muchiri
 * Date: 11/11/2014
 */
class pickup extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

        //redirect session
		$this->conf->setRedirect();

		if ($this->conf->isParent() == true && $this->conf->isStaff() !== true) {
			$this->conf->redirectPrev();
		}
	}

	/*
	 * add pickup contact
	 */
	function add_pickup_contact()
	{
		$this->form_validation->set_rules('fname', lang('first_name'), 'required|trim|xss_clean');
		$this->form_validation->set_rules('lname', lang('last_name'), 'required|trim|xss_clean');
		$this->form_validation->set_rules('cell', lang('cellphone'), 'required|integer|xss_clean');
		$this->form_validation->set_rules('pin', lang('pin'), 'required|integer|trim|xss_clean');
		if ($this->form_validation->run() == TRUE) {
			$this->child->add_pickup_contact();
		} else {
			$this->conf->msg('danger', 'Error!');
		}
		$this->conf->redirectPrev();
	}

	/*
	 * delete child pickup profile
	 */
	function delete_pickup($pickup_id)
	{
		//delete images
		$upload_path = './assets/img/pickup';
		$this->db->where('id', $pickup_id);
		$q = $this->db->get('child_pickup');
		foreach ($q->result() as $r) {
			if ($r->photo !== "") :
				unlink($upload_path . '/' . $r->photo);
			endif;
		}

		//delete entry
		$this->db->where('id', $pickup_id);
		if ($this->db->delete('child_pickup')) {
			$this->conf->msg('success', lang('request_success'));
		} else {
			$this->conf->msg('danger', lang('request_error'));
		}
		$this->conf->redirectPrev();
	}

	function uploadPhoto($id = "")
	{
		if (!$this->conf->isStaff()) $this->conf->redirectPrev();

		$upload_path = './assets/img/pickup';
		$upload_db = 'child_pickup';

		if (!file_exists($upload_path)) {
			mkdir($upload_path, 755, true);
		}

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
					unlink($upload_path . '/' . $r->photo);
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