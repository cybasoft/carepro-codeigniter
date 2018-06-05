<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

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
        allow('admin,manager,staff,parent');
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
        page($this->module.'index', compact('child', 'invoices'));
    }

    function invoices($id, $status)
    {
        $child = $this->child->first($id);
        if($status !== "all") {
            $this->db->where('invoice_status', $status);
        }
        if(isset($_GET['search'])) {
            $this->db->where('id', $_GET['search']);
        }
        $this->db->where('child_id', $child->id);
        $invoices = $this->invoice->getInvoices();

        $this->load->view($this->module.'invoices', compact('child', 'invoices'));
    }

    /*
     * view
     */
    function view($invoice_id)
    {
        $invoice = $this->db->query("SELECT * FROM invoices WHERE id={$invoice_id}")->row();
        $invoice_items = $this->invoice->getInvoiceItems($invoice_id);
        $child = $this->child->first($invoice->child_id);
        $subTotal = $this->invoice->invoice_subtotal($invoice_id);
        $totalPaid = $this->invoice->amount_paid($invoice->id);
        $totalDue = (float)$subTotal - (float)$totalPaid;
        $totalTax = 0;
        page($this->module.'view_invoice',
            compact(
                'invoice',
                'child',
                'invoice_items',
                'subTotal',
                'totalTax',
                'totalPaid',
                'totalDue'
            ));
    }

    function stripePayment($invoice_id)
    {
        $error = null;

        //check whether stripe token is not empty
        if(!empty($_POST['stripeToken'])) {

            $token = $_POST['stripeToken'];
            require_once APPPATH."third_party/stripe/init.php";

            $user = $this->user->get();
            $email = $user->email;

            //invoice
            $invoice = $this->invoice->first($invoice_id);
            $amoutDue = $this->invoice->invoice_total_due($invoice_id);
            $child = $this->child->first($invoice->child_id);

            if(ENVIRONMENT == 'production') {
                $stripeKey = config_item('stripe')['sk_live'];
            } else {
                $stripeKey = config_item('stripe')['sk_test'];
            }
            \Stripe\Stripe::setApiKey($stripeKey);

            //check if user is already registered
            if($user->stripe_customer_id == "") {
                //add customer to stripe
                $customer = $this->invoice->createStripeCustomer();
                $stripeID = $customer->id;
                //add to database
                $this->db->where('id', $user->id)->update('users', ['stripe_customer_id' => $stripeID]);
            }

            $charge = $this->invoice->createStripeCharge($token, [
                'amount' => $amoutDue,
                'description' => "Invoice #$invoice_id for $child->first_name $child->last_name",
                'invoice_id' => $invoice_id
            ]);

            //retrieve charge details
            $chargeJson = $charge->jsonSerialize();
            //check whether the charge is successful
            if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1) {
//                $amount = $chargeJson['amount'];
//                $balance_transaction = $chargeJson['balance_transaction'];
//                $currency = $chargeJson['currency'];
                $status = $chargeJson['status'];

                //insert tansaction data into the database
                $txn = $this->db->insert('invoice_payments', [
                    'invoice_id' => $invoice_id,
                    'amount' => $amoutDue,
                    'method' => 'Stripe',
                    'remarks' => lang('paid_in_full'),
                    'user_id' => $this->user->uid(),
                    'created_at' => date_stamp(),
                    'date_paid' => date('Y-m-d')
                ]);
                if($txn) {
                    if($this->db->insert_id() && $status == 'succeeded') {
                        //$data['insertID'] = $this->db->insert_id();
                        //update status
                        $this->db->where('id', $invoice_id)->update('invoices', ['invoice_status' => "paid"]);

                        //send receipt
                        $this->mailer->send(
                            [
                                'to' => $email,
                                'subject' => lang('invoice_payment_received'),
                                'message' => lang('invoice_payment_received_message'),
                                'template' => 'payment_success',
                                'invoice' => array(
                                    'id' => $invoice_id,
                                    'amount' => $amoutDue,
                                    'method' => 'Stripe',
                                    'remarks' => lang('paid_in_full'),
                                    'description' => "Invoice #$invoice_id for $child->first_name $child->last_name"
                                )
                            ]
                        );
                        flash('success', lang('request_success'));
                    } else {
                        flash('error', lang('transaction_failed'));
                    }
                } else {
                    flash('error', lang('transaction_failed'));
                }
            } else {
                flash('error', lang('invalid_stripe_token'));
            }
        } else {
            flash('error', lang('stripe_token_not_found'));
        }
        redirectPrev();
    }

    /*
     * create invoice
     */
    function create($id)
    {
        allow('admin,manager,staff');
        $child = $this->child->first($id);
        page($this->module.'new_invoice', compact('child'));
    }

    function store($id)
    {
        allow('admin,manager,staff');

        $this->form_validation->set_rules('item_name', lang('item'), 'required|xss_clean');
        $this->form_validation->set_rules('description', lang('description'), 'required|xss_clean');
        $this->form_validation->set_rules('price', lang('price'), 'required|xss_clean|callback_is_money');
        $this->form_validation->set_rules('invoice_terms', lang('invoice_terms'), 'xss_clean');

        if($this->form_validation->run() == TRUE) {
            if($this->invoice->createInvoice($id)) {
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
        redirect('child/'.$id.'/billing');
    }

    function is_money($money)
    {
        if(preg_match('/^\s*[$]?\s*((\d+)|(\d{1,3}(\,\d{3})+))(\.\d{2})?\s*$/', $money)) {
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

        if($this->form_validation->run() == TRUE) {
            $query = $this->db->insert('invoice_items', [
                'invoice_id' => $id,
                'item_name' => $this->input->post('item_name'),
                'description' => $this->input->post('description'),
                'qty' => $this->input->post('qty'),
                'price' => $this->input->post('price'),
            ]);
            if($query) {
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
        $this->load->view($this->module.'invoice_preview', $data);
    }


    /**
     * @param $id
     * @param string $action
     * @param int $send
     */
    function pdf($id, $action = 'I', $send = 0)
    {
        $this->load->library('PDF');
        $invoice = $this->db->query("SELECT * FROM invoices WHERE id={$id}")->row();
        $invoice_items = $this->invoice->getInvoiceItems($id);
        $child = $this->child->first($invoice->child_id);
        $this->load->view($this->module.'pdf_invoice', compact('invoice', 'invoice_items', 'child', 'action', 'send'));
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

        if($this->db->affected_rows()>0) {
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
        if($this->db->affected_rows()>0) {
            flash('success', lang('request_success'));
        } else {
            flash('danger', lang('request_error'));
        }

        redirectPrev();
    }

//update status
    function updateStatus($id)
    {
        allow('admin,manager,staff');
        if($_POST) {
            $data = array(
                'invoice_status' => $this->input->post("invoice_status")
            );
            $query = $this->db->where('id', $id)->update($this->invoice_db, $data);
            if($query) {
                flash('success', lang('request_success'));
            } else {
                flash('danger', lang('request_error'));
            }
        }
    }

    //update terms
    function updateTerms()
    {
        allow('admin,manager,staff');
        if($_POST) {
            $data = array(
                'invoice_terms' => $this->input->post("invoice_terms")
            );
            $this->db->where('id', $this->input->post('invoice_id'));
            if($this->db->update($this->invoice_db, $data)) {
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
        page($this->module.'payments', $data);
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

        if($this->form_validation->run() == TRUE) {
            if($this->invoice->makePayment($invoice_id)) {
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