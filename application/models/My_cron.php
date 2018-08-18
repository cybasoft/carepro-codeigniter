<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

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
    function notify($event)
    {
        $this->load->library('email');

        $user = $this->user->get(null,'last_name');

        $this->email->from(get_option('email'), get_option('company_name'));
        $this->email->subject('Event alert!');

        $msg[] = 'User: ' . $user;
        $msg[] = '<br>Company' . get_option('company_name');
        $msg[] = '<br>' . lang('date') . ': ' . date('d M, Y', time());
        $msg[] = ' / ' . lang('time') . ': ' . date('H:i', time());
        $msg[] = '<hr/>' . $event;

        $this->email->message(implode($msg));

        if ($this->email->send())
            return true;
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
    function notifyNewRegistration($company, $email)
    {
        $this->email->from(get_option('email'));
        $this->email->to(get_option('email'));
        $this->email->subject('Registration! New user');

        $msg[] = "New user has registered <hr/>";
        $msg[] = $company . '<br/> ' . $email;

        $msg[] = '<br>' . lang('date') . ': ' . date('d M, Y', time());
        $msg[] = ' / ' . lang('time') . ': ' . date('H:i', time());

        $this->email->message(implode($msg));

        if ($this->email->send())
            return true;
        return false;
    }

//todo move to mailer
    function sendMail()
    {
        $this->load->library('email');

        $child_id = $this->child->cid();

        $parents = $this->child->getParents($child_id);

        foreach ($parents as $row) {
            $this->email->to($row->email); //email parent
            //$this->email->cc('example@example.com');
            $this->email->bcc(get_option('email')); //email admin to log


            //echo $this->email->print_debugger();
        }
    }
}