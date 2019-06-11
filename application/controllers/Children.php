<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

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
        // $this->load->model('My_invoice', 'invoice');
        $this->load->model('My_children', 'children');
        $this->module = 'children/';
        $this->title = lang('children');
        auth(true);
    }

    /*
     * default page
     * @return void
     */
    public function index()
    {        
        $daycare_id = $this->session->userdata('daycare_id');
        if (is('parent')) {
            $children = $this->parent->getChildren();
            dashboard_page('parent/parent_dashboard', compact('children'),$daycare_id);
        } else {
            $checkedInChildren = $this->children->checkedInChildren($daycare_id);
            $checkedOutChildren = $this->children->checkedOutChildren($daycare_id);
            $inactiveChildren = $this->children->inactiveChildren($daycare_id);

            $totalChildren = count((array) $checkedInChildren) + count((array) $checkedOutChildren);
            dashboard_page($this->module . 'children', compact('checkedInChildren', 'checkedOutChildren', 'totalChildren', 'inactiveChildren'), $daycare_id);
        }
    }
}
