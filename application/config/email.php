<?php defined('BASEPATH') or exit('No direct script access allowed');
$config = array(
    'protocol'    => 'smtp',
    'smtp_host'    => 'smtp.gmail.com',
    'smtp_crypto' => 'ssl',
    'smtp_port'   => 465,
    'smtp_user'    => '',
    'smtp_pass'    => '',
    'charset'   => 'utf-8',
    'newline'   => "\r\n",
    'mailtype' => 'text', // or html
    'validation' => TRUE, // bool whether to validate email or not  
);
