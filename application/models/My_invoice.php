<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @file      : my_invoice
 * @author    : JMuchiri

 * @Copyright 2017 A&M Digital Technologies

* https://amdtllc.com
 */
class My_invoice extends CI_Model
{

    public $invoice_db = 'accnt_invoices';

    function __construct()
    {
        parent::__construct();

        //dbs
        $this->invoice_db = 'accnt_invoices';
        $this->invoice_items_db = 'accnt_invoice_items';
        $this->payments_db = 'accnt_payments';
        $this->bank_db = 'accnt_pay_bank';
        $this->bank_card_db = 'accnt_pay_cards';
        $this->pay_method_db = 'accnt_pay_methods';

    }

    /**
     * @param $id
     */
    function invoice($id)
    {
        $this->db->where('accnt_invoices.id', $id);
        $this->db->from('accnt_invoices');
    }

    /**
     * @param $cid
     * @return mixed
     */
    function payments($cid)
    {
        $this->db->where('child_id', $cid);
        $this->db->select('*');
        $this->db->from('accnt_invoices');
        $this->db->join('accnt_invoice_payments', 'accnt_invoice_payments.invoice_id = accnt_invoices.id');
        return $this->db->get();
    }

    /**
     * @param $id
     * @param $item
     * @return bool
     */
    function invoice_items($id, $item)
    {
        $this->db->where('accnt_invoices.id', $id);
        $this->db->select('*');
        $this->db->from('accnt_invoices');
        $this->db->limit(1);
        $this->db->join('accnt_invoice_items', 'accnt_invoices_items.invoice_id = accnt_invoices.id');
        $this->db->join('accnt_invoice_payment', 'accnt_invoice_payment.invoice_id = accnt_invoices.id');

        $query = $this->db->get()->result();
        foreach ($query as $row) {
            return $row->$item;
        }
        return false;
    }

