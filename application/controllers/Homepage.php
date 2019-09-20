<?php defined('BASEPATH') or exit('No direct script access allowed');

class Homepage extends CI_Controller
{

    function index()
    {
        if($this->ion_auth->logged_in()) {
            // redirect('dashboard', 'refresh');
        }
        $plans = $this->db->get('subscription_plans')->result_array();
        $data = [
            'plans' => $plans,
        ];
        $this->load->view('front/index', $data);
    }

    function contact()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|xss_clean|min_length[2]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('message', 'Message', 'required');

        if($this->form_validation->run() == TRUE) {
            $message = 'Email: '.$this->input->post('email').'<br/>';
            $message .= 'Phone: '.$this->input->post('phone').'<br/>';
            $message .= 'Message: <br/>'.$this->input->post('message').'<br/>';
            $data = [
                'message'  => $message,
                'subject'  => 'Message from CarePro Contact',
                'template' => 'layout',
            ];
            if(send_email($data)) {
                flash('success', 'Thank you! We will get back to you soon');
            }
            else {
                flash('error', 'Unable to send email. Try again');
            }
        }
        else {
            validation_errors();
            flash('error');
        }
        redirectPrev();

    }
}