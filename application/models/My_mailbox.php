<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class My_mailbox extends CI_Model
{
	function __construct()
	{
		parent::__construct();

	}

	function messages()
	{
		$this->db->order_by('date_sent', 'DESC');
		$this->db->or_where('sender', $this->users->uid());
		$this->db->or_where('receiver', $this->users->uid());
		return $this->db->get('inbox')->result();
	}

	function message($msg_id)
	{
		//set read status
		$this->set_read_status($msg_id);
		//load message
		$this->db->where('msg_id', $msg_id);
		return $this->db->get('inbox')->row();
	}

	function send()
	{
		$data = array(
			'msg_id' => $this->randomMsgID(),
			'sender' => $this->users->uid(),
			'receiver' => $this->input->post('receiver'),
			'subject' => $this->input->post("subject"),
			'message' => $this->input->post('message'),
			'date_sent' => time(),
			'sender_read' => 1,
			'receiver_read' => 0,
			'location' => 'inbox'
		);
		if($this->db->insert('inbox', $data))
			return true;
		return false;
	}

	/*
		 * reply to message
		 */
	function reply($msg_id)
	{
		$data = array(
			'sender' => $this->users->uid(),
			'parent' => $msg_id,
			'message' => $this->input->post('message'),
			'date_sent' => time()
		);
		if($this->db->insert('inbox_reply', $data)){
			$this->receiver_unread($msg_id);
			$this->sender_unread($msg_id);
			return true;
		}
		return false;
	}
	function set_read_status($msg_id){
		$query = $this->db->where('msg_id',$msg_id)->get('inbox')->row();
		if($query->sender==$this->users->uid()){
			$this->sender_read($msg_id);
		}else{
			$this->receiver_read($msg_id);
		}
	}

	function set_unread_status($msg_id){
		$query = $this->db->where('msg_id',$msg_id)->get('inbox')->row();
		if($query->sender==$this->users->uid()){
			$this->sender_unread($msg_id);
		}else{
			$this->receiver_unread($msg_id);
		}
	}

	function sender_read($msg_id){
		//mark as read
		$this->db->where('msg_id', $msg_id);
		$this->db->update('inbox', array('sender_read' => 1));
	}
	function sender_unread($msg_id){
		//mark as read
		$this->db->where('msg_id', $msg_id);
		$this->db->update('inbox', array('sender_read' => 0));
	}

	function receiver_read($msg_id){
		//mark as read
		$this->db->where('msg_id', $msg_id);
		$this->db->update('inbox', array('receiver_read' => 1));
	}
	function receiver_unread($msg_id){
		//mark as read
		$this->db->where('msg_id', $msg_id);
		$this->db->update('inbox', array('receiver_read' => 0));
	}
	//reply
	function getUser($username)
	{
		$this->db->where('username', $username);
		$q = $this->db->get('users')->result();
		if($q != NULL) {
			foreach($q as $row) {
				return $row->id;
			}
		} else {
			$this->conf->msg('danger', lang('record_not_found'));
			redirect('inbox/compose');
		}

		return false;
	}

	/*
	 * random message generator
	 */
	function randomMsgID()
	{
		return rand(1000000, 9000000) . '' . time();
	}


	function getReplies($msg_id)
	{
		$this->db->where('parent', $msg_id);
		return $this->db->get('inbox_reply')->result();
	}

	function move_to($msg_id,$location){
		if($location=='inbox'){
			$this->set_unread_status($msg_id);
		}
		$data = array(
			'location' => $location
		);
		$this->db->where('msg_id', $msg_id);
		$this->db->update('inbox', $data);
	}
	/*
	 * delete
	 */
	function delete($msg_id)
	{
		//deleting parent deletes all children
		//get the message details
		$this->db->where('msg_id', $msg_id);
		$query = $this->db->get('inbox')->result();
		foreach($query as $r):
			if($r->parent_id == 0) { //its parent
				//delete children
				$this->db->where('parent_id', $msg_id);
				$data['is_read'] = 3;
				$this->db->update('inbox', $data);

				//delete parent
				$this->db->where('msg_id', $msg_id);
				$q = $this->db->update('inbox', $data);

				if($q) {
					$this->conf->msg('success', lang('request_success'));
				} else {
					$this->conf->msg('danger', lang('request_error'));
				}

			} else { //its a child
				$this->db->where('msg_id', $msg_id);
				$data['is_read'] = 3;
				$q = $this->db->update('inbox', $data);
				if($q) {
					$this->conf->msg('success', lang('request_success'));
				} else {
					$this->conf->msg('danger', lang('request_error'));
				}
			}
		endforeach;
	}

	//purge
	function purge($msg_id)
	{
		//deleting parent deletes all children
		//get the message details
		$this->db->where('msg_id', $msg_id);
		$query = $this->db->get('inbox')->result();
		foreach($query as $r):
			if($r->parent_id == 0) { //its parent
				//delete children
				$this->db->where('parent_id', $msg_id);
				$this->db->delete('inbox');
				//delete parent
				$this->db->where('msg_id', $msg_id);
				$q = $this->db->delete('inbox');
				if($q) {
					$this->conf->msg('success', lang('request_success'));
				} else {
					$this->conf->msg('danger', lang('request_error'));
				}
			} else { //its a child
				$this->db->where('msg_id', $msg_id);
				$q = $this->db->delete('inbox');
				if($q) {
					$this->conf->msg('success', lang('request_success'));
				} else {
					$this->conf->msg('danger', lang('request_error'));
				}
			}
		endforeach;
	}

	function msg_stats($receiver)
	{
		$this->db->where('receiver', $receiver);
		$this->db->where('is_read', 1);
		$this->db->from('inbox');
		$q = $this->db->count_all_results();
		return $q;
	}


	function totalUnread()
	{

		$user = $this->users->uid();

		$this->db->where('receiver_read', 0);
		$this->db->where('receiver', $user);
		$a = $this->db->get('inbox')->num_rows();

		$this->db->where('sender_read', 0);
		$this->db->where('sender', $user);
		$b= $this->db->get('inbox')->num_rows();

		return ($a+$b);
	}
}