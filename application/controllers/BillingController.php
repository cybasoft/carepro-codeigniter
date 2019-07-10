<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class BillingController extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        setRedirect();
        auth(true);
        //local variables
        $this->module = 'child/billing/';
        $this->invoice_db = 'invoices';
        $this->payments_db = 'accnt_payments';
        $this->load->model('My_child', 'child');
        $this->load->model('My_invoice', 'invoice');
        $this->title = lang('child').'-'.lang('invoice');
    }

    function index($id)
    {
        $daycare_id = $this->session->userdata('owner_daycare_id');
        $child_id = $id;
        $child = $this->child->first($child_id);
        $invoices = $this->invoice->childInvoices($child_id);
        $daycare_id = $this->session->userdata('daycare_id');
        $stripe_details = $this->db->get_where('daycare_settings',array(
            'daycare_id' => $daycare_id
        ));
        $stripe = $stripe_details->row();
        $key = $stripe->stripe_pk_live;
        page($this->module.'invoices', compact('child','invoices','daycare_id','stripe','key'));
    }
}