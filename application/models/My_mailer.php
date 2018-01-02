<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class My_mailer extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function send($data)
    {
        $this->email->clear();

        $email_config = config_item('email_config');
        if (isset($email_config) && is_array($email_config)) {
            $this->email->initialize($email_config);
        }

        if (!isset($data['from']))
            $data['from'] = $this->config->item('email', 'company');
        if (!isset($data['from_name']))
            $data['from_name'] = $this->config->item('name', 'company');
        if (!isset($data['to']))
            $data['to'] = $this->config->item('email', 'company');
        if (!isset($data['subject']))
            $data['subject'] = 'Message from ' . $this->config->item('name', 'company');
        if(isset($data['bcc']))
            $this->email->bcc($data['bcc']);
        if(isset($data['cc']))
            $this->email->bcc($data['cc']);
        if(!isset($data['template'])) {
            $data['template'] = 'general';
        }

        $this->email->from($data['from'], $data['from_name']);
        $this->email->to($data['to']);
        $this->email->subject($data['subject']);

        $message = $this->load->view('email/'.$data['template'], compact('data'), TRUE);

        $this->email->message($message);
        $mail = $this->email->send();
        if ($mail) {
            if (ENVIRONMENT !== 'production') {
                echo $this->email->print_debugger();
            }
            return TRUE;
        } else {
            return FALSE;
        }
    }

}