    /**
     * @return array
     */
    function getInvoices()
    {
        $data = array();
        $query = $this->db->get($this->invoice_db);
        foreach ($query->result() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    function getInvoiceItems($invoice_id)
    {
        $data = array();
        $this->db->where('invoice_id', $invoice_id);
        $query = $this->db->get($this->invoice_items_db);
        foreach ($query->result() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * @param $status
     * @return string
     */
    function invoice_status($status)
    {
        switch ($status) {
            case 1:
                $data = '<span class="label label-success">' . lang('paid') . '</span>';
                break;
            case 2:
                $data = '<span class="label label-danger">' . lang('due') . '</span>';
                break;
            case 3:
                $data = '<span class="label label-warning">' . lang('cancelled') . '</span>';
                break;
            default:
                $data = '2';
                break;
        }
        return $data;
    }

    /**
     * @return bool
     */
    function save_invoice()
    {
        $data = array(
            'child_id' => $child->id,
            'invoice_date' => $this->input->post('invoice_date'),
            'invoice_due_date' => $this->input->post('invoice_due_date'),
            'invoice_terms' => $this->input->post('invoice_terms'),
            'invoice_status' => 2 //default = unpaid (2)
        );

        $query = $this->db->insert('accnt_invoices', $data);
        $invoice_id = $this->db->insert_id();
        $query2 = $this->save_invoice_items($invoice_id);
        if ($query && $query2)
            return true;
        return false;
    }

    /**
     * @param $invoice_id
     * @return bool
     */
    function save_invoice_items($invoice_id)
    {
        $fields = array(
            'item_name',
            'item_description',
            'item_quantity',
            'item_price',
            'item_discount'
        );

        foreach ($fields as $field) {
            foreach ($this->input->post($field) as $key => $value) {
                $data[$key][$field] = $value;
            }
        }

        foreach ($data as $values) {
            $values['invoice_id'] = $invoice_id;
            $values['staff_id'] = $this->users->uid();
            if ($this->db->insert('accnt_invoice_items', $values)) {
                $this->conf->msg('success', lang('request_success'));
                return true;
            } else {
                $this->conf->msg('danger', lang('request_error'));
                return false;
            }
        }
        return false;
    }

    /**
     * @param $invoice_id
     * @return bool
     */
    function make_payment($invoice_id)
    {
        $data = array(
            'invoice_id' => $invoice_id,
            'amount_paid' => $this->input->post('amount_paid'),
            'date_paid' => $this->input->post('date_paid'),
            'method' => $this->input->post('payment_method'),
            'remarks' => $this->input->post('remarks')
        );
        if ($this->db->insert('accnt_invoice_payments', $data)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param int $method
     * @return array|bool
     */
    function pay_method($method = 0)
    {
        if ($method == 0 || $method == "") {
            $data = array();
            foreach ($this->db->get('accnt_pay_methods')->result() as $row) {
                $data[] = $row;
            }
            return $data;
        } else {
            $this->db->where('id', $method);
            foreach ($this->db->get('accnt_pay_methods')->result() as $row) {
                return $row->name;
            }
        }
        return false;

    }

    /**
     * @param $invoice_id
     * @param $item
     * @return string
     */
    function paypal($invoice_id, $item)
    {
        //todo remove this and references moved to daycare library
        $url = 'https://www.paypal.com/cgi-bin/webscr?cmd=_xclick';
        $business = $this->config->item('email', 'company');
        $lc = "US";
        $item_name = $item;
        $item_number = 'DayCare_' . $invoice_id;
        $amount = $this->invoice_total_due($invoice_id);
        $currency_code = "USD";
        $button_subtype = "services";
        $no_note = 0;
        $cn = "Add special remarks";
        $no_shipping = 2;
        $undefined_quantity = 1;
        $tax_rate = 0;
        $link = $url . '&business=' . $business . '&lc=' . $lc . '&item_name=' .
            $item_name . '&item_number=' .
            $item_number . '&amount=' . $amount . '&currency_code=' . $currency_code . '&button_subtype=' .
            $button_subtype . '&no_note=' . $no_note . '&cn=' . $cn . '&no_shipping=' . $no_shipping . '&undefined_quantity=' .
            $undefined_quantity . '&tax_rate=' . $tax_rate;
        return $link;

    }

    /**
     * @param $invoice_id
     * @return string
     */
    function invoice_total_due($invoice_id)
    {
        $due = $this->invoice_subtotal($invoice_id) - $this->amount_paid($invoice_id);
        if ($due < 0) {
            $this->update_status($invoice_id, 1);//mark as paid
        }
        return number_format($due, 2);
    }

    /**
     * @param $invoice_id
     * @return string
     */
    function invoice_subtotal($invoice_id)
    {

        $this->db->where('invoice_id', $invoice_id);
        $query = $this->db->get('accnt_invoice_items');
        $totalPrice = 0;
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $totalPrice = ( ($row->item_price * $row->item_quantity) - $row->item_discount) + $totalPrice;
            }
            return number_format($totalPrice, 2);
        } else {
            return "0.00";
        }

    }


    /**
     * @param $invoice_id
     * @return string
     */
    function amount_paid($invoice_id)
    {
        $this->db->where('invoice_id', $invoice_id);
        $this->db->select_sum('amount_paid');
        $query = $this->db->get('accnt_invoice_payments');
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return number_format($row->amount_paid, 2);
        } else {
            return "0.00";
        }
    }

    /**
     * @param $invoice_id
     * @param $status
     * @return bool
     */
    function update_status($invoice_id, $status)
    {
        $data = array(
            'invoice_status' => $status
        );
        $this->db->where('id', $invoice_id);
        if ($this->db->update('accnt_invoices', $data)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return string
     */
    function getTotalDue()
    {
        $invoices = $this->db->where('invoice_status', 2)->get('accnt_invoices');
        $total = 0;
        if ($invoices->num_rows() > 0) {
            foreach ($invoices->result() as $inv) {
                $due = $this->invoice_total_due($inv->id);
                $total = (float)$total + (float)$due;
            }
        }
        return number_format($total, 2);

    }

    //pay with paypal

    function stamp($invoice_id)
    {
        $invoice = $this->getInvoice($invoice_id);
        foreach ($invoice as $row) {
            $status = $row->invoice_status;
            if ($status == 0) {
                $stamp = 'default';
            } else if ($status == 1) {
                $stamp = 'paid';
            } else if ($status == 2) {
                $stamp = 'due';
            } else if ($status == 3) {
                $stamp = 'cancelled';
            } else {
                $stamp = "";
            }
        }
        return '<img src="' . base_url() . 'assets/img/content/' . $stamp . '_stamp.png" class="stamp"/>';
    }

    function getInvoice($invoice_id)
    {
        $data = array();
        $this->db->where('id', $invoice_id);
        $query = $this->db->get('accnt_invoices');
        foreach ($query->result() as $row) {
            $data[] = $row;
        }
        return $data;
    }

}