<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class: tasks
 * User: John Muchiri
 * Email: jgmuchiri@gmail.com
 * Date: 11/14/2014
 *
 * http://icoolpix.com
 * info@icoolpix.com
 * Copyright 2014 All Rights Reserved
 */
class My_tasks extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function activeItems($user = null)
	{
		$this->db->where('todo.user_id', $this->users->uid());
		$this->db->select('*');
		$this->db->from('todo');
		$this->db->join('todo_items', 'todo.id=todo_items.todo_id');
		return $this->db->get()->result();
	}

	function todoItems($todo_id = null, $user = null, $status = null)
	{
		if($user == null) {
			$this->db->where('todo.user_id', $this->users->uid());
		} else {
			$this->db->where('todo.user_id', $user);
		}
		if($todo_id !== null) {
			$this->db->where('todo.id', $todo_id);
		}
		if($status !== null) {
			$this->db->where('todo_items.item_status', $status);
		}

		$this->db->select('*');
		$this->db->from('todo');
		$this->db->join('todo_items', 'todo.id=todo_items.todo_id');
		return $this->db->get()->result();
	}

	function todo($id, $item = null)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('todo_items')->row();
		return $query->$item;
	}

	function createList()
	{
		$data = array(
			'user_id' => $this->users->uid(),
			'list_name' => $this->input->post('list_name'),
			'status' => 'active'
		);
		if($this->db->insert('todo', $data))
			return true;
		return false;
	}

	function createItem($todoID)
	{
		$data = array(
			'todo_id' => $todoID,
			'item_name' => $this->input->post('item_name'),
			'item_status' => 'active'
		);
		if($this->db->insert('todo_items', $data))
			return true;
		return false;
	}

	function deleteList($id)
	{
		$this->db->where('todo_id', $id);
		if($this->db->delete('todo_items')) {
			$this->db->where('id', $id);
			if($this->db->delete('todo'))
				return true;
			return false;
		} else {
			return false;
		}

	}

	function deleteItem($id)
	{
		$this->db->where('id', $id);
		if($this->db->delete('todo_items'))
			return true;
		return false;
	}

	function changeColor($todo)
	{
		if($this->isPrime($todo)) {
			return 'box-info';
		} else {
			if($todo % 2 == 0) {
				return 'box-warning';
			}
			return 'box-primary';
		}
	}

	function isPrime($num)
	{
		if($num == 1)
			return false;
		if($num == 2)
			return true;
		if($num % 2 == 0) {
			return false;
		}
		for($i = 3; $i <= ceil(sqrt($num)); $i = $i + 2) {
			if($num % $i == 0)
				return false;
		}
		return true;
	}

	function markItemComplete($id)
	{
		$this->db->where('id', $id);
		$data['item_status'] = 'completed';
		if($this->db->update('todo_items', $data))
			return true;
		return false;
	}

	function checkComplete($id)
	{
		$this->db->where('id', $id);
		$this->db->limit(1);
		$query = $this->db->get('todo_items')->result();
		foreach($query as $row) {
			if($row->item_status == 'completed')
				return '<i class="fa fa-check-square-o"></i>';
		}
		return "";
	}

	function getCount($status = null, $user = null)
	{
		if($user == null) {
			$this->db->where('todo.user_id', $this->users->uid());
		} else {
			$this->db->where('todo.user_id', $user);
		}
		if($status !== null) {
			$this->db->where('todo_items.item_status', $status);
		}
		$this->db->select('*');
		$this->db->from('todo');
		$this->db->join('todo_items', 'todo_items.todo_id=todo.id');
		$query = $this->db->get();
		return $query->num_rows();
	}

	function modified($date)
	{

		$when = "";

		$day = date('d M y', strtotime($date));
		$d = time() - strtotime($day);
		if($day == date('d M y', strtotime("0 days"))) {
			$when = 'today';
		} else if($day == date('d M y', strtotime("-1 days"))) {
			$when = 'yesterday';
		} else {
			$when = $day;
		}
		return $when;
	}
}