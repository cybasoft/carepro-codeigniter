<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @file      : family.php
 * @project   : DaycarePro
 * @author    : John
 * @date      : 8/10/14
 * @Copyright 2014 icoolpix.com
 * @version   : 1.0.1
 */
class family extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->conf->setRedirect();

		if ($this->conf->isParent() == false || $this->conf->isAdmin() == false) {
			//$this->conf->redirectPrev();
		}

		//resources
		$this->load->library('table');
		$this->load->model('My_family', 'family');
		$this->load->model('My_invoice', 'invoice');
		$this->load->model('My_health', 'health');

		//variables
		$this->module = "family/";
		$this->curr = $this->config->item('currency_symbol', 'company');
	}

	/*
	 * load header, nav, footer
	 */

	function index()
	{
		$data['children'] = $this->family->getChildren($this->users->uid());
		$this->family->page($this->module . 'children', $data);
	}

	/*
	 * set child session
	 */
	function viewchild($child_id = 0)
	{
		//prevent errors from non numerals and negatives
		if ($child_id <= 0 || !is_numeric($child_id)) {
			$this->conf->redirectPrev();
		} else {
			if ($this->family->child_belongs_to_parent($child_id, $this->users->uid()) == true) { //make sure parent can view this child
				$this->session->set_userdata('view_child_id', $child_id);
				redirect('family/child');
			} else {
				$this->conf->msg('danger', lang('access_denied'));
				$this->conf->redirectPrev();
			}
		}
	}

	/*
	 * view child
	 */
	function child()
	{
		$data = array(
			'child' => $this->children->child($this->children->getID()),
			'pickups' => $this->children->getData('child_pickup'),
			'attendance' => $this->children->getData('child_checkin'),

			'insurance' => $this->children->getData('child_insurance'),
			'foods' => $this->children->getData('child_foodpref'),
			'allergies' => $this->children->getData('child_allergy'),
			'meds' => $this->children->getData('child_meds'),

			'eContact' => $this->children->getData('child_emergency'),

			'notes' => $this->children->getData('child_notes')
		);
		$this->family->page($this->module . 'child', $data);
	}

	/*
	 * validate and add child record to db
	 * @params 0
	 * @return void
	 */
	function register()
	{
		$this->form_validation->set_rules('fname', 'Firstname', 'required|trim|xss_clean');
		$this->form_validation->set_rules('lname', 'Lastname', 'required|trim|xss_clean');
		$this->form_validation->set_rules('ssn', 'Social security number', 'required|trim|xss_clean|integer');
		$this->form_validation->set_rules('bday', 'Birthday', 'required|trim|xss_clean');
		$this->form_validation->set_rules('gender', 'Gender', 'required|trim|xss_clean');
		if ($this->form_validation->run() == TRUE) {
			$this->family->register_child();
		} else {
			$this->conf->msg('danger');
			validation_errors();
			$this->family->page($this->module . 'register_child');
		}
	}

	function invoice($term = 0)
	{
		$this->db->where('child_id', $this->child->getChildId());

		if (isset($_GET['do'])) {
			$this->db->like('id', $term);
			$query = $this->invoice->getInvoices();
		} else {
			if ($term == 0) {
				$query = $this->invoice->getInvoices();
			} else {
				$this->db->where('invoice_status', $term);
				$query = $this->invoice->getInvoices();
			}
		}
		$tmpl = array(
			'table_open' => '<table class="table table-responsive table-hover, table-stripped">',
			'heading_cell_start' => '<th class="header bg-default">',
			'heading_cell_end' => '</th>',
			'table_close' => '</table>'
		);
		$this->table->set_template($tmpl);
		$this->table->set_heading('#', lang('status'), lang('amount'), lang('paid'), lang('amount_due'), lang('due_date'), lang('actions'));
		foreach ($query as $row) {
			$preview = anchor('invoice/invoice_preview/' . $row->id, '<span class="btn btn-xs btn-info" ><i class="glyphicon glyphicon-print"></i></span>');

			$subTotal = $this->invoice->invoice_subtotal($row->id);
			$totalDue = number_format($subTotal - $this->invoice->amount_paid($row->id), 2);
			if ($totalDue < 0) {
				$totalDue = $totalDue . ' <span class="label label-success">' . lang('refund') . ' </span>';
				$this->invoice->update_status($row->id, 1); //invoice is paid
			}

			$amount_paid = $this->invoice->amount_paid($row->id) > 0 ? $this->invoice->amount_paid($row->id) : '0.00';

			$this->table->add_row(
				anchor('invoice/invoice_preview/' . $row->id, $row->id),
				$this->invoice->invoice_status($row->invoice_status),
				$this->curr . $subTotal,
				$this->curr . $amount_paid,
				'<span class="text-danger">' . $this->curr . $totalDue . '</span>',
				$row->invoice_due_date,
				$preview
			);
		}
		echo $this->table->generate();
	}

	function roster()
	{
		$this->load->model('My_family', 'family');
		$this->load->model('My_user', 'user');
		$parents = $this->family->parents();
		$this->load->view('family/roster', compact('parents'));
	}

}