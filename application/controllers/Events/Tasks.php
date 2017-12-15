<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Filename: tasks.php
 * User: John Muchiri
 * Date: 11/9/2014
 */
class tasks extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

        //redirect session
		$this->conf->setRedirect();

		if ($this->conf->isParent() == true && $this->conf->isStaff() == false) {
			$this->conf->redirectPrev();
		}

		$this->load->model('My_tasks', 'tasks');
		$this->load->model('My_user', 'user');

        //local variables
		$this->module = 'modules/tasks/';
	}
	function index()
	{
		$data = array(
			'todos' => $this->db->where('user_id', $this->users->uid())->get('todo')->result(),
			'todo_items' => $this->db->get('todo_items')->result()
		);
		$this->conf->page($this->module . 'index', $data);
	}
	function createList()
	{
		$this->form_validation->set_rules('list_name', lang('list_name'), 'trim|css_clean|required');
		if ($this->form_validation->run() == true) {
			if ($this->tasks->createList()) {
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

	function createItem($todoID)
	{
		$this->form_validation->set_rules('item_name', lang('item_name'), 'trim|css_clean|required');
		if ($this->form_validation->run() == true) {
			if ($this->tasks->createItem($todoID)) {
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

	function deleteList($id)
	{
		if ($this->tasks->deleteList($id)) {
			$this->conf->msg('success', lang('item_deleted'));
		} else {
			$this->conf->msg('danger', lang('request_error'));
		}
		$this->conf->redirectPrev();
	}

	function deleteItem($id)
	{
		if ($this->tasks->deleteItem($id)) {
			$this->conf->msg('success', lang('item_deleted'));
		} else {
			$this->conf->msg('danger', lang('request_error'));
		}
		$this->conf->redirectPrev();
	}

	function markItemComplete($id)
	{
		$this->tasks->markItemComplete($id);
		$this->conf->redirectPrev();
	}
}