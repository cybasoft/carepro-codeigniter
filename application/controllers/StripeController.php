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
    public function stripePost($activation_code = NULL)
    {
        $query = $this->db->get_where('users',array(
            'activation_code' => $activation_code
        ));
        $user_data = $query->result_array()[0];
        $user_name = $user_data['name'];
        $to = $user_data['email'];

        $selected_plan = $user_data['selected_plan'];
        $get_plan_details = $this->db->get_where('subscription_plans',array(
            'id' => $selected_plan
        ));
        $plans = $get_plan_details->result_array()[0];
        $price = $plans['price'];
        $plan = $plans['plan'];
      
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
            'price' => $price,
            'plan' => $plan,
            'activation_code' => $activation_code,
            'registered_success' => '',
            'payment_success' => ''
        );
        $this->email->set_mailtype('html');
        $from = $this->config->item('smtp_user');
        $this->email->from($from, 'Daycare');
        $this->email->to($to);
        $this->email->subject('Daycare payment');

        $body= $this->load->view('owner_email/payment_success_email', $data, true);
        $this->email->message($body);        //Send mail
        if($this->email->send()){
            $this->change_owner_status($to,$activation_code);
        }   
        else{
            $logs = "[".date('m/d/Y h:i:s A', time())."]"."\n\r";           
            $logs .= $this->email->print_debugger('message');
            $logs .= "\n\r";
            file_put_contents('./application/logs/log_' . date("j.n.Y") . '.log', $logs, FILE_APPEND);
            $this->session->set_flashdata("subscription_error","Enable to sent verification email. Please try again.");
        }
    }

    public function change_owner_status($to,$activation_code){
        $get_status = $this->db->get('user_status');
        $result = $get_status->result_array();
        $owner_status = $result[2]['id'];
        $data = array(
            'owner_status' => $owner_status,
        );
        $this->db->where('email', $to);
        $this->db->update('users', $data);

        $query = $this->db->get_where('users', array(
            'email' => $to
        ));
        $check_status = $query->row_array();
        $user_status = $check_status['owner_status'];       
        if ($user_status === "3"){
            $this->session->set_flashdata("message","Payment completed successfully. Thank you for subscription.");           
            redirect('daycare/'.$activation_code);
        }
    }
}
