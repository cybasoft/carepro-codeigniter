<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @file      : children.php
 * @author    : JMuchiri
 *
 * @Copyright 2017 A&M Digital Technologies
 */
class Children extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->conf->setRedirect();
        $this->conf->allow('admin,manager,staff');
        $this->load->model('My_invoice', 'invoice');
        $this->module = 'modules/children/';
    }

    /*
     * default page
     * @return void
     */
    function index()
    {
        $this->conf->page($this->module . 'index');
    }
    /*
     * child registration form
     * @return void
     */

    function register()
    {
        $this->conf->page($this->module . 'register');
    }

    /*
     * validate and add child record to db
     * @params 0
     * @return void
     */
    function add_child()
    {
        $this->form_validation->set_rules('fname', lang('first_name'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('lname', lang('last_name'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('ssn', lang('social_security'), 'required');
        $this->form_validation->set_rules('bday', lang('birthday'), 'required|trim|xss_clean');
        $this->form_validation->set_rules('gender', lang('gender'), 'required|trim|xss_clean');
        if ($this->form_validation->run() == TRUE) {
            $this->child->add_child();
        } else {
            validation_errors();
            $this->conf->msg('danger');
        }
        redirect('children', 'refresh');
    }

    function roster()
    {
        $children = $this->db->get('children')->result();
        $this->load->view($this->module.'children/roster', compact('children'));
    }
}