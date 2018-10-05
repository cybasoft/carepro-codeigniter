<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class My_mailer extends CI_Model
{
    public function email_config()
    {
        //get options
        $opts = $this->db
            ->where('option_name', 'use_smtp')
            ->or_where('option_name', 'smtp_host')
            ->or_where('option_name', 'smtp_user')
            ->or_where('option_name', 'smtp_pass')
            ->or_where('option_name', 'smtp_port')
            ->get('options')->result();

        if(ENVIRONMENT=='development'){
            return config_item('mailtrap');
        }

        if (count((array) $opts) == 0) {
            $config['protocol'] = 'mail';
            return $config;
        }

        $use_smtp = 0;
        $smtp_host = '';
        $smtp_user = '';
        $smtp_pass = '';
        $smtp_port = '';
        foreach ($opts as $key => $val) {
            if ($val->option_name == 'use_smtp') {
                $use_smtp = $val->option_value;
            }

            if ($val->option_name == 'smtp_host') {
                $smtp_host = $val->option_value;
            }

            if ($val->option_name == 'smtp_user') {
                $smtp_user = $val->option_value;
            }

            if ($val->option_name == 'smtp_pass') {
                $smtp_pass = $val->option_value;
            }

            if ($val->option_name == 'smtp_port') {
                $smtp_port = $val->option_value;
            }

        }

        if ($use_smtp == 1) {
            $config['protocol'] = 'smtp'; //sendmail, smtp, mail
            $config['smtp_host'] = $smtp_host;
            $config['smtp_user'] = $smtp_user;
            $config['smtp_pass'] = $smtp_pass;
            $config['smtp_port'] = $smtp_port;
        } else {
            $config['protocol'] = 'mail';
        }

        $config['mailtype'] = 'html';
        //do not change
        $config['crlf'] = "\r\n";
        $config['newline'] = "\r\n";
        return $config;
    }

    public function send($data)
    {
        $this->email->clear();

        $extras = $data;
        $email_config = $this->email_config();
        if (isset($email_config) && is_array($email_config)) {
            $this->email->initialize($email_config);
        }

        if (!isset($data['from'])) {
            $data['from'] = session('company_email');
        }

        if (!isset($data['from_name'])) {
            $data['from_name'] = session('company_name');
        }

        if (!isset($data['to'])) {
            $data['to'] = session('email');
        }

        if (!isset($data['subject'])) {
            $data['subject'] = 'Message from ' . session('company_name');
        }

        if (isset($data['bcc'])) {
            $this->email->bcc($data['bcc']);
        }

        if (isset($data['cc'])) {
            $this->email->bcc($data['cc']);
        }

        if (!isset($data['template'])) {
            $data['template'] = 'general';
        }

        if (isset($data['salute'])) {
            $data['salute'] = sprintf(lang('email_salute'), $data['salute']);
        } else {
            $data['salute'] = '';
        }
        $this->email->from($data['from'], $data['from_name']);
        $this->email->to($data['to']);
        $this->email->subject($data['subject']);

        $message = $this->load->view('email/layout', compact('data', 'extras'), true);

//        $file='';
        //        if (isset($data['file'])) {
        //            $file = dirname(__FILE__, 2) . '/temp/' . $data['file'];
        //            if (@file_exists($file))
        //                $this->email->attach($file);
        //        }

        if (isset($data['file'])) {
            $this->email->attach($data['file']);
        }

        $this->email->message($message);

        if ($this->email->send()) {
            $success = true;
        } else {
            if (ENVIRONMENT == 'development') {
                log_message('debug', $this->email->print_debugger());
            }
            $success = false;
        }

        if (isset($data['file'])) {
            @unlink($data['file']);
        }

        return $success;

    }

}
