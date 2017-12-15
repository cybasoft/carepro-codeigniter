<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class: my_broadcast
 * User: John Muchiri
 * Email: jgmuchiri@gmail.com
 * Date: 11/26/2014
 * 
 * http://icoolpix.com
 * info@icoolpix.com
 * Copyright 2014 All Rights Reserved
 */
class my_broadcast extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}
	function addMessage($message){
		$data = array(
			'user' => $this->users->uid(),
			'message' => $message,
			'ip_address' => $_SERVER['REMOTE_ADDR']
		);
		if($this->db->insert('broadcast', $data)){
			//log event
			$this->conf->log("Sent broadcast {{$message}}");
			return true;
		}
		return false;

	}
	function getMessages(){
		$query = "SELECT user, message, date_time FROM (select * from broadcast ORDER BY id DESC LIMIT 10) broadcast ORDER BY broadcast.id ASC";
		$query = $this->db->query($query);
		return $query->result();
	}
	function deleteLeave($num){
		$query = "DELETE FROM broadcast WHERE id NOT IN (SELECT * FROM (SELECT id FROM broadcast ORDER BY id DESC LIMIT 0, {$num}) as sb)";
		if($this->db->query($query))
			return true;
		return false;
	}
}