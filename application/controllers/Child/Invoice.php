<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @file      : invoice
 * @author    : JMuchiri
 * @Copyright 2017 A&M Digital Technologies
 * https://amdtllc.com
 */
class Invoice extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //redirect session
        setRedirect();
        if (is('parent') == true && is('staff') == false) {
            redirectPrev();
        }
        //local variables
        $this->module = 'modules/child/billing/';
        $this->invoice_db = 'invoices';
        $this->payments_db = 'accnt_payments';
        $this->load->model('My_child', 'child');
        $this->load->model('My_invoice', 'invoice');
    }

    function index($id)
    {
        $child = $this->child->first($id);
        $invoices = $this->db->where('child_id', $id)->get('invoices')->result();
        page($this->module . 'index', compact('child', 'invoices'));
    }

    function invoices($id, $status)
    {
        $child = $this->child->first($id);
        if ($status !== "all") {
            switch ($status) {
                case "paid":
                    $s = 1;
                    break;
                case "due":
                    $s = 2;
                    break;
                case "cancelled":
                    $s = 3;
                    break;
                default:
                    $s = 2;
                    break;
            }
            $this->db->where('invoice_status', $s);
        }

        if (isset($_GET['search'])) {
            $this->db->like('id', $_GET['search']);
        }
        $this->db->where('child_id', $child->id);
        $invoices = $this->invoice->getInvoices();
        $this->load->view($this->module . 'invoices', compact('child', 'invoices'));
    }

    /*
     * view
     */
    function view($invoice_id)
    {
        $invoice = $this->db->query("SELECT * FROM invoices WHERE id={$invoice_id}")->row();
        $invoice_items = $this->invoice->getInvoiceItems($invoice_id);
        $child = $this->child->first($invoice->child_id);
        $subTotal = 0;
        $totalTax = 0;
        page($this->module . 'view_invoice', compact('invoice', 'child', 'invoice_items', 'subTotal', 'totalTax'));
    }

    /*
     * create invoice
     */
    function create($id)
    {
        allow('admin,manager,staff');
        $child = $this->child->first($id);
        page($this->module . 'new_invoice', compact('child'));
    }

    function store($id)
    {
        allow('admin,manager,staff');

        $this->form_validation->set_rules('item_name', lang('item'), 'required|xss_clean');
        $this->form_validation->set_rules('description', lang('description'), 'required|xss_clean');
        $this->form_validation->set_rules('price', lang('price'), 'required|xss_clean|callback_is_money');
        $this->form_validation->set_rules('invoice_terms', lang('invoice_terms'), 'xss_clean');

        if ($this->form_validation->run() == TRUE) {
            if ($this->invoice->createInvoice($id)) {
                flash('success', lang('request_success'));
            } else {
                flash('danger', lang('request_error'));
                redirectPrev();
            }
        } else {
            validation_errors();
            flash('danger');
            redirectPrev();
        }
        redirect('child/' . $id . '/billing');
    }

    function is_money($money)
    {
        if (preg_match('/^\s*[$]?\s*((\d+)|(\d{1,3}(\,\d{3})+))(\.\d{2})?\s*$/', $money)) {
            return true;
        } else {
            $this->form_validation->set_message('is_money', "The %s field must contain a price (money) value");
            return false;

        }
    }

    /**
     * @param $id
     */
    function addItem($id)
    {
        $this->form_validation->set_rules('item_name', lang('item'), 'required|xss_clean');
        $this->form_validation->set_rules('description', lang('description'), 'required|xss_clean');
        $this->form_validation->set_rules('price', lang('price'), 'required|xss_clean|callback_is_money');
        $this->form_validation->set_rules('qty', lang('quantity'), 'required|xss_clean');

        if ($this->form_validation->run() == TRUE) {
            $query = $this->db->insert('invoice_items', [
                'invoice_id' => $id,
                'item_name' => $this->input->post('item_name'),
                'description' => $this->input->post('description'),
                'qty' => $this->input->post('qty'),
                'price' => $this->input->post('price'),
            ]);
            if ($query) {
                flash('success', lang('request_success'));
            } else {
                flash('error', lang('request_error'));
            }
        } else {
            flash('error');
            validation_errors();
        }
        redirectPrev();
    }

    function preview($invoice_id)
    {

        $data = array(
            'invoice' => $this->db->query("SELECT * FROM invoices WHERE id={$invoice_id}")->row(),
            'invoice_items' => $this->invoice->getInvoiceItems($invoice_id)
        );
        $this->load->view($this->module . 'invoice_preview', $data);
    }

    function delete($invoice_id)
    {
        allow('admin,manager');

        //delete items
        $this->db->where('invoice_id', $invoice_id);
        $this->db->delete('invoice_items');

        //delete invoice
        $this->db->where('id', $invoice_id);
        $this->db->delete($this->invoice_db);

        if ($this->db->affected_rows() > 0) {
            flash('success', lang('request_success'));
        } else {
            flash('danger', lang('request_error'));
        }

        redirectPrev();

    }

    function deleteItem($invoice_id, $item_id)
    {
        allow('admin,manager');

        $this->db->where('id', $item_id);
        $this->db->where('invoice_id', $invoice_id);
        $this->db->delete('invoice_items');
        if ($this->db->affected_rows() > 0) {
            flash('success', lang('request_success'));
        } else {
            flash('danger', lang('request_error'));
        }

        redirectPrev();
    }

//update status
    function updateStatus($id)
    {
        if ($_POST) {
            $data = array(
                'invoice_status' => $this->input->post("invoice_status")
            );
            $this->db->where('id', $id);
            $query = $this->db->update($this->invoice_db, $data);
            if ($query) {
                flash('success', lang('request_success'));
            } else {
                flash('danger', lang('request_error'));
            }
        }
    }

    //update terms
    function updateTerms()
    {
        if ($_POST) {
            $data = array(
                'invoice_terms' => $this->input->post("invoice_terms")
            );
            $this->db->where('id', $this->input->post('invoice_id'));
            if ($this->db->update($this->invoice_db, $data)) {
                flash('success', lang('request_success'));
            } else {
                flash('danger', lang('request_error'));
            }
        }
    }

    /**
     * @param $child_id
     */
    function payments($child_id)
    {
        $data['payments'] = $this->invoice->payments($child_id);
        page($this->module . 'payments', $data);
    }

    /**
     * @param $invoice_id
     */
    function makePayment($invoice_id)
    {
        $this->form_validation->set_rules('amount', lang('amount'), 'required|xss_clean');
        $this->form_validation->set_rules('date_paid', lang('date'), 'required|xss_clean');
        $this->form_validation->set_rules('method', lang('payment_method'), 'required|xss_clean');
        $this->form_validation->set_rules('remarks', lang('notes'), 'xss_clean');

        if ($this->form_validation->run() == TRUE) {
            if ($this->invoice->makePayment($invoice_id)) {
                flash('success', lang('request_success'));
            } else {
                flash('danger', lang('request_error'));
            }
        } else {
            validation_errors();
            flash('danger');
        }
        redirectPrev();
    }
}