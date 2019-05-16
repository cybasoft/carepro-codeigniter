<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class EmailreminderController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function send_reminder_email()
    {
        $this->load->config('email');
        $this->load->library('email');

        $query = $this->db->get('users');
        $user_details = $query->result_array();
        $current_date = date('Y-m-d');

        foreach ($user_details as $users) {
            if ($users['owner_status'] !== NULL) {
                $created_at = $users['created_at'];
                $convert_to_date = date('Y-m-d', strtotime(str_replace('-', '/', $created_at)));
                $find_third_date = array(
                    '0' => date('Y-m-d', strtotime($convert_to_date . ' +3 day')),
                    '1' => date('Y-m-d', strtotime($convert_to_date . ' +6 day')),
                    '2' => date('Y-m-d', strtotime($convert_to_date . ' +9 day')),
                    '3' => date('Y-m-d', strtotime($convert_to_date . ' +12 day'))
                );
                $find_last_date = date('Y-m-d', strtotime($convert_to_date . ' +15 day'));
                switch ($current_date) {
                    case $find_third_date[0]:
                    case $find_third_date[1]:
                    case $find_third_date[2]:
                    case $find_third_date[3]: {
                            $plan_detials = $this->db->get_where('subscription_plans', array(
                                'id' => $users['selected_plan']
                            ));
                            $plan_data = $plan_detials->row_array();
                            if ($plan_data !== NULL) {
                                $price = $plan_data['price'];
                                $plan = $plan_data['plan'];
                            } else {
                                $price = '';
                                $plan = '';
                            }
                            $email_data = array(
                                'activation_code' => $users['activation_code'],
                                'user_name' => $users['name'],
                                'price' => $price,
                                'plan' => $plan,
                                'registered_success' => 'Quick reminder user registration completed successfully. 
                                                     Now please confirm your email and go further.',
                                'payment_success' => 'Quick reminder payment completed successfully. 
                                Now please complete your daycare company registration.'                     
                            );
                            $this->email->set_mailtype('html');
                            $from = $this->config->item('smtp_user');
                            $to = $users['email'];
                            $this->email->from($from, 'Daycare');
                            $this->email->to($to);
                            if ($users['owner_status'] === 'draft') {
                                $this->email->subject('Email verification');
                                $body = $this->load->view('owner_email/confirm_email', $email_data, true);
                            } else if ($users['owner_status'] === 'confirmed') {
                                $this->email->subject('Email verification');
                                $body = $this->load->view('owner_email/confirm_email', $email_data, true);
                            } elseif ($users['owner_status'] === 'subscribed') {
                                $this->email->subject('Daycare payment');
                                $body = $this->load->view('owner_email/thanku_email', $email_data, true);
                            }
                            $this->email->message($body);
                            if ($this->email->send()){
                                echo "Success";
                            } else {
                                echo "Error";
                            }
                            break;
                        }
                    case $find_last_date: {
                            if ($users['owner_status'] === "draft" || $users['owner_status'] === "confirmed") {
                                $this->db->where('id', $users['id']);
                                $this->db->delete('users');
                                echo "success";
                            } else {
                                echo "success";
                            }
                            break;
                        }
                    default: {
                            echo  "success";
                        }
                }
            }
        }
    }
}
