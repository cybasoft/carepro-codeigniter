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

//generate migration tables (!)
$route['migrate/(:any)'] = 'migrate/$1';

$route['default_controller'] = "auth";
$route['404_override'] = 'landing/error404';
$route['translate_uri_dashes'] = FALSE;

$route['dashboard']= 'dashboard/index';
//auth
$route['login'] = 'auth/login';
$route['logout'] = 'auth/logout';
$route['register']['get'] = 'auth/register';
$route['register']['post'] = 'auth/register';

//accounting
$route['new_invoice'] = 'invoice/create_invoice';

$route['groups/:num'] = "users/edit_group/$1";
$route['settings/(:any)'] = "settings/$1";

//users
$route['users'] = "users";
$route['users/create'] = "users/store";
$route['users/:any'] = "users/$1";
$route['user/(:num)']['get'] = "users/view/$1";
$route['user/(:num)']['post'] = "users/update/$1";
$route['user/(:num)/delete'] = "users/delete/$1";
$route['user/(:num)/updateUserData'] = "users/updateUserData/$1";
$route['user/:any'] = "users/$1";

//calendar
$route['calendar'] = "calendar";
$route['calendar/addEvent'] = "calendar/addEvent";
$route['calendar/events'] = "calendar/events";
$route['calendar/updateEvent'] = "calendar/updateEvent";
$route['calendar/deleteEvent'] = "calendar/deleteEvent";
$route['calendar/:any'] = "calendar/$1";

//reports
$route['child/reports'] = "reports/index";
$route['child/(:num)/reports'] = "reports/attendance/$1";

//children
$route['children/(:any)'] = "children/$1";

//child
$route['child/register']['post'] = "child/child/store";
$route['child/(:num)']['get']='child/child/index/$1';
$route['child/:num']['post']='child/child/update';

$route['child/(:num)/uploadPhoto'] = 'child/child/uploadPhoto/$1';

$route['child/(:num)/assignParent']['get'] = 'child/child/assignParent/$1';
$route['child/(:num)/assignParent']['post']='child/child/doAssignParent/$1';
$route['child/(:num)/(:num)/removeParent'] = 'child/child/removeParent/$1/$2';

$route['child/(:num)/checkIn']['get'] = 'child/child/checkIn/$1';
$route['child/(:num)/checkIn']['post'] = 'child/child/doCheckIn/$1';
$route['child/(:num)/checkOut']['get'] = 'child/child/checkOut/$1';
$route['child/(:num)/checkOut']['post'] = 'child/child/doCheckOut/$1';

$route['child/(:num)/health'] = 'child/health/index/$1';
$route['child/addMedication'] = 'child/health/addMedication';
$route['child/addAllergy'] = 'child/health/addAllergy';
$route['child/addFoodPref']='child/health/addFoodPref';
$route['child/addContact']='child/health/addContact';
$route['child/addProvider']='child/health/addProvider';
$route['child/deleteAllergy/(:num)'] = 'child/health/deleteAllergy/$1';
$route['child/deleteMedication/(:num)'] = 'child/health/deleteMedication/$1';
$route['child/deleteFoodPref/(:num)']='child/health/deleteFoodPref/$1';
$route['child/deleteContact/(:num)']='child/health/deleteContact/$1';
$route['child/deleteProvider/(:num)']='child/health/deleteProvider/$1';

$route['child/(:num)/notes'] = 'child/notes/index/$1';
$route['child/(:num)/addNote'] = 'child/notes/addNote/$1';
$route['child/(:num)/incident']['post'] = 'child/notes/createIncident/$1';
$route['child/deleteNote/(:num)'] = 'child/notes/deleteNote/$1';
$route['child/deleteIncident/(:num)'] = 'child/notes/deleteIncident/$1';

$route['child/(:num)/pickup']['post'] = 'child/pickup/store/$1';
$route['child/deletePickup/(:num)'] = 'child/pickup/deletePickup/$1';

$route['child/(:num)/attendance'] = 'child/child/attendance/$1';

$route['invoice/:any'] = 'accounting/invoice/$1';

$route['child/(:num)/billing'] = 'child/invoice/index/$1';
$route['child/(:num)/invoices/(:any)'] = 'child/invoice/invoices/$1/$2';
$route['child/(:num)/newInvoice'] = 'child/invoice/create/$1';
$route['child/(:num)/createInvoice'] = 'child/invoice/store/$1';
$route['invoice/(:num)/delete'] = 'child/invoice/delete/$1';
$route['invoice/(:num)/view'] = 'child/invoice/view/$1';
$route['invoice/(:num)/addItem'] = 'child/invoice/addItem/$1';
$route['invoice/(:num)/deleteItem/(:num)'] = 'child/invoice/deleteItem/$1/$2';
$route['invoice/(:num)/makePayment'] = 'child/invoice/makePayment/$1';
$route['invoice/(:num)/preview'] = 'child/invoice/preview/$1';
$route['invoice/(:num)/updateStatus'] = 'child/invoice/updateStatus/$1';

//parents
$route['parents/:any'] = 'child/parents/$1';
$route['charges/:any'] = 'accounting/charges/$1';

$route['accounting/:any'] = 'accounting/accounting/$1';

//news
$route['news/(:any)'] = 'news/$1';

//family
$route['parent/(:any)'] = "parent/$1";

$route['lockscreen'] = 'dashboard/lockscreen';
