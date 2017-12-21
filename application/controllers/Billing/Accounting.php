<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class accounting extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //redirect session
        setRedirect();
        if (is('parent') == true && is('staff') == false) {
            redirectPrev();
        }

        //local variables
        $this->module = 'admin/accounting/';
    }


}