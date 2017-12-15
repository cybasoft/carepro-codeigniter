<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Filename: accounting.php
 * User: John Muchiri
 * Date: 11/14/2014
 */
class accounting extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        //redirect session
        $this->conf->setRedirect();

		if($this->conf->isParent()==true && $this->conf->isStaff()==false){
			$this->conf->redirectPrev();
		}

        //local variables
        $this->module = 'admin/accounting/';
    }


}