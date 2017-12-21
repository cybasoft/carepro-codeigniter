<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @file      : children.php
 * @author    : JMuchiri
 * @Copyright 2017 A&M Digital Technologies
 */
class Children extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        setRedirect();
        allow('admin,manager,staff');
        $this->load->model('My_invoice', 'invoice');
        $this->module = 'modules/children/';
    }

    /*
     * default page
     * @return void
     */
    function index()
    {
        page($this->module . 'index');
    }
    /*
     * child registration form
     * @return void
     */

    function register()
    {
        page($this->module . 'register');
    }

    function roster()
    {
        $children = $this->db->get('children')->result();
        $this->load->view($this->module.'roster', compact('children'));
    }
}