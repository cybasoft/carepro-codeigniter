<?php
defined('BASEPATH') or exit('No direct script access allowed');

class StripeController extends CI_Controller
{

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        $this->load->helper('url');
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function index()
    {
        $this->load->view('stripe_payment/index');
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function stripePost()
    {
        require_once('application/libraries/stripe-php/init.php');
        \Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));
        \Stripe\Charge::create([
            "amount" => 100 * 100,
            "currency" => "usd",
            "source" => $this->input->post('stripeToken'),
            "description" => "Test payment from Jyoti."
        ]);
        $this->session->set_flashdata('success', 'Payment made successfully.');
        redirect('payment', 'refresh');
    }
}
