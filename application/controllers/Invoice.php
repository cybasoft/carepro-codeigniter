<?php

use Dompdf\Dompdf;
use Dompdf\Options;
use Dompdf\FrameReflower\Page;

if (!defined('BASEPATH')) exit('No direct script access allowed');

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
        $this->title = lang('child') . '-' . lang('invoice');
    }

    function index()
    {
        $child_id = $this->uri->segment(2);
        if (!authorizedToChild($this->user->uid(), $child_id)) {
            flash('error', lang('You do not have permission to view this child\'s profile'));
            redirectPrev();
        }

        $child = $this->child->first($child_id);
        $invoices = $this->invoice->all(null, $child_id);
        page($this->module . 'index', compact('child', 'invoices'));
    }




    function view($id)
    {
        $daycare_id = $this->session->userdata('owner_daycare_id');
        $invoice = $this->invoice->all($id);

        if (empty($invoice))
            show_404();

        $item = $this->db->get_where('invoice_items', array(
            'invoice_id' => $invoice[0]->id
        ));
        $item_data = $item->result_array();

        $child = $this->child->get($invoice[0]->child_id);

        $subTotal = $this->invoice->subTotal($invoice[0]->id);
        $amountPaid = $this->invoice->amountPaid($invoice[0]->id);
        $amountDue = $this->invoice->amountDue($invoice[0]->id);
        page($this->module . 'invoice_view', compact('invoice', 'child', 'subTotal', 'amountPaid', 'amountDue', 'daycare_id'));
    }

    function views($invoice_id)
    {
        $invoice = $this->db->query("SELECT * FROM invoices WHERE id={$invoice_id}")->row();
        $invoice_items = $this->invoice->getInvoiceItems($invoice_id);
        $child = $this->child->first($invoice->child_id);
        $subTotal = $this->invoice->subTotal($invoice_id);
        $totalPaid = $this->invoice->amountPaid($invoice->id);
        $totalDue = (float) $subTotal - (float) $totalPaid;
        $totalTax = 0;
        page(
            $this->module . 'invoice_view',
            compact(
                'invoice',
                'child',
                'invoice_items',
                'subTotal',
                'totalTax',
                'totalPaid',
                'totalDue'
            )
        );
    }

    function stripePayment($invoice_id)
    {
        $error = null;

        //check whether stripe token is not empty
        if (!empty($_POST['stripeToken'])) {

            $token = $_POST['stripeToken'];
            require_once APPPATH . "third_party/stripe/init.php";

            $user = $this->user->get(user_id());

            $email = $user->email;

            //invoice
            $invoice = $this->invoice->get($invoice_id);
            $amoutDue = $this->invoice->amountDue($invoice_id);
            $child = $this->child->first($invoice->child_id);

            if (ENVIRONMENT == 'production') {
                $stripeKey = session('stripe_sk_live');
            } else {
                $stripeKey = session('stripe_sk_test');
            }
            \Stripe\Stripe::setApiKey($stripeKey);

            //check if user is already registered
            if ($user->stripe_customer_id == "") {
                //add customer to stripe
                $customer = $this->invoice->createStripeCustomer($user->email, $this->input->post('stripeToken'));
                $stripeID = $customer->id;
                //add to database
                $this->db->where('id', $user->id)->update('users', ['stripe_customer_id' => $stripeID]);
            }

            $charge = $this->invoice->createStripeCharge($token, [
                'amount' => moneyFormat($amoutDue) * 100,
                'description' => "Invoice #$invoice_id for $child->first_name $child->last_name",
                'invoice_id' => $invoice_id
            ]);

            //retrieve charge details
            $chargeJson = $charge->jsonSerialize();
            //check whether the charge is successful
            if ($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1) {
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
                if ($txn) {
                    if ($this->db->insert_id() && $status == 'succeeded') {
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
        $daycare_id = $this->session->userdata('owner_daycare_id');
        allow(['admin', 'manager', 'staff']);
        $child = $this->child->first($id);
        $settings_data = $this->db->get_where('daycare_settings', array(
            'daycare_id' => $this->session->userdata('daycare_id')
        ));
        $settings = $settings_data->row();
        $invoice_terms = $settings->invoice_terms;
        page($this->module . 'create_invoice', compact('child', 'daycare_id', 'invoice_terms'));
    }

    function store($id)
    {
        $daycare_id = $this->session->userdata('owner_daycare_id');
        allow(['admin', 'manager', 'staff']);

        $this->form_validation->set_rules('item_name', lang('item'), 'required|xss_clean');
        $this->form_validation->set_rules('description', lang('description'), 'required|xss_clean');
        $this->form_validation->set_rules('price', lang('price'), 'required|xss_clean|callback_is_money');
        $this->form_validation->set_rules('invoice_terms', lang('Invoice terms'), 'xss_clean');

        if ($this->form_validation->run() == TRUE) {
            $invoice = $this->invoice->createInvoice($id);
            if ($invoice > 0) {
                flash('success', lang('request_success'));
            } else {
                if($invoice == "error"){
                    if(is('admin')){
                        flash('error', sprintf(lang('upgrade_plan'),'staff'));
                    }else{
                        flash('error', lang('upgrade_plan_for_parent'));
                    }
                    redirect('child/' . $id . '/billing');
                }else{
                    flash('danger', lang('request_error'));
                }
                redirectPrev();
            }
        } else {
            validation_errors();
            flash('danger');
            redirectPrev();
        }
        redirect('invoice/' . $invoice . '/view');
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
            $last_id = $this->db->insert_id();
            if ($query) {
                $child_id = $this->invoice->get($id)->child_id;
                logEvent($user_id = NULL, "Added invoice Item {$this->input->post('item_name')} for child {$this->child->child($child_id)->first_name}", $care_id = NULL);
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
        $settings = $this->db->get_where('daycare_settings', array(
            'daycare_id' => $this->session->userdata('daycare_id')
        ));
        $invoice_logo = $settings->row()->invoice_logo;
        $admin = $this->db->select('dy.*,us.email')
            ->where('dy.id', $this->session->userdata('daycare_id'))
            ->from('daycare as dy')
            ->join('users as us', 'us.daycare_id = dy.id')
            ->group_by('us.daycare_id')
            ->get()->row_array();     
        $address = $this->db->get_where('address',array(
            'id' => $admin['address_id']
        ))->row_array();
        $data = array(
            'invoice' => $this->db->query("SELECT * FROM invoices WHERE id={$invoice_id}")->row(),
            'invoice_items' => $this->invoice->getInvoiceItems($invoice_id),
            'invoice_logo' => $invoice_logo,
            'address' => $address,
            'admin' => $admin
        );
        $this->load->view($this->module . 'invoice_print', $data);
    }

    function pay()
    {
        $daycare_id = $this->session->userdata('daycare_id');
        $users_details = $this->db->get_where('users', array(
            'daycare_id' => $daycare_id
        ));
        $users = $users_details->result();

        $stripe_details = $this->db->get_where('daycare_settings', array(
            'daycare_id' => $daycare_id
        ));
        $stripe = $stripe_details->row();

        $due_amount = $this->input->post("invoice_amount");
        $invoice_id = $this->uri->segment(2);

        $invoice_details = $this->db->select('invoice.child_id,children.first_name,children.last_name,cp.*')
            ->where('invoice.id', $invoice_id)
            ->from('invoices as invoice')
            ->join('children', 'children.id = invoice.child_id')
            ->join('child_parents as cp','cp.child_id = invoice.child_id')
            ->get()->row_array();         
        $child_name = $invoice_details['first_name'] . " " . $invoice_details['last_name'];
        $amount = $due_amount * 100;
        $parent_name = $this->session->userdata('first_name');
        $description = "Invoice amount of " . $due_amount . " paid by "  . $parent_name . " for child " . $child_name;
        if ($stripe->stripe_toggle == 1) {
            $key = $stripe->stripe_sk_test;
        } else {
            $key = $stripe->stripe_sk_live;
        }
        if ($key !== '') {
            \Stripe\Stripe::setApiKey($key);
            //stripe make payment
            \Stripe\Charge::create([
                "amount" => $amount,
                "currency" => "usd",
                "source" => $this->input->post('stripeToken'),
                "description" => $description
            ]);
            $payment_data = array(
                'invoice_id' => $invoice_id,
                'amount' => $due_amount,
                'method' => 'Stripe',
                'user_id' => $this->session->userdata('user_id'),
                'remarks' => $description,
                'date_paid' => date('Y-m-d'),
                'created_at' => date_stamp()
            );
            $this->db->insert('invoice_payments', $payment_data);

            $invoice_data = array(
                'invoice_status' => 'paid'
            );
            $this->db->where('id', $invoice_id)->update('invoices', $invoice_data);

            logEvent($user_id = NULl, "Invoice of amount " . $due_amount . " paid successfully for child " . $child_name, $care_id = NULL);

            foreach ($users as $user) {
                if ($user->first_name == '') {
                    $name = $user->name;
                } else {
                    $name = $user->first_name . " " . $user->last_name;
                }
                $user_group = $this->db->get_where('users_groups', array(
                    'user_id' => $user->id
                ));
                $group_row = $user_group->row();
                $group = $group_row->group_id;
                if (($group != 3)) {                                    
                    if ($group == 4) {
                        $message = "A Invoice of amount $" . $due_amount . " is paid successfully for child " . $child_name;
                        if($user->id == $invoice_details['user_id']){       
                            $data = [
                                'subject' => 'Invoice paid',
                                'to' => $user->email,
                                'message' => $message,
                                'logo' => $this->session->userdata('company_logo'),
                                'name' => $name,
                            ];
                            send_email($data);
                        }
                    } else {                        
                        $message = "A Invoice of amount $" . $due_amount . " is paid successfully by parent " . $parent_name . " for child " . $child_name;
                        $data = [
                            'subject' => 'Invoice paid',
                            'to' => $user->email,
                            'message' => $message,
                            'logo' => $this->session->userdata('company_logo'),
                            'name' => $name,
                        ];
                        send_email($data);
                    }                    
                }
            }
            flash('success', "Invoice paid successfully.");
            redirectPrev();
        }
    }

    /**
     * @param        $id
     * @param string $action
     * @param int    $send
     */
    function pdf($id)
    {
        $daycare_id = $this->session->userdata('owner_daycare_id');

        $admin = $this->db->get_where('users', array(
            'daycare_id' => $this->session->userdata('daycare_id')
        ))->row_array();
        $address = $this->db->get_where('address', array(
            'id' => $admin['address_id']
        ))->row_array();
        //get child data
        $invoice = $this->db->query("SELECT * FROM invoices WHERE id={$id}")->row();
        $invoice_items = $this->invoice->getInvoiceItems($id);
        $child = $this->child->first($invoice->child_id);

        // $settings_details = $this->db->get_where('daycare_settings', array(
        //     'daycare_id' => $this->session->userdata('daycare_id')
        // ));
        // $settings = $settings_details->row_array();
        $settings =  $this->db
            ->select('ds.*,daycare.logo')
            ->where('ds.daycare_id', $this->session->userdata('daycare_id'))
            ->from('daycare_settings as ds')
            ->join('daycare', 'daycare.id = ds.daycare_id')
            ->get()->row_array();

        $daycare_logo = $settings['logo'];
        $image = $settings['invoice_logo'];
        //format pdf
        $this->load->library('PDF');

        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $options->set('isHtml5ParserEnabled', true);
        $options->set('defaultFont', 'Courier');

        $dompdf = new Dompdf($options);
        $dompdf->setPaper('A4', 'portrait');

        $html = $this->load->view($this->module . 'invoice_pdf', compact('invoice', 'invoice_items', 'child', 'image', 'admin', 'address'), true);

        $dompdf->loadHtml($html);
        $dompdf->render();

        if (isset($_GET['dl']))
            $dompdf->stream('invoice-' . $invoice->id . '_' . rand(111, 999) . '.pdf');

        if (isset($_GET['send'])) {
            $output = $dompdf->output();

            $fileName = 'application/temp/invoice-' . $invoice->id . '_' . rand(111, 999) . '.pdf';
            file_put_contents($fileName, $output);
            $created_date = date("d/m/Y", strtotime($invoice->created_at));
            $due_date = date("d/m/Y", strtotime($invoice->date_due));
            $send_email = $this->sendInvoice($child, $fileName, $image, $daycare_logo, $created_date, $due_date);
            if ($send_email != "") {
                flash('error', sprintf(lang('No parent assigned to child'), $child->first_name));
            } else {
                flash('success', sprintf(lang('Invoice has been send to parents of'), $child->first_name));
            }
        }

        redirectPrev();
    }

    function sendInvoice($child, $fileName, $image, $daycare_logo, $created_date, $due_date)
    {
        $this->load->config('email');
        $this->load->library('email');

        $parents = $this->child->getParents($child->id);
        $parents_data = $parents->result();

        if (empty($parents_data)) {
            $error = "no parent";
            return $error;
        } else {
            foreach ($parents_data as $parent) {
                // $data = [
                //     'to' => $parent->email,
                //     'subject' => sprintf(lang('invoice_email_subject'), $child->last_name),
                //     'message' => sprintf(lang('invoice_email_message'), $child->last_name),
                //     'file' => $fileName
                // ];

                // $this->mailer->send($data);                

                $email_data = array(
                    'parent_name' => $parent->first_name . ' ' . $parent->last_name,
                    'child_name' => $child->first_name . ' ' . $child->last_name,
                    'image' => $image,
                    'daycare_logo' => $daycare_logo,
                    'created_date' => $created_date,
                    'due_date' => $due_date
                );
                $this->email->set_mailtype('html');
                $from = $this->config->item('smtp_user');
                $to = $parent->email;
                $this->email->from($from, 'Daycare');
                $this->email->to($to);
                $this->email->subject('Child Invoice');
                $this->email->attach($fileName);
                $body = $this->load->view('custom_email/child_invoice_email', $email_data, true);
                $this->email->message($body);        //Send mail
                if ($this->email->send()) {
                    // return true;
                } else {
                    $logs = "[" . date('m/d/Y h:i:s A', time()) . "]" . "\n\r";
                    $logs .= $this->email->print_debugger('message');
                    $logs .= "\n\r";
                    file_put_contents('./application/logs/log_' . date("j.n.Y") . '.log', $logs, FILE_APPEND);
                }
            }

            @unlink($fileName);
            $error = "";
            return $error;
        }
    }

    function delete($invoice_id)
    {
        allow(['admin', 'manager']);
        $child_id = $this->invoice->get($invoice_id)->child_id;
        //delete items
        $this->db->where('invoice_id', $invoice_id);
        $this->db->delete('invoice_items');

        //delete invoice
        $this->db->where('id', $invoice_id);
        $this->db->delete($this->invoice_db);

        if ($this->db->affected_rows() > 0) {
            logEvent($user_id = NULL, "Deleted Invoice for child {$this->child->child($child_id)->first_name}", $care_id = NULL);
            flash('success', lang('request_success'));
        } else {
            flash('danger', lang('request_error'));
        }

        redirectPrev();
    }

    function deleteItem($invoice_id, $item_id)
    {
        allow(['admin', 'manager']);

        $items_details = $this->db->get_where('invoice_items', array(
            'id' => $item_id,
            'invoice_id' => $invoice_id
        ));
        $items = $items_details->row_array();
        $this->db->where('id', $item_id);
        $this->db->where('invoice_id', $invoice_id);
        $this->db->delete('invoice_items');
        if ($this->db->affected_rows() > 0) {
            $child_id = $this->invoice->get($invoice_id)->child_id;
            logEvent($user_id = NULL, "Deleted Invoice item {$items['item_name']} for invoice of child {$this->child->child($child_id)->first_name}", $care_id = NULL);
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

        if ($_POST) {
            $data = array(
                'invoice_status' => $this->input->post("invoice_status")
            );
            $query = $this->db->where('id', $id)->update($this->invoice_db, $data);
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
        allow(['admin', 'manager', 'staff']);
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
