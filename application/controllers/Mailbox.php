<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @file      : mailbox.php
 * @author    : John
 * @date      : 8/9/14
 * @Copyright 2014 icoolpix.com
 */
class Mailbox extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->conf->authenticate();
        $this->load->model('My_mailbox', 'mail');
        $this->module = 'modules/messages/';
    }

    /*
     * default page
     */
    function index()
    {
        $data['messages'] = $this->mail->messages();
        $this->conf->page($this->module . 'index', $data);
    }

    function read($msg = null)
    {
        if ($msg == null) $this->conf->redirectPrev();

        $data['msg'] = $this->mail->message($msg);
        $this->conf->page($this->module . 'read_message', $data);
    }
	/*
     * compose message
     */
    function compose()
    {
        $this->load->view($this->module . 'compose');
    }
	/*
     * send message
     */
    function send()
    {
        $this->form_validation->set_rules('receiver', 'Recipient', 'required|trim|xss_clean');
        $this->form_validation->set_rules('subject', 'Subject', 'required|trim|xss_clean');
        $this->form_validation->set_rules('message', 'Message', 'required|trim|xss_clean');

        if ($this->form_validation->run()) {
            if ($this->mail->send()) {
                $this->conf->msg('success', lang('message_sent'));
            } else {
                $this->conf->msg('danger', lang('request_error'));
            }
            redirect('mailbox', 'refresh');
        } else {
            validation_errors();
            $this->conf->msg('danger');
            redirect('mailbox/compose', 'refresh');
        }
    }

    function move_to()
    {
        $msg_id = $this->input->post('msg_id');
        $location = $this->input->post('location');
        if ($location == 'purge') {
            $this->mail->delete($msg_id);
        } else {
            $this->mail->move_to($msg_id, $location);
        }
    }

    function read_sent($msg_id)
    {
        //load message
        $data['source'] = 'sent';
        $this->db->where('msg_id', $msg_id);
        $data['msg'] = $this->db->get('inbox_sent')->result();
        $this->load->view($this->module . 'read_message', $data);
    }

    function sent_purge()
    {
        $msg_id = $this->input->post('msg_id');
        $this->db->where('msg_id', $msg_id);
        $this->db->delete('inbox_sent');
    }

    /*
     * send reply
     */
    function sendReply($msg_id)
    {
        if ($msg_id == "" || !isset($_POST)) redirect('mailbox');

        $this->form_validation->set_rules('message', 'Message', 'required');

        if ($this->form_validation->run()) {
            $this->mail->reply($msg_id);
        } else {

            $this->conf->msg('danger', '' . validation_errors() . '');
        }

        redirect('mailbox/read/' . $msg_id, 'refresh');
    }


    /*
     * delete message
     */
    function delete($msg_id = "")
    {
        if ($msg_id !== "") {

            $this->mail->purge($msg_id);
        } else {

            $this->conf->msg('danger', 'No message was selected for deletion');
        }
        redirect('mailbox');
    }

    /*
     * trash
     */
    function trash($msg_id = "")
    {
        //message list displayed on sidebar
        if ($msg_id !== "") {
            //list one message by msg_id
            $this->db->where('receiver', $this->users->uid());
            $this->db->where('msg_id', $msg_id);
            $this->db->limit(1);
            $this->data['messages'] = $this->db->get('inbox');
        }

        $this->conf->page($this->module . 'trash', $this->data);
    }
}