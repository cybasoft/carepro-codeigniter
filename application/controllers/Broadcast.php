<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class:
 * User: John Muchiri
 * Email: jgmuchiri@gmail.com
 * Date: 11/24/2014
 *

* https://amdtllc.com
 * Copyright 2014 All Rights Reserved
 */
class broadcast extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		//redirect session
		$this->conf->setRedirect();

		//authenticate
		$this->conf->authenticate();

		//local variables
		$this->module = 'modules/broadcast/';
	}

	function index()
	{
		$this->load->view($this->module . 'index');
	}
    
	function shout()
	{
		if($_POST) {
			//check if its an ajax request, exit if not
			if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
				die();
			}

			if(isset($_POST["message"]) && strlen($_POST["message"]) > 0) {
				$username = $this->users->uid();
				$message = filter_var(trim($_POST["message"]), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
				//insert new message in db
				if($this->broadcast->addMessage($message)) {
					$msg_time = date('h:i A M d', time()); // current time
					echo '<div class="shout_msg"><time>' . $msg_time . '</time><span class="username">' . $this->users->user($username)->username . '</span><span class="message">' . $message . '</span></div>';
				}
				// delete all records except last 10, if you don't want to grow your db size!
				$this->broadcast->deleteLeave(10);

			} elseif($_POST["fetch"] == 1) {
				foreach($this->broadcast->getMessages() as $row) {
					$msg_time = date('h:i A M d', strtotime($row->date_time)); //message posted time
					echo '<div class="shout_msg"><time>' . $msg_time . '</time><span class="label label-default">' . $this->users->user($row->user)->username . '</span> <span class="message">' . $row->message . '</span></div>';
				}

			} else {
				header('HTTP/1.1 500 '.lang('request_error'));
				exit();
			}
		}
	}
}