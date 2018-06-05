<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class My_forum extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('url'));
    }

}
