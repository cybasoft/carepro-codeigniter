<?php use Dompdf\Dompdf;
use Dompdf\Options;

if(!defined('BASEPATH')) exit('No direct script access allowed');

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
        auth(true);
        //local variables
        $this->module = 'child/billing/';
        $this->invoice_db = 'invoices';
        $this->payments_db = 'accnt_payments';
        $this->load->model('My_child', 'child');
        $this->load->model('My_invoice', 'invoice');
        $this->title = lang('child').'-'.lang('invoice');
    }

    function index()
    {
        $child_id = $this->uri->segment(2);
        if(!authorizedToChild($this->user->uid(),$child_id)) {
            flash('error', lang('You do not have permission to view this child\'s profile'));
            redirectPrev();
        }

        $child = $this->child->first($child_id);
        $invoices = $this->invoice->all(null, $child_id);
        page($this->module.'index', compact('child', 'invoices'));
    }




    function view($daycare_id,$id)
    {
        $invoice = $this->invoice->all($id);

        if(empty($invoice))
            show_404();

        $child = $this->child->get($invoice[0]->child_id);

        $subTotal = $this->invoice->subTotal($invoice[0]->id);
        $amountPaid = $this->invoice->amountPaid($invoice[0]->id);
        $amountDue = $this->invoice->amountDue($invoice[0]->id);
        page($this->module.'invoice_view', compact('invoice', 'child', 'subTotal', 'amountPaid', 'amountDue' ,'daycare_id'));
    }

    function views($invoice_id)
    {
        $invoice = $this->db->query("SELECT * FROM invoices WHERE id={$invoice_id}")->row();
        $invoice_items = $this->invoice->getInvoiceItems($invoice_id);
        $child = $this->child->first($invoice->child_id);
        $subTotal = $this->invoice->subTotal($invoice_id);
        $totalPaid = $this->invoice->amountPaid($invoice->id);
        $totalDue = (float)$subTotal - (float)$totalPaid;
        $totalTax = 0;
        page($this->module.'invoice_view',
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

            $user = $this->user->get(user_id());

            $email = $user->email;

            //invoice
            $invoice = $this->invoice->get($invoice_id);
            $amoutDue = $this->invoice->amountDue($invoice_id);
            $child = $this->child->first($invoice->child_id);

            if(ENVIRONMENT == 'production') {
                $stripeKey = session('stripe_sk_live');
            } else {
                $stripeKey = session('stripe_sk_test');
            }
            \Stripe\Stripe::setApiKey($stripeKey);

            //check if user is already registered
            if($user->stripe_customer_id == "") {
                //add customer to stripe
                $customer = $this->invoice->createStripeCustomer($user->email, $this->input->post('stripeToken'));
                $stripeID = $customer->id;
                //add to database
                $this->db->where('id', $user->id)->update('users', ['stripe_customer_id' => $stripeID]);
            }

            $charge = $this->invoice->createStripeCharge($token, [
                'amount' => moneyFormat($amoutDue)*100,
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
    function create($daycare_id,$id)
    {
        allow(['admin', 'manager', 'staff']);
        $child = $this->child->first($id);
        page($this->module.'create_invoice', compact('child','daycare_id'));
    }

    function store($daycare_id,$id)
    {
        allow(['admin', 'manager', 'staff']);

        $this->form_validation->set_rules('item_name', lang('item'), 'required|xss_clean');
        $this->form_validation->set_rules('description', lang('description'), 'required|xss_clean');
        $this->form_validation->set_rules('price', lang('price'), 'required|xss_clean|callback_is_money');
        $this->form_validation->set_rules('invoice_terms', lang('Invoice terms'), 'xss_clean');

        if($this->form_validation->run() == TRUE) {
            $invoice = $this->invoice->createInvoice($id);
            if($invoice > 0) {
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
        redirect($daycare_id.'/invoice/'.$invoice.'/view');
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

    function preview()
    {
        $invoice_id = $this->uri->segment(2);
        $data = array(
            'invoice' => $this->db->query("SELECT * FROM invoices WHERE id={$invoice_id}")->row(),
            'invoice_items' => $this->invoice->getInvoiceItems($invoice_id)
        );
        $this->load->view($this->module.'invoice_print', $data);
    }

    /**
     * @param        $id
     * @param string $action
     * @param int    $send
     */
    function pdf($id)
    {
        //get child data
        $invoice = $this->db->query("SELECT * FROM invoices WHERE id={$id}")->row();
        $invoice_items = $this->invoice->getInvoiceItems($id);
        $child = $this->child->first($invoice->child_id);

        //format pdf
        $this->load->library('PDF');

        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $options->set('isHtml5ParserEnabled', true);
        $options->set('defaultFont', 'Courier');

        $dompdf = new Dompdf($options);
        $dompdf->setPaper('A4', 'portrait');

        $html = $this->load->view($this->module.'invoice_pdf', compact('invoice', 'invoice_items', 'child', 'action', 'send'), true);

        $dompdf->loadHtml($html);
        $dompdf->render();

        if(isset($_GET['dl']))
            $dompdf->stream();

        if(isset($_GET['send'])) {
            $output = $dompdf->output();

            $fileName = 'application/temp/invoice-'.$invoice->id.'_'.rand(111, 999).'.pdf';
            file_put_contents($fileName, $output);

            $this->sendInvoice($child, $fileName);
            flash('success', sprintf(lang('Invoice has been send to parents of'), $child->first_name));
        }

        redirectPrev();
    }

    function sendInvoice($child, $fileName)
    {
        $parents = $this->child->getParents($child->id);

        foreach ($parents->result() as $parent) {

            $data = [
                'to' => $parent->email,
                'subject' => sprintf(lang('invoice_email_subject'), $child->last_name),
                'message' => sprintf(lang('invoice_email_message'), $child->last_name),
                'file' => $fileName
            ];

            // $this->mailer->send($data);
        }

        @unlink($fileName);

        return true;
    }

    function delete($invoice_id)
    {
        allow(['admin', 'manager']);
        //delete items
        $this->db->where('invoice_id', $invoice_id);
        $this->db->delete('invoice_items');

        //delete invoice
        $this->db->where('id', $invoice_id);
        $this->db->delete($this->invoice_db);

        if($this->db->affected_rows() > 0) {
            flash('success', lang('request_success'));
        } else {
            flash('danger', lang('request_error'));
        }

        redirectPrev();
    }

    function deleteItem($invoice_id, $item_id)
    {
        allow(['admin', 'manager']);

        $this->db->where('id', $item_id);
        $this->db->where('invoice_id', $invoice_id);
        $this->db->delete('invoice_items');

        if($this->db->affected_rows() > 0) {
            flash('success', lang('request_success'));
        } else {
            flash('danger', lang('request_error'));
        }

        redirectPrev();
    }

//update status
    function updateStatus($id)
    {
        allow(['admin', 'manager', 'staff']);

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
        allow(['admin', 'manager', 'staff']);
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