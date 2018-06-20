<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @file      : my_invoice
 * @author    : JMuchiri
 * @Copyright 2017 A&M Digital Technologies
 * https://amdtllc.com
 */
class My_invoice extends CI_Model
{

    public $invoice_db = 'invoices';

    function __construct()
    {
        parent::__construct();

        //dbs
        $this->invoice_db = 'invoices';
        $this->invoice_items_db = 'invoice_items';
        $this->payments_db = 'accnt_payments';
        $this->bank_db = 'accnt_pay_bank';
        $this->bank_card_db = 'accnt_pay_cards';
        $this->pay_method_db = 'accnt_pay_methods';

    }

    function first($id)
    {
        return $this->db->where('id', $id)->get('invoices')->row();
    }

    /**
     * @param $id
     */
    function invoice($id)
    {
        $this->db->where('invoices.id', $id);
        $this->db->from('invoices');
    }

    /**
     * @param $cid
     * @return mixed
     */
    function payments($cid = null, $invoice = null)
    {
        if($cid !== null)
            $this->db->where('invoices.child_id', $cid);
        if($invoice !== null)
            $this->db->where('invoice_id', $invoice);
        $this->db->select('invoice_payments.*,invoices.child_id,invoices.date_due,invoices.invoice_status');
        $this->db->from('invoice_payments');
        $this->db->join('invoices', 'invoices.id=invoice_payments.invoice_id');
        return $this->db->get();
    }

