<?php
defined('BASEPATH') or exit('No direct script access allowed');
//generate migration tables (!)
$route['migration/(:any)'] = 'migration/$1';
//$route['migration/(:any)/(:any)'] = 'migration/$1';

$route['default_controller'] = 'auth';
$route['404_override'] = 'landing/error404';
$route['translate_uri_dashes'] = FALSE;

$route['dashboard'] = 'dashboard/index';

$route['auth/(:any)'] = 'auth/$1';
$route['login']='auth/login';
$route['register']='auth/register';
$route['logout']='auth/logout';
$route['forgot']='auth/forgot';
$route['reset/(:any)']='auth/reset/$1';

//accounting
$route['new_invoice'] = 'invoice/create_invoice';

$route['groups/:num'] = 'users/edit_group/$1';
$route['settings/(:any)'] = 'settings/$1';

//users
//$route['users'] = 'users';
//$route['users/create'] = 'users/store';
//$route['users/:any'] = 'users/$1';
//$route['user/(:num)']['get'] = 'users/view/$1';
//$route['user/(:num)']['post'] = 'users/update/$1';
//$route['user/(:num)/delete'] = 'users/delete/$1';
//$route['user/(:num)/updateUserData'] = 'users/updateUserData/$1';
$route['users/(:any)'] = 'users/$1';

//calendar
$route['calendar/(:any)'] = 'calendar/$1';

//children
$route['children/(:any)'] = 'children/$1';

//child
$route['child/register']['post'] = 'child/child/store';
$route['child/(:num)']['get'] = 'child/child/index/$1';
$route['child/(:num)']['post'] = 'child/child/update';
$route['child/(:num)/uploadPhoto'] = 'child/child/uploadPhoto/$1';
$route['child/(:num)/assignParent']['get'] = 'child/child/assignParent/$1';
$route['child/(:num)/assignParent']['post'] = 'child/child/doAssignParent/$1';
$route['child/(:num)/(:num)/removeParent'] = 'child/child/removeParent/$1/$2';
$route['child/(:num)/checkIn']['get'] = 'child/child/checkIn/$1';
$route['child/(:num)/checkIn']['post'] = 'child/child/doCheckIn/$1';
$route['child/(:num)/checkOut']['get'] = 'child/child/checkOut/$1';
$route['child/(:num)/checkOut']['post'] = 'child/child/doCheckOut/$1';
$route['child/(:num)/health'] = 'child/health/index/$1';
$route['child/addAllergy'] = 'child/health/addAllergy';
$route['child/addContact'] = 'child/health/addContact';
$route['child/addProvider'] = 'child/health/addProvider';
$route['child/addProblem'] = 'child/health/addProblem';
$route['child/deleteAllergy/(:num)'] = 'child/health/deleteAllergy/$1';

$route['child/deleteContact/(:num)'] = 'child/health/deleteContact/$1';
$route['child/deleteProvider/(:num)'] = 'child/health/deleteProvider/$1';
$route['child/deleteProblem/(:num)'] = 'child/health/deleteProblem/$1';

$route['child/(:num)/pickup']['post'] = 'child/pickup/store/$1';
$route['child/deletePickup/(:num)'] = 'child/pickup/deletePickup/$1';
$route['child/(:num)/attendance'] = 'child/child/attendance/$1';
$route['invoice/:any'] = 'accounting/invoice/$1';
$route['invoice/(:num)/pay'] = 'child/invoice/pay/$1';
$route['child/(:num)/billing'] = 'child/invoice/index/$1';
$route['child/(:num)/invoices/search'] = 'child/invoice/invoices/$1/all';
$route['child/(:num)/invoices/(:any)'] = 'child/invoice/invoices/$1/$2';
$route['child/(:num)/newInvoice'] = 'child/invoice/create/$1';
$route['child/(:num)/createInvoice'] = 'child/invoice/store/$1';

$route['invoice/(:num)/delete'] = 'child/invoice/delete/$1';
$route['invoice/(:num)/view'] = 'child/invoice/view/$1';
$route['invoice/(:num)/addItem'] = 'child/invoice/addItem/$1';
$route['invoice/(:num)/deleteItem/(:num)'] = 'child/invoice/deleteItem/$1/$2';
$route['invoice/(:num)/makePayment'] = 'child/invoice/makePayment/$1';
$route['invoice/(:num)/preview'] = 'child/invoice/preview/$1';

$route['invoice/(:num)/download'] = 'child/invoice/pdf/$1';

$route['invoice/(:num)/updateStatus'] = 'child/invoice/updateStatus/$1';

//billing
$route['invoice/(:num)/paypal'] = 'billing/paypal/pay/$1';
$route['paypal/cancelled'] = 'billing/paypal/cancelled';
$route['paypal/success'] = 'billing/paypal/success';
$route['charges/:any'] = 'accounting/charges/$1';
$route['accounting/:any'] = 'accounting/accounting/$1';

//child photos
$route['child/(:num)/photos'] = 'child/photos/index';

$route['photos/(:any)']='child/photos/$1';
$route['photos/(:any)/:num']='child/photos/$1';

//parents
$route['parents/:any'] = 'parents/$1';

//parent
$route['parent/(:any)'] = 'parentController/$1';

$route['news/(:any)'] = 'news/$1';
$route['lockscreen'] = 'dashboard/lockscreen';
$route['invoice/(:num)/stripe-pay'] = 'child/invoice/stripePayment/$1';

//reports
$route['child/reports'] = 'reports/index';
$route['child/(:num)/reports'] = 'child/child/reports/$1';
$route['reports/(:any)'] = 'reports/$1';

//rooms
$route['rooms'] = 'roomsController/index';
$route['rooms/(:any)']='roomsController/$1';
$route['rooms/(:any)/:num']='roomsController/$1/$id';

//health
$route['health/(:any)']='child/health/$1';
$route['health/(:any)/:num']='child/health/$1';

//meds
$route['meds/(:any)']='child/meds/$1';
$route['meds/(:any)/:num']='child/meds/$1';

//notes
$route['child/:num/notes']='child/notes/index';
$route['notes/(:any)']='child/notes/$1';
$route['notes/(:any)/:num']='child/notes/$1';

//files
$route['files']='files/index';
$route['files/(:any)']='files/$1';

//food
$route['child/deleteFoodPref/(:num)'] = 'child/health/deleteFoodPref/$1';
$route['child/addFoodPref'] = 'child/health/addFoodPref';

$route['food/(:any)']='child/food/$1';
$route['food/(:any)/:num']='child/food/$1';

//backup
$route['admin/backup/(:any)']='admin/backupController/$1';
$route['admin/backup/(:any)/(:any)']='admin/backupController/$1';