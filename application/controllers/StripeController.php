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
        $this->load->model('My_user_registration');
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
        $user_name = $this->session->userdata('user_name');
        $to = $this->session->userdata('email');
        $price = $this->session->userdata('price');
      
        require_once('application/libraries/stripe-php/init.php');
        \Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));
        \Stripe\Charge::create([
            "amount" => $price * 100,
            "currency" => "usd",
            "source" => $this->input->post('stripeToken'),
            "description" => "Test payment from Jyoti."
        ]);

        $this->load->config('email');
        $this->load->library('email');
        
        $data = array(
            'user_name' => $user_name,
            'price' => $this->session->userdata('price')
        );
        $this->email->set_mailtype('html');
        $from = $this->config->item('smtp_user');
        $this->email->from($from, 'Daycare');
        $this->email->to($to);
        $this->email->subject('Carepro payment');

        $body= $this->load->view('owner_email/thanku_email', $data, true);
        $this->email->message($body);        //Send mail
        if($this->email->send()){
            $this->change_owner_status($to);
        }   
        else{
            $this->session->set_flashdata("subscription_error","Enable to sent verification email. Please try again.");
        }
    }

    public function change_owner_status($to){
        $owner_status = $this->My_user_registration->status[2];
        $data = array(
            'owner_status' => $owner_status,
        );
        $this->db->where('email', $to);
        $this->db->update('users', $data);

        $query = $this->db->get_where('users', array(
            'email' => $to
        ));
        $check_status = $query->row_array();
        $subscribed = $check_status['owner_status'];
        if ($subscribed === "subscribed"){
            $this->session->set_flashdata("message","Payment completed successfully. Thank you for subscription.");
            redirect('daycare');
        }
    }
}