    /**
     * @param $id
     * @param $item
     * @return bool
     */
    function invoice_items($id, $item)
    {
        $this->db->where('invoices.id', $id);
        $this->db->select('*');
        $this->db->from('invoices');
        $this->db->limit(1);
        $this->db->join('invoice_items', 'invoices_items.invoice_id = invoices.id');
        $this->db->join('accnt_invoice_payment', 'accnt_invoice_payment.invoice_id = invoices.id');

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
    function status($status)
    {
        switch ($status) {
            case "paid":
                $color = "success";
                break;
            case "due":
                $color = "warning";
                break;
            case "draft":
                $color = "default";
                break;
            case "cancelled":
                $color = "info";
                break;
            default:
                $color = 'info';
                break;
        }
        return '<span class="label label-'.$color.'">'.lang($status).'</span>';
    }

    /**
     * @return bool
     */
    function createInvoice($id)
    {
        $data = array(
            'child_id' => $id,
            'date_due' => $this->input->post('date_due'),
            'invoice_terms' => $this->input->post('invoice_terms'),
            'invoice_status' => "due",//default = due
            'user_id' => $this->user->uid(),
            'created_at' => date_stamp()
        );
        if(!$this->db->insert('invoices', $data))
            return false;
        $invoice_id = $this->db->insert_id();
        $data2 = array(
            'invoice_id' => $invoice_id,
            'item_name' => $this->input->post('item_name'),
            'description' => $this->input->post('description'),
            'price' => $this->input->post('price'),
            'qty' => $this->input->post('qty')
        );
        if($this->db->insert('invoice_items', $data2)) {
            $this->parent->notifyParents($id, lang('new_invoice_subject'), sprintf(lang('new_invoice_message'), $this->child->first($id)->first_name));
            return true;
        }
        return false;
    }

    /**
     * @param $invoice_id
     * @return bool
     */
    function makePayment($invoice_id)
    {
        $data = array(
            'invoice_id' => $invoice_id,
            'amount' => $this->input->post('amount'),
            'date_paid' => $this->input->post('date_paid'),
            'method' => $this->input->post('method'),
            'remarks' => $this->input->post('remarks'),
            'user_id' => $this->user->uid(),
            'created_at' => date_stamp()
        );
        if($this->db->insert('invoice_payments', $data)) {
            $invoice = $this->first($invoice_id);
            $child = $this->child->first($invoice->child_id);
            $this->parent->notifyParents($child->id, lang('new_invoice_subject'), sprintf(lang('new_invoice_message'), $child->first_name));
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param int $method
     * @return array|bool
     */
    function paymentMethods($method = 0)
    {
        if($method == 0 || $method == "") {
            $data = array();
            foreach ($this->db->get('payment_methods')->result() as $row) {
                $data[] = $row;
            }
            return $data;
        } else {
            $this->db->where('id', $method);
            foreach ($this->db->get('payment_methods')->result() as $row) {
                return $row->title;
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
        $business = get_option('email');
        $lc = "US";
        $item_name = $item;
        $item_number = 'DayCare_'.$invoice_id;
        $amount = $this->invoice_total_due($invoice_id);
        $currency_code = "USD";
        $button_subtype = "services";
        $no_note = 0;
        $cn = "Add special remarks";
        $no_shipping = 2;
        $undefined_quantity = 1;
        $tax_rate = 0;
        $link = $url.'&business='.$business.'&lc='.$lc.'&item_name='.
            $item_name.'&item_number='.
            $item_number.'&amount='.$amount.'&currency_code='.$currency_code.'&button_subtype='.
            $button_subtype.'&no_note='.$no_note.'&cn='.$cn.'&no_shipping='.$no_shipping.'&undefined_quantity='.
            $undefined_quantity.'&tax_rate='.$tax_rate;
        return $link;

    }

    /**
     * @param $invoice_id
     * @return string
     */
    function invoice_total_due($invoice_id)
    {
        $due = $this->invoice_subtotal($invoice_id) - $this->amount_paid($invoice_id);
        if($due<0) {
            $this->update_status($invoice_id, "paid");//mark as paid
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
        $query = $this->db->get('invoice_items');
        $totalPrice = 0;
        if($query->num_rows()>0) {
            foreach ($query->result() as $row) {
                $totalPrice = ($row->price * $row->qty) + $totalPrice;
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
        $this->db->select_sum('amount');
        $query = $this->db->get('invoice_payments');
        if($query->num_rows()>0) {
            $row = $query->row();
            return number_format($row->amount, 2);
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
        if($this->db->update('invoices', $data)) {
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
        $invoices = $this->db->where('invoice_status', "due")->get('invoices');
        $total = 0;
        if($invoices->num_rows()>0) {
            foreach ($invoices->result() as $inv) {
                $due = $this->invoice_total_due($inv->id);
                $total = (float)$total + (float)$due;
            }
        }
        return number_format($total, 2);

    }

    //pay with paypal

    function stamp($status)
    {
        return '<img src="'.base_url().'assets/img/content/'.$status.'_stamp.png" class="stamp"/>';
    }

    /**
     * @param $invoice_id
     * @return array
     */
    function getInvoice($invoice_id)
    {
        $data = array();
        $this->db->where('id', $invoice_id);
        $query = $this->db->get('invoices');
        foreach ($query->result() as $row) {
            $data[] = $row;
        }
        return $data;
    }

    /**
     * @param $email
     * @param $token
     * @return bool|\Stripe\ApiResource
     */
    function createStripeCustomer($email, $token)
    {
        $error = null;
        try {
            $customer = \Stripe\Customer::create(array(
                'email' => $email,
                'source' => $token
            ));
            return $customer;
        } catch (\Stripe\Error\Card $e) {
            $error = $e->getMessage();
        } catch (\Stripe\Error\InvalidRequest $e) {
            $error = $e->getMessage();
        } catch (\Stripe\Error\Authentication $e) {
            $error = $e->getMessage();
        } catch (\Stripe\Error\ApiConnection $e) {
            $error = $e->getMessage();
        } catch (\Stripe\Error\Base $e) {
            $error = $e->getMessage();
        } catch (Exception $e) {
            $error = $e->getMessage();
        }

        if($error !== null) {
            flash('error', $error);
            redirectPrev();
        };
        return false;
    }

    /**
     * @param $token
     * @param $data
     * @return bool|\Stripe\ApiResource
     */
    function createStripeCharge($token, $data)
    {
        $error = null;

        try {
            //charge a credit or a debit card
            $charge = \Stripe\Charge::create([
                'source' => $token,
                'amount' => str_replace('.', '', $data['amount']),
                'currency' => get_option('currency_abbreviation'),
                'description' => $data['description'],
                'metadata' => array(
                    'item_id' => $data['invoice_id']
                )
            ]);
            return $charge;
        } catch (\Stripe\Error\Card $e) {
            $error = $e->getMessage();
        } catch (\Stripe\Error\InvalidRequest $e) {
            $error = $e->getMessage();
        } catch (\Stripe\Error\Authentication $e) {
            $error = $e->getMessage();
        } catch (\Stripe\Error\ApiConnection $e) {
            $error = $e->getMessage();
        } catch (\Stripe\Error\Base $e) {
            $error = $e->getMessage();
        } catch (Exception $e) {
            $error = $e->getMessage();
        }

        if($error !== null) {
            flash('error', $error);
            redirectPrev();
        };
        return false;
    }

    /**
     * @param $data
     * @return bool|\Stripe\ApiResource
     */
    function createStripeSubscription($data)
    {
        $error = null;
        try {
            $charge = \Stripe\Charge::create(array(
                'customer' => $data['stripe_id'],
                'amount' => str_replace('.', '', $data['amount']),
                'currency' => get_option('currency_abbreviation'),
                'description' => $data['description'],
                'metadata' => array(
                    'item_id' => $data['invoice_id']
                )
            ));
            return $charge;
        } catch (\Stripe\Error\Card $e) {
            $error = $e->getMessage();
        } catch (\Stripe\Error\InvalidRequest $e) {
            $error = $e->getMessage();
        } catch (\Stripe\Error\Authentication $e) {
            $error = $e->getMessage();
        } catch (\Stripe\Error\ApiConnection $e) {
            $error = $e->getMessage();
        } catch (\Stripe\Error\Base $e) {
            $error = $e->getMessage();
        } catch (Exception $e) {
            $error = $e->getMessage();
        }

        if($error !== null) {
            flash('error', $error);
            redirectPrev();
        };
        return false;
    }
}