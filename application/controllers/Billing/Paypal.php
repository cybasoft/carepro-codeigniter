<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author    : JMuchiri
 * @Copyright 2017 A&M Digital Technologies
 */
class Paypal extends CI_Controller
{
    private $paypalURL;
    private $txn_verify_url;
    private $returnURL;
    private $cancelURL;
    private $notifyURL;
    private $paypalContext;

    public function __construct()
    {
        parent::__construct();

        setRedirect();
        allow('admin,manager,staff,parents');
        //resources
        $this->load->model('My_child', 'child');
        $this->load->model('My_invoice', 'invoice');

        if(ENVIRONMENT == 'production') {
            $this->paypalURL = 'https://www.paypal.com/cgi-bin/webscr';
            $this->txn_verify_url = 'ssl://www.paypal.com';
        } else {
            $this->paypalURL = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
            $this->txn_verify_url = 'ssl://www.sandbox.paypal.com';
        }

        $this->returnURL = site_url('paypal/success');
        $this->cancelURL = site_url('paypal/cancelled');
        $this->notifyURL = site_url('paypal/notify');
        $this->paypalContext = array(
            'lc' => config_item('PAYPAL_LOCALE'),
            'currency_code' => config_item('company')['currency_abbr'],
            'no_note' => 1,
            'cmd' => '_xclick',
            'btn' => 'PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest'
        );
        $this->module='modules/child/billing/';
    }

    function pay($invoice_id)
    {
        //invoice
        $invoice = $this->invoice->first($invoice_id);
        $amoutDue = $this->invoice->invoice_total_due($invoice_id);
        $child = $this->child->first($invoice->child_id);

        $user = $this->user->get();
        $email = $user->email;
        $querystring = "?business=".urlencode(config_item('company')['email'])."&";
        $querystring .= "item_name=".urlencode($child->first_name.' '.$child->last_name)."&";
        $querystring .= "item_number=".urlencode($invoice_id)."&";
        $querystring .= "amount=".urlencode($amoutDue)."&";
        $querystring .= "payer_email=".urlencode($email)."&";
        $querystring .= "name=".urlencode($user->first_name.' '.$user->last_name)."&";
        $querystring .= "rm=".urlencode(2)."&";
        foreach ($this->paypalContext as $key => $value) {
            $value = urlencode(stripslashes($value));
            $querystring .= "$key=$value&";
        }
        $querystring .= "return=".urlencode(stripslashes($this->returnURL))."&";
        $querystring .= "cancel_return=".urlencode(stripslashes($this->cancelURL))."&";
        $querystring .= "notify_url=".urlencode($this->notifyURL);
        $querystring .= "&custom=".'invoice'.'|'.$invoice_id;

        $this->session->set_userdata('exit_page', last_page());
        redirect($this->paypalURL.$querystring);
    }

    function success()
    {
        $invoice_id = $this->input->post('item_number');
        $invoice = $this->invoice->first($invoice_id);
        $child = $this->child->first($invoice->child_id);
        if(count($invoice) == 0) {
            flash('info', lang('We received your payment. Please wait few hours for the transaction reflect in your account'));
        }
        if($this->input->post('amt'))
            $amount = $this->input->post('amt');
        else
            $amount = $this->input->post('mc_gross');
        //insert tansaction data into the database
        $txn = $this->db->insert('invoice_payments', [
            'invoice_id' => $invoice_id,
            'amount' => $amount,
            'method' => 'PayPal',
            'remarks' => lang('paid_in_full'),
            'user_id' => $this->user->uid(),
            'created_at' => date_stamp(),
            'date_paid' => date('Y-m-d')
        ]);
        if($txn) {
            if($this->db->insert_id()) {
                //$data['insertID'] = $this->db->insert_id();
                //update status
                $this->db->where('id', $invoice_id)->update('invoices', ['invoice_status' => "paid"]);
                //send receipt
                $this->mailer->send(
                    [
                        'to' => $this->input->post('payer_email'),
                        'subject' => lang('invoice_payment_received'),
                        'message' => lang('invoice_payment_received_message'),
                        'template' => 'payment_success',
                        'invoice' => array(
                            'id' => $invoice_id,
                            'amount' => $amount,
                            'method' => 'Paypal - Txn# '.$this->input->post('txn_id'),
                            'remarks' => lang('paid_in_full'),
                            'description' => "Invoice #$invoice_id for $child->first_name $child->last_name"
                        )
                    ]
                );
                flash('success', lang('Thank you for your payment! We have sent you a confirmation email'));
            } else {
                flash('error', lang('transaction_failed'));
            }
        } else {
            flash('error', lang('transaction_failed'));
        }
        redirect('child/'.$child->id.'/billing');
    }

    function cancelled()
    {
        flash('error',lang('You have cancelled your PayPal transaction. We look forward to your business again!'));
        redirect($this->session->userdata('exit_page'));
        //$this->load->view($this->module.'paypal-cancelled');
    }
}