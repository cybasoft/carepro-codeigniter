<?php

defined('BASEPATH') or exit('No direct script access allowed');
$config['company'] = array(
    'name' => 'DaycarePRO',
    'slogan' => 'Nice daycare',
    'phone' => '123-345-4444',
    'fax' => '211-222-3334',
    'email' => 'alerts@amdtllc.com',
    'street' => '123 State St',
    'city' => 'New York',
    'state' => 'NY',
    'postal_code' => '13001',
    'country' => 'USA',
    'timezone' => 'America/New_York', //http://php.net/manual/en/timezones.america.php
    'google_analytics' => 'UA-101249029-4',
    'currency_symbol' => '$',
    'currency_abbr' => 'USD',
    'date_format' => 'd M, Y H:ia',
    'logo' => 'logo.png', //logo must be in '/assets/img' directory
    'invoice_logo' => 'logo.png' //logo must be in '/assets/img' directory
);

$config['allow_registration'] = TRUE;
$config['allow_reset_password'] = TRUE;
$config['enable_captcha'] = FALSE;
$config['demo_mode'] = TRUE;
$config['maintenance_mode'] = FALSE;

$config['email_config'] = array(
    'protocol' => 'smtp', //sendmain, smtp, mail
    'smtp_host' => 'smtp.mailtrap.io',
    'smtp_user' => '2a9c56bbcb93ea',
    'smtp_pass' => '511f62a371a1ba',
    'smtp_port' => '2525',
    'mailtype' => 'html',
    //do not change
    'crlf' => "\r\n",
    'newline' => "\r\n"
);

$config['base_url'] = 'https://amdtllc.com/demo/daycarepro';

$config['index_page'] = 'index.php';

$config['uri_protocol'] = 'REQUEST_URI';
$config['url_suffix'] = '';
$config['language'] = 'english';
$config['charset'] = 'UTF-8';
$config['enable_hooks'] = FALSE;
$config['subclass_prefix'] = 'MY_';

$config['composer_autoload'] = FALSE;
$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';
$config['enable_query_strings'] = FALSE;
$config['controller_trigger'] = 'c';
$config['function_trigger'] = 'm';
$config['directory_trigger'] = 'd';
$config['allow_get_array'] = TRUE;

$config['log_threshold'] = 0;
$config['log_path'] = '';
$config['log_file_extension'] = '';
$config['log_file_permissions'] = 0644;
$config['log_date_format'] = 'Y-m-d H:i:s';
$config['error_views_path'] = '';
$config['cache_path'] = '';
$config['cache_query_string'] = FALSE;
$config['encryption_key'] = '264a4a0605e26495be5513eaf2a1d528';

$config['sess_driver'] = 'files';
$config['sess_cookie_name'] = 'ci_session';
$config['sess_expiration'] = 7200;
$config['sess_save_path'] = sys_get_temp_dir();
$config['sess_match_ip'] = FALSE;
$config['sess_time_to_update'] = 300;
$config['sess_regenerate_destroy'] = FALSE;

$config['cookie_prefix'] = '';
$config['cookie_domain'] = '';
$config['cookie_path'] = '/';
$config['cookie_secure'] = FALSE;
$config['cookie_httponly'] = FALSE;

$config['standardize_newlines'] = FALSE;
$config['global_xss_filtering'] = FALSE;

$config['csrf_protection'] = FALSE;
$config['csrf_token_name'] = 'csrf_test_name_1djjd';
$config['csrf_cookie_name'] = 'csrf_test_name_1djjd';
$config['csrf_expire'] = 7200;
$config['csrf_regenerate'] = TRUE;
$config['csrf_exclude_uris'] = array();

$config['compress_output'] = FALSE;
$config['time_reference'] = 'local';
$config['rewrite_short_tags'] = FALSE;
$config['proxy_ips'] = '';
$config['copyright'] = '<a href="http://amdtllc.com" target="_blank">A&M Digital Technologies</a>';