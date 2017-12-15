<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class My_child extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('My_family', 'family');

	}
	/*
	 * set child id session to be used in this instance
	 * @params none
	 * @return int
	 */
	/*
	 * getAllChildren
	 */
	function children()
	{
		$this->db->where('company', $this->conf->company()->id);
		return $this->db->get('children');
	}

	function child($id = null)
	{
		$query = array();
		if ($id == null) {
			$this->db->where('id', $this->getID());
		} else {
			$this->db->where('id', $id);
		}
		return $this->db->get('children')->row();
	}

	function getID()
	{
		if ($this->session->userdata('view_child_id') !== false) {
			return $this->session->userdata('view_child_id');
		} else {
			redirect('children', 'refresh'); //go back to list to select
			return false;
		}
	}

	/*
	 * get_child
	 * get all child information
	 */

	function add_child()
	{
		$data = array(
			'fname' => $this->input->post('fname'),
			'lname' => $this->input->post('lname'),
			'ssn' => $this->conf->encrypt($this->input->post('ssn')),
			'bday' => $this->input->post('bday'),
			'gender' => $this->input->post('gender'),
			'enroll_date' => time(),
			'last_update' => time(),
			'company' => $this->conf->company()->id,
			'status' => 1
		);
		$this->db->insert('children', $data);
		$last_id = $this->db->insert_id();

		if ($this->db->affected_rows() > 0) {
			$this->conf->msg('success', lang('request_success'));
		} else {
			$this->conf->msg('warning', lang('no_change_to_db'));
		}
		//associate with user
		$data2 = array(
			'child_id' => $last_id
		);

		$this->db->insert('child_users', $data2);
		//log event
		$this->conf->log("Add child {$data['fname']} {$data['lname']}");

		redirect('child/' . $last_id); //go to child record
	}

	/*
	 * get_child_info
	 *
	 */

	function update_child()
	{
		$data = array(
			'fname' => $this->input->post('fname'),
			'lname' => $this->input->post('lname'),
			'bday' => $this->input->post('bday'),
			'ssn' => $this->conf->encrypt($this->input->post('ssn')),
			'blood_type' => $this->input->post('blood_type'),
			'gender' => $this->input->post('gender'),
			'status' => $this->input->post('child_status'),
			'last_update' => time()
		);
		$this->db->where('id', $this->getID());
		$this->db->update('children', $data);
		if ($this->db->affected_rows() > 0) {
			//log event
			$this->conf->log("Updated child {$data['fname']} {$data['lname']}");

			$this->conf->msg('success', lang('request_success'));
		} else {
			$this->conf->msg('warning', lang('no_change_to_db'));
		}
	}


	/*
	 * update child info
	 */

	function update_parent($parent_id)
	{
		$data = array(
			'fname' => $this->input->post('fname'),
			'lname' => $this->input->post('lname'),
			'street' => $this->input->post('street'),
			'city' => $this->input->post('city'),
			'state' => $this->input->post('state'),
			'zip' => $this->input->post('zip'),
			'email' => $this->input->post('email'),
			'cell' => $this->input->post('cell'),
			'work_phone' => $this->input->post('work_phone'),
			'other_phone' => $this->input->post('other_phone'),
			'employer' => $this->input->post('employer'),
			'access_pin' => $this->input->post('access_pin'),
			'relation' => $this->input->post('relation')
		);
		$this->db->where('child_id', $this->getID());
		$this->db->where('id', $parent_id);
		$this->db->update('child_parent', $data);
		if ($this->db->affected_rows() > 0) {
			//log event
			$this->conf->log("Updated parent - {$data['fname']} {$data['lname']}");

			$this->conf->msg('success', lang('request_success'));
		} else {
			$this->conf->msg('warning', lang('no_change_to_db'));
		}
	}

	/*
	 * update parent info
	 */

	function add_emergency_contact()
	{
		$data = array(
			'child_id' => $this->getID(),
			'fname' => $this->input->post('fname'),
			'lname' => $this->input->post('lname'),
			'cell' => $this->input->post('cell'),
			'other_phone' => $this->input->post('other_phone'),
			'address' => $this->input->post('address'),
			'relation' => $this->input->post('relation')
		);

		$this->db->insert('child_emergency', $data);
		if ($this->db->affected_rows() > 0) {
			//log event
			$this->conf->log("Added emergency contact for {$this->getID()} -{$this->child($this->getID())->lname}");

			$this->conf->msg('success', lang('request_success'));
		} else {
			$this->conf->msg('warning', lang('no_change_to_db'));
		}
	}

	/*
	 * add emergency contact to db
	 */

	function add_pickup_contact()
	{
		$data = array(
			'child_id' => $this->getID(),
			'fname' => $this->input->post('fname'),
			'lname' => $this->input->post('lname'),
			'cell' => $this->input->post('cell'),
			'other_phone' => $this->input->post('other_phone'),
			'address' => $this->input->post('address'),
			'pin' => $this->input->post('pin'),
			'relation' => $this->input->post('relation')
		);

		$this->db->insert('child_pickup', $data);
		if ($this->db->affected_rows() > 0) {
			//log event
			$this->conf->log("Added pickup contact for {$this->getID()} -{$this->child($this->getID())->lname}");

			$this->conf->msg('success', lang('request_success'));
		} else {
			$this->conf->msg('warning', lang('no_change_to_db'));
		}
	}

	/*
	 * add pickup contact info
	 */

	function add_note()
	{
		$data = array(
			'child_id' => $this->getID(),
			'content' => $this->input->post('note-content'),
			'user_id' => $this->users->uid(),
			'date' => time()
		);
		$this->db->insert('child_notes', $data);
		if ($this->db->affected_rows() > 0) {
			//log event
			$this->conf->log("Added note for {$this->getID()} -{$this->child($this->getID())->lname}");

			$this->conf->msg('success', lang('request_success'));
		} else {
			$this->conf->msg('warning', lang('no_change_to_db'));
		}
	}

	function add_allergy()
	{
		$data = array(
			'child_id' => $this->getID(),
			'allergy' => $this->input->post('allergy'),
			'reaction' => $this->input->post('reaction'),
		);
		$this->db->insert('child_allergy', $data);
		if ($this->db->affected_rows() > 0) {
			//log event
			$this->conf->log("Added allergy for {$this->getID()} -{$this->child($this->getID())->lname}");

			$this->conf->msg('success', lang('request_success'));
		} else {
			$this->conf->msg('warning', lang('no_change_to_db'));
		}
	}


	function add_med()
	{
		$data = array(
			'child_id' => $this->getID(),
			'med_name' => $this->input->post('med_name'),
			'med_notes' => $this->input->post('med_notes')
		);
		$this->db->insert('child_meds', $data);
		if ($this->db->affected_rows() > 0) {
			//log event
			$this->conf->log("Added med for {$this->getID()} -{$this->child($this->getID())->lname}");


			$this->conf->msg('success', lang('request_success'));
		} else {
			$this->conf->msg('warning', lang('no_change_to_db'));
		}
	}

	function add_charge()
	{
		$data = array(
			'child_id' => $this->getID(),
			'item' => $this->input->post('item'),
			'amount' => $this->input->post('amount'),
			'due_date' => strtotime($this->input->post('due_date')),
			'charged_by' => $this->users->uid(),
			'charge_desc' => $this->input->post('charge_desc'),
			'charge_status' => 'Pending'
		);
		$this->db->insert('child_charges', $data);
		if ($this->db->affected_rows() > 0) {
			//log event
			$this->conf->log("Added charge for {$this->getID()} -{$this->child($this->getID())->lname}");

			$this->conf->msg('success', lang('request_success'));
		} else {
			$this->conf->msg('warning', lang('no_change_to_db'));
		}
	}

	/*
	 * add charge against a child
	 */

	function pay_charge($id)
	{
		$amount_to_pay = $this->input->post('paid_amount');
		$data = array(
			'charge_id' => $id,
			'child_id' => $this->getID(),
			'paid_amount' => $amount_to_pay,
			'pay_method' => $this->input->post('pay_method'),
			'pay_date' => time(),
			'pay_note' => $this->input->post('pay_note'),
			'user_id' => $this->users->uid() //
		);
		$this->db->insert('child_payments', $data);
		if ($this->db->affected_rows() > 0) {
			//log event
			$this->conf->log("Added payment for {$this->getID()} -{$this->child($this->getID())->lname}");

			$this->conf->msg('success', lang('request_success'));
		} else {
			$this->conf->msg('warning', lang('no_change_to_db'));
		}
		//update
		$data2 = array(
			'amount' => $this->newAmount($id, $amount_to_pay),
			'charge_status' => $this->input->post('charge_status'),
			'status_by' => $this->users->uid()
		);
		$this->db->where('id', $id);
		$this->db->update('child_charges', $data2);
	}

	/*
	 * add charge payment to db
	 */

	function newAmount($id, $amount)
	{
		$this->db->where('id', $id);
		foreach ($this->db->get('child_charges')->result() as $r) {
			return ($r->amount - $amount);
		}
		return false;
	}

	/*
	 * subract amount paid partially
	 */

	function check_in($child_id, $parent, $pin)
	{
		$this->db->where('user_id', $parent);
		$this->db->where('pin', $pin);
		$this->db->limit(1);
		if ($this->db->get('user_data')->num_rows() > 0) {
			$data = array(
				'child_id' => $child_id,
				'in_parent_id' => $this->input->post('parent_id'),
				'time_in' => time(),
				'in_staff_id' => $this->users->uid(),
				'checkin_status' => 1

			);
			if ($this->is_checked_in($child_id) == 1) {
				$this->conf->msg('warning', lang('child_already_checked_in'));
			} else {
				if ($this->db->insert('child_checkin', $data)) {
					$this->conf->msg('success', lang('request_success'));
					//notify parents
					$this->notify_parent_checkin_out($child_id, 'checkin');
					//log event
					$this->conf->log("Added checked in {$child_id} -{$this->child($child_id)->lname}");


				} else {
					$this->conf->msg('danger', lang('request_error'));
				}
			}

		} else {
			$this->conf->msg('danger', lang('invalid_pin'));
		}
	}

	/**
	 * @param $child_id
	 */
	function check_out($child_id)
	{
		$this->db->where('user_id', $this->input->post('parent_id'));
		$this->db->where('pin', $this->input->post('pin'));
		if ($this->db->get('user_data')->num_rows() > 0) {
			$data = array(
				'child_id' => $child_id,
				'out_parent_id' => $this->input->post('parent_id'),
				'time_out' => time(),
				'out_staff_id' => $this->users->uid(),
				'checkin_status' => 2

			);
			$chck = $this->is_checked_in($child_id);

			if ($chck == 1) {
				$this->db->where('child_id', $child_id);
				$this->db->where('checkin_status', 1);
				if ($this->db->update('child_checkin', $data)) {
					$this->conf->msg('success', lang('request_success'));

                    //notify parents
					$this->notify_parent_checkin_out($child_id, 'checkout');
                    //log event
					$this->conf->log("Added checked out {$this->getID()} -{$this->child($child_id)->lname}");


				} else {
					$this->conf->msg('danger', lang('request_error'));
				}
			} else {
				$this->conf->msg('warning', lang('child_not_checked_in'));
			}

		} else {
			$this->conf->msg('danger', lang('invalid_pin'));
		}
	}

	/*
	 * get parents
	 */

	function is_checked_in($child_id)
	{
		$this->db->where('checkin_status', 1);
		$this->db->where('child_id', $child_id);
		$query = $this->db->get('child_checkin');
		if ($query->num_rows > 0) {
			foreach ($query->result() as $row) {
				if (date('m/d/Y', strtotime($row->time_in)) == date('m/d/Y', strtotime(time())) && $row->time_out == null) {
					return 1; //checked in not checked out
				} else if (date('m/d/Y', strtotime($row->time_in)) == date('m/d/Y', strtotime(time())) && $row->time_out !== null) {
					return 2;
				}
			}
		} else {
			return 3; //not checked in
		}
		return false;

	}

	/*
	 * check in child
	 */

	function notify_parent_checkin_out($child_id, $type)
	{
		$this->load->library('email');
		$this->email->from($this->company->company()->email, $this->company->company()->name);
		//get parents info
		$parents = $this->getParents($child_id);

		if (count($parents) == 0)
			return false;

		foreach ($parents->result() as $row) {
			if (count($row) == 0)
				return false;

			$this->email->to($row->email); //email parent
			//$this->email->cc('example@example.com');
			$this->email->bcc($this->company->company()->email); //email admin to log
			switch ($type) {
				case 'checkin':
					$this->email->subject(lang('check_in_alert_subject') . ' ' . $this->child($child_id)->fname);
					$msg[] = '<br>' . lang('child_checked_in_message');
					$msg[] = '<br><h2>' . $this->child($child_id)->lname . ', '
						. $this->child($child_id)->fname . '</h2>';
					$msg[] = '<br>' . lang('date') . ': ' . date('d M, Y', time());
					$msg[] = '<br>' . lang('time') . ': ' . date('H:i', time());
					break;
				case 'checkout':
					$this->email->subject(lang('check_out_alert_subject') . ' ' . $this->child($child_id)->lname);
					$msg[] = '<br>' . lang('child_checked_out_message');
					$msg[] = '<br><h2>' . $this->child($child_id)->lname . ', '
						. $this->child($child_id)->fname . '</h2>';
					$msg[] = '<br>' . lang('date') . ': ' . date('d M, Y', time());
					$msg[] = '<br>' . lang('time') . ': ' . date('H:i', time());
					break;
				default:
					$msg[] = "";
					break;
			}
			$this->email->message(implode($msg));
			if ($this->email->send())
				return true;
			return false;
			//echo $this->email->print_debugger();
		}
	}


	/**
	 * @param $child_id
	 * @return mixed|object
	 */
	function getParents($child_id)
	{
		$this->db->where('child_users.child_id', $child_id);
		$this->db->select('child_users.child_id,child_users.user_id,users.*');
		$this->db->from('users');
		$this->db->join('child_users', 'child_users.user_id=users.id');
		return $this->db->get();
	}

	/**
	 * @param null $id
	 * @return mixed
	 */
	function getParent($id = null)
	{
		$this->db->where('children.company', $this->conf->cid());
		$this->db->where('children.id', $id);
		$this->db->select('*');
		$this->db->from('children');
		$this->db->join('child_users', 'child_users.child_id=children.id');
		$this->db->join('users', 'users.id=child_users.user_id');
		return $this->db->get()->row();
	}

	/**
	 * @param $db
	 * @return mixed
	 */
	function getData($db)
	{
		$data = array();
		if ($db == 'child_checkin') $this->db->order_by('id', 'DESC');

		$this->db->where('child_id', $this->getID());
		return $this->db->get($db)->result();
	}

	/**
	 * @param $id
	 * @return mixed
	 */
	function status($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('child_status')->row()->status_name;
	}

	/**
	 * @return mixed
	 */
	function getCount()
	{
		return $this->children()->num_rows();
	}

	/**
	 * @param $db
	 * @param $child_id
	 * @return int|string
	 */
	function totalRecords($db, $child_id)
	{
		$this->db->where('child_id', $child_id);
		return $this->db->count_all_results($db);
	}

	/*
	 * HEALTH
	 */
	function add_insurance()
	{
		$child_id = $this->getID();

		$data = array(
			'child_id' => $child_id,
			'p_name' => $this->input->post('p_name'),
			'p_num' => $this->input->post('p_num'),
			'g_num' => $this->input->post('g_num'),
			'expiry' => $this->input->post('expiry'),
		);
		if ($this->db->insert('child_insurance', $data)) {
			//log event
			$this->conf->log("Added insurance for {$child_id} -{$this->child($child_id)->lname}");
			return true;
		}
		return false;
	}

	/**
	 * @param $id
	 * @return bool
	 */
	function delete_insurance($id)
	{
		$this->db->where('id', $id);
		if ($this->db->delete('child_insurance')) {
			//log event
			$this->conf->log("Delete insurance for {$child_id} -{$this->child($child_id)->lname}");
			return true;
		}
		return false;
	}
}