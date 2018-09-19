<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Class: my_cron
 * User: John Muchiri
 * Email: jgmuchiri@gmail.com
 * Date: 12/21/2014
 *
 * https://amdtllc.com
 * Copyright 2014 All Rights Reserved
 */
class my_cron extends CI_Model
{

    /*Notify admin of event*/
    public function notify($event)
    {
        $this->load->library('email');

        $user = $this->user->get(null, 'last_name');

        $msg[] = 'User: ' . $user;
        $msg[] = '<br>Company' . session('company_name');
        $msg[] = '<br>' . lang('date') . ': ' . date('d M, Y', time());
        $msg[] = ' / ' . lang('time') . ': ' . date('H:i', time());
        $msg[] = '<hr/>' . $event;

        $email = [
            'from' => session('company_email'),
            'from_name' => session('company_name'),
            'subject' => 'Event alert!',
            'message' => implode($msg),
        ];

        if ($this->mailer->send($email)) {
            return true;
        }

        return false;
    }

    /*
     * notify admin of user registration
     *
     * @param none
     * @return void
     *
     *
     */
    public function notifyNewRegistration($company, $email)
    {
        $msg[] = "New user has registered <hr/>";
        $msg[] = $company . '<br/> ' . $email;

        $msg[] = '<br>' . lang('date') . ': ' . date('d M, Y', time());
        $msg[] = ' / ' . lang('time') . ': ' . date('H:i', time());

        $mail = [
            'to' => session('company_email'),
            'from' => session('company_email'),
            'from_name' => session('company_name'),
            'subject' => 'New user registration!',
            'message' => implode($msg),
        ];

        if ($this->mailer->send($mail)) {
            return true;
        }

        return false;
    }

//todo move to mailer
    public function sendMail()
    {
        $this->load->library('email');

        $child_id = $this->child->cid();

        $parents = $this->child->getParents($child_id);

        foreach ($parents as $row) {
            $this->email->to($row->email); //email parent
            //$this->email->cc('example@example.com');
            $this->email->bcc(session('company_email')); //email admin to log

            //echo $this->email->print_debugger();
        }
    }
}
