<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @file      : charges.php
 * @author    : John
 * @date      : 8/9/14
 * @Copyright 2014 icoolpix.com
 */
class Charges extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->conf->setRedirect();
        if ($this->conf->isParent() == true && $this->conf->isStaff() == false) {
            $this->conf->redirectPrev();
        }

        //resources
        $this->load->model('My_child', 'child');

        //variables
        $this->module = 'modules/children/';

    }

    /*
     * add charge to account
     * @params int $id
     * @return void
     */
    function add_charge()
    {
        $this->form_validation->set_rules('item', 'Item name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('charge_desc', 'Description', 'required|trim|xss_clean');
        $this->form_validation->set_rules('amount', 'Amount', 'required|trim|xss_clean');
        $this->form_validation->set_rules('due_date', 'Due date', 'required|trim|xss_clean');

        if ($this->form_validation->run() == TRUE) {
            $this->my_child->add_charge($this->child->getID());
        } else {
            $this->conf->msg('danger', 'Error!');
        }
        $this->conf->redirectPrev();
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

            $this->conf->msg('danger', 'Error!');
        }
        $this->conf->redirectPrev();
    }

    /*
     * generate invoice
     * @return void
     */
    function invoice()
    {
        $this->db->where('child_id', $this->child->getID());
        $data['charges'] = $this->db->get('child_charges')->result();


        $this->db->where('child_id', $this->child->getID());
        $this->db->select_sum('amount');
        $b = $this->db->get('child_charges');
        $data['total_charges'] = $b->row()->amount;


        $this->load->view($this->module . 'invoice_form', $data);
    }

    /*
     * add card
     */
    function add_card()
    {
        $this->form_validation->set_rules('name_on_card', lang('name_on_card'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('card_no', lang('card_number'), 'required|trim|xss_clean|integer');
        $this->form_validation->set_rules('expiry', lang('expiry'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('ccv', lang('ccv'), 'required|trim|xss_clean|integer');

        if ($this->form_validation->run() == TRUE) {
            $ccv = $this->conf->encrypt($this->input->post('ccv'));
            $data = array(
                'child_id' => $this->child->getID(),
                'name_on_card' => $this->input->post('name_on_card'),
                'card_no' => $this->conf->encrypt($this->input->post('card_no')),
                'expiry' => $this->input->post('expiry'),
                'ccv' => $ccv,
            );
            if ($this->db->insert('accnt_pay_cards', $data)) {
                $this->conf->msg('success', lang('request_success'));
            } else {
                $this->conf->msg('danger', lang('request_error'));
            }
        } else {

            $this->conf->msg('danger', lang('request_error'));
        }
        $this->conf->redirectPrev();
    }

    /*
     * delete card
     */
    function delete_card($id)
    {
        if (is_numeric($id)) {
            $this->db->where('child_id', $this->child->getID());
            $this->db->where('id', $id);
            if ($this->db->delete('accnt_pay_cards')) {
                $this->conf->msg('success', lang('request_success'));
            } else {
                $this->conf->msg('danger', lang('request_error'));
            }
        }
        $this->conf->redirectPrev();
    }

    /*
     * add bank
     */
    function add_bank()
    {
        $this->form_validation->set_rules('bank_name', lang('bank_name'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('account_no', lang('account_number'), 'required|trim|xss_clean|integer');
        $this->form_validation->set_rules('routing', lang('routing_number'), 'required|trim|xss_clean|integer');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'child_id' => $this->child->getID(),
                'bank_name' => $this->input->post('bank_name'),
                'account_no' => $this->conf->encrypt($this->input->post('account_no')),
                'routing' => $this->input->post('routing'),
            );
            if ($this->db->insert('accnt_pay_bank', $data)) {
                $this->conf->msg('success', lang('request_success'));
            } else {
                $this->conf->msg('danger', lang('request_error'));
            }
        } else {

            $this->conf->msg('danger', lang('request_error'));
        }
        $this->conf->redirectPrev();
    }

    /*
     * delete bank
     */
    function delete_bank($id)
    {
        if (is_numeric($id)) {
            $this->db->where('child_id', $this->child->getID());
            $this->db->where('id', $id);
            if ($this->db->delete('accnt_pay_bank')) {
                $this->conf->msg('success', lang('request_success'));
            } else {
                $this->conf->msg('danger', lang('request_error'));
            }
        }
        $this->conf->redirectPrev();
    }


}