<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @file      : invoice
 * @author    : John Muchiri
 * @date      : 9/16/2014
 * @Copyright 2014 icoolpix.com
 * http://icoolpix.com
 * info@icoolpix.com
 */
class Invoice extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		//redirect session
		$this->conf->setRedirect();

		if ($this->conf->isParent() == true && $this->conf->isStaff() == false) {
			$this->conf->redirectPrev();
		}

		//local variables
		$this->module = 'modules/children/accounting/';

		$this->invoice_db = 'accnt_invoices';
		$this->payments_db = 'accnt_payments';

		$this->load->model('My_child', 'child');
		$this->load->model('My_invoice', 'invoice');

	}

	function index()
	{

	}

	/*
	 * view
	 */
	function view($invoice_id)
	{
		$data = array(
			'invoice' => $this->db->query("SELECT * FROM accnt_invoices WHERE id={$invoice_id}")->row(),
			'invoice_items' => $this->invoice->getInvoiceItems($invoice_id)
		);
		$this->conf->page($this->module . 'view_invoice', $data);
	}

	function preview($invoice_id)
	{

		$data = array(
			'invoice' => $this->db->query("SELECT * FROM accnt_invoices WHERE id={$invoice_id}")->row(),
			'invoice_items' => $this->invoice->getInvoiceItems($invoice_id)
		);
		$this->conf->page($this->module . 'invoice_preview', $data);
	}

	/*
	 * create invoice
	 */
	function create()
	{
		$this->conf->allow('admin,manager,staff');
		$this->conf->page($this->module . 'new_invoice');
	}

	function ajax_calculate_totals()
	{

		$data = array(
			'items_total_cost' => 1,
			'invoice_total_tax' => 22,
			'items_sub_total1' => $this->input->post('item_sub_total'),
			'items_sub_total2' => $this->input->post('item_sub_total'),
			'invoice_discount_amount' => $this->input->post('invoice_discount_amount'),
			'invoice_amount_due' => 2

		);
		echo json_encode($data);
	}

	function save()
	{
		$this->conf->allow('admin,manager,staff');

		$this->form_validation->set_rules('item_name', $this->lang->line('item'), 'required|xss_clean');
		$this->form_validation->set_rules('item_description', $this->lang->line('description'), 'required|xss_clean');
		$this->form_validation->set_rules('item_price', $this->lang->line('item_price'), 'required|xss_clean');
		$this->form_validation->set_rules('item_discount', $this->lang->line('discount'), 'xss_clean');
		$this->form_validation->set_rules('invoice_terms', $this->lang->line('invoice_terms'), 'xss_clean');

		if ($this->form_validation->run() == TRUE) {
			if ($this->invoice->save_invoice()) {
				$this->conf->msg('success', lang('request_success'));
				redirect('child/invoice', 'refresh');
			} else {
				$this->conf->msg('danger', lang('request_error'));
			}
		} else {
			validation_errors();
			$this->conf->msg('danger');
		}
		$this->conf->redirectPrev();
	}

	function add_charge($invoice_id)
	{
		$this->conf->allow('admin,manager,staff');

		$this->form_validation->set_rules('item_name', $this->lang->line('item'), 'required|xss_clean');
		$this->form_validation->set_rules('item_description', $this->lang->line('description'), 'required|xss_clean');
		$this->form_validation->set_rules('item_price', $this->lang->line('item_price'), 'required|xss_clean');
		$this->form_validation->set_rules('item_discount', $this->lang->line('discount'), 'xss_clean');
		$this->form_validation->set_rules('invoice_terms', $this->lang->line('invoice_terms'), 'xss_clean');

		if ($this->form_validation->run() == TRUE) {
			$this->invoice->save_invoice_items($invoice_id);
		} else {
			$this->conf->msg('danger', lang('request_error'));
		}
		$this->conf->redirectPrev();
	}

	function delete($invoice_id)
	{
		$this->conf->allow('admin,manager');

		//delete items
		$this->db->where('invoice_id', $invoice_id);
		$this->db->delete('accnt_invoice_items');

		//delete invoice
		$this->db->where('id', $invoice_id);
		$this->db->delete($this->invoice_db);

		if ($this->db->affected_rows() > 0) {
			$this->conf->msg('success', lang('request_success'));
		} else {
			$this->conf->msg('danger', lang('request_error'));
		}

		$this->conf->redirectPrev();

	}

	function delete_item($id)
	{
		$this->conf->allow('admin,manager');

		$this->db->where('id', $id);
		$this->db->delete('accnt_invoice_items');
		if ($this->db->affected_rows() > 0) {
			$this->conf->msg('success', lang('request_success'));
		} else {
			$this->conf->msg('danger', lang('request_error'));
		}

		$this->conf->redirectPrev();
	}

//update status
	function update_status()
	{
		if ($_POST) {
			$data = array(
				'invoice_status' => $this->input->post("invoice_status")
			);
			$this->db->where('id', $this->input->post('invoice_id'));
			$query = $this->db->update($this->invoice_db, $data);
			if ($query) {
				$this->conf->msg('success', lang('request_success'));
			} else {
				$this->conf->msg('danger', lang('request_error'));
			}
		}
	}

	//update terms
	function update_terms()
	{
		if ($_POST) {
			$data = array(
				'invoice_terms' => $this->input->post("invoice_terms")
			);
			$this->db->where('id', $this->input->post('invoice_id'));
			if ($this->db->update($this->invoice_db, $data)) {
				$this->conf->msg('success', lang('request_success'));
			} else {
				$this->conf->msg('danger', lang('request_error'));
			}
		}
	}

	function payments()
	{
		$data['payments'] = $this->invoice->payments($this->child->getID());
		$this->conf->page($this->module . 'payments', $data);
	}

	//make payment
	function make_payment($invoice_id)
	{
		$this->form_validation->set_rules('amount_paid', $this->lang->line('amount'), 'required|xss_clean');
		$this->form_validation->set_rules('date_paid', $this->lang->line('date'), 'required|xss_clean');
		$this->form_validation->set_rules('payment_method', $this->lang->line('payment_method'), 'required|xss_clean');
		$this->form_validation->set_rules('remarks', $this->lang->line('notes'), 'xss_clean');

		if ($this->form_validation->run() == TRUE) {
			if ($this->invoice->make_payment($invoice_id)) {
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

	function payMethods()
	{
		$data = array(
			'child' => $this->children->child(),
			'cards' => $this->db->where('child_id', $this->child->getID())->get('accnt_pay_cards'),
			'banks' => $this->db->where('child_id', $this->child->getID())->get('accnt_pay_bank'),
		);
		$this->conf->page($this->module . 'pay_method', $data);
	}
}