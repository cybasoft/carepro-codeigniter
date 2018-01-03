<?php

class my_reports extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
	}

	function result_sql($sql)
	{
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	function get_table_list()
	{
		$tables = $this->db->list_tables();
		return $tables;
	}

	function add_record_id($tablename, $data)
	{
		$this->db->insert($tablename, $data);
		$id = $this->db->insert_id();
		return $id;
	}

}