<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class: my_news
 * User: John Muchiri
 * Email: jgmuchiri@gmail.com
 * Date: 11/17/2014
 *

* https://amdtllc.com
 * Copyright 2014 All Rights Reserved
 */
class my_news extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function articles()
	{
		$query = $this->db->get('news');
		return $query;
	}

	function article($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('news');
		return $query;
	}

	function create()
	{
		$data = array(
			'article_name' => $this->input->post('article_name'),
			'article_body' => $this->input->post('article_body'),
			'user_id' => $this->user->uid(),
			'publish_date' => date_stamp()
		);
		if ($this->db->insert('news', $data))
			return true;
		return false;
	}

	function update($id)
	{
		$data = array(
			'order' => $this->input->post('article_order'),
			'article_name' => $this->input->post('article_name'),
			'article_body' => $this->input->post('article_body')
		);
		$this->db->where('id', $id);
		if ($this->db->update('news', $data))
			return true;
		return false;
	}

	function delete($id)
	{
		$this->db->where('id', $id);
		if ($this->db->delete('news'))
			return true;
		return false;
	}

}