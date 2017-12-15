<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
 */
$route['migrate'] = 'Migrate/test';

$route['default_controller'] = "auth";
$route['404_override'] = 'landing/error404';

$route['translate_uri_dashes'] = FALSE;


//auth
$route['login'] = 'auth/login';
$route['logout'] = 'auth/logout';
$route['forgot_password'] = 'auth/forgot_password';

//accounting
$route['new_invoice'] = 'invoice/create_invoice';

//mailbox
$route['mailbox/sent'] = 'mailbox/sent';

$route['groups/(:num)'] = "users/edit_group/$1";
$route['settings'] = "admin/settings";
$route['settings/(:any)'] = "admin/settings/$1";
$route['users'] = "admin/users";

$route['users/(:any)'] = "admin/users/$1";
$route['user/(:any)'] = "admin/users/$1";

$route['calendar'] = "events/calendar";
$route['calendar/(:any)'] = "events/calendar/$1";
$route['tasks'] = "events/tasks";
$route['tasks/(:any)'] = "events/tasks/$1";

$route['reports'] = "admin/reports";
$route['reports/(:any)'] = "admin/reports/$1";

$route['children'] = "children/children";
$route['children/([a-z]+)'] = "children/children/$1";
$route['children/([a-z]+)/(.*)'] = "children/children/$1";
$route['children/([a-z]+)'] = "children/children/$1";
$route['children/(:any)'] = "children/children/$1";

$route['child/(:num)'] = 'children/children/child/$1';
$route['child/(:any)'] = 'children/children/$1';
$route['health/(:any)'] = 'children/health/$1';
$route['notes/(:any)'] = 'children/notes/$1';
$route['pickup/(:any)'] = 'children/pickup/$1';
$route['invoice/(:any)'] = 'accounting/invoice/$1';
$route['invoice'] = 'accounting/invoice';
$route['emergency/(:any)'] = 'children/emergency/$1';
$route['parents/(:any)'] = 'children/parents/$1';
$route['charges/(:any)'] = 'accounting/charges/$1';

$route['accounting/(:any)'] = 'accounting/accounting/$1';
$route['news'] = 'news/news';
$route['news/(:any)'] = 'news/news/$1';

$route['family'] = 'family/family';
$route['family/(:any)'] = "family/family/$1";

$route['lockscreen'] = 'dashboard/lockscreen';