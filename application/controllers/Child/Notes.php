<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Filename: ${FILE_NAME}
 * User: John Muchiri
 * Date: 11/10/2014
 */
class notes extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        //redirect session
        $this->conf->setRedirect();

		$this->conf->authenticate();

        //local variables
        $this->module = 'child/notes/';
    }
	/*
	 * add note for selected child
	 * @return void
	 */
	function add_note()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('note-content', 'Note content', 'required|trim|xss_clean');
		if ($this->form_validation->run() == TRUE) {
			$this->child->add_note($child->id);
		} else {
			$this->conf->msg('danger', lang('request_error'));
		}
		redirect('child/notes','refresh');
	}

	/*
	 * delete note
	 */
	function delete_note($id)
	{
		$this->db->where('child_id', $child->id); //only able to delete selected child note
		$this->db->where('id', $id);
		$this->db->delete('child_notes');
		if ($this->db->affected_rows() > 0) {
			$this->conf->msg('success', lang('request_success'));
		} else {
			$this->conf->msg('danger', lang('request_danger'));
		}
		redirect('child/notes','refresh');
	}
}