<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @file      : charges.php
 * @author    : JMuchiri
 * @Copyright 2017 A&M Digital Technologies
 */
class Charges extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        setRedirect();
        auth(true);
        //resources
        $this->load->model('My_child', 'child');
        //variables
        $this->module = 'children/';
        $this->title = lang('billing');
    }

    /*
     * add charge to account
     * @params int $id
     * @return void
     */
    function addCharge($child_id)
    {
        allow(['admin','manager','staff']);
        $this->form_validation->set_rules('item', 'Item name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('charge_desc', 'Description', 'required|trim|xss_clean');
        $this->form_validation->set_rules('amount', 'Amount', 'required|trim|xss_clean');
        $this->form_validation->set_rules('due_date', 'Due date', 'required|trim|xss_clean');

        if ($this->form_validation->run() == TRUE) {
            $this->my_child->add_charge($child_id);
        } else {
            flash('danger', 'Error!');
        }
        redirectPrev();
    }

    /*
     * add a payment to account
     * @params int $id
     * @return void
     */
    function pay_charge($id)
    {
        $this->form_validation->set_rules('paid_amount', 'Amount', 'required|trim|xss_clean|integer');
        $this->form_validation->set_rules('charge_status', 'Status', 'required|trim|xss_clean');
        $this->form_validation->set_rules('pay_method', 'Payment method', 'required|trim|xss_clean');
        $this->form_validation->set_rules('pay_note', 'Notes', 'required|trim|xss_clean');

        if ($this->form_validation->run() == TRUE) {
            $this->my_child->pay_charge($id);
        } else {

            flash('danger', 'Error!');
        }
        redirectPrev();
    }

    /*
     * generate invoice
     * @return void
     */
    function invoice($child_id)
    {
        $this->db->where('child_id', $child_id);
        $data['charges'] = $this->db->get('child_charges')->result();
        $this->db->where('child_id', $child_id);
        $this->db->select_sum('amount');
        $b = $this->db->get('child_charges');
        $data['total_charges'] = $b->row()->amount;
        $this->load->view($this->module . 'invoice_form', $data);
    }


}