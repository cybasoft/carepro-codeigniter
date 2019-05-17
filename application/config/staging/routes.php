<?php
defined('BASEPATH') or exit('No direct script access allowed');
//generate migration tables (!)
$route['migration/(:any)'] = 'migration/$1';

$route['default_controller'] = 'auth';
$route['404_override'] = 'landing/error404';
$route['translate_uri_dashes'] = FALSE;

$route['dashboard'] = 'dashboard/index';

$route['auth/(:any)'] = 'auth/$1';
$route['login'] = 'auth/login';
$route['register'] = 'auth/register';
$route['logout'] = 'auth/logout';
$route['forgot'] = 'auth/forgot';
$route['reset/(:any)'] = 'auth/reset/$1';

//accounting
$route['new_invoice'] = 'invoice/create_invoice';

$route['settings/(:any)'] = 'settings/$1';

//users
$route['users'] = 'userController/index';
$route['users/(:any)'] = 'userController/$1';
$route['users/(:any)/:num'] = 'userController/$1';

$route['groups/:num'] = 'userController/edit_group/$1';

//calendar
$route['calendar/(:any)'] = 'calendar/$1';

//children
$route['children/(:any)'] = 'children/$1';

//child
$route['child/register']['post'] = 'child/store';
$route['child/(:num)']['get'] = 'child/index/$1';
$route['child/(:num)']['post'] = 'child/update';
$route['child/(:num)/uploadPhoto'] = 'child/uploadPhoto/$1';
$route['child/(:num)/assignParent']['get'] = 'child/assignParent/$1';
$route['child/(:num)/assignParent']['post'] = 'child/doAssignParent/$1';
$route['child/(:num)/(:num)/removeParent'] = 'child/removeParent/$1/$2';
$route['child/checkInOut/(:num)'] = 'child/checkInOut/$1';

$route['child/(:num)/checkIn']['post'] = 'child/doCheckIn/$1';
$route['child/(:num)/checkOut']['post'] = 'child/doCheckOut/$1';
$route['child/(:num)/health'] = 'health/index/$1';
$route['child/addAllergy'] = 'health/addAllergy';
$route['child/addContact'] = 'health/addContact';
$route['child/addProvider'] = 'health/addProvider';
$route['child/addProblem'] = 'health/addProblem';
$route['child/deleteAllergy/(:num)'] = 'health/deleteAllergy/$1';

$route['child/deleteContact/(:num)'] = 'health/deleteContact/$1';
$route['child/deleteProvider/(:num)'] = 'health/deleteProvider/$1';
$route['child/deleteProblem/(:num)'] = 'health/deleteProblem/$1';

$route['child/(:num)/pickup']['post'] = 'pickup/store/$1';
$route['child/deletePickup/(:num)'] = 'pickup/deletePickup/$1';
$route['child/(:num)/attendance'] = 'child/attendance/$1';

$route['child/:num/billing'] = 'BillingController/index';
$route['child/:num/billing/(:any)'] = 'BillingController/$1';

$route['invoice/:any'] = 'accounting/invoice/$1';
$route['invoice/(:num)/pay'] = 'invoice/pay/$1';
$route['child/(:num)/invoices/search'] = 'invoice/invoices/$1/all';
$route['child/(:num)/invoices/(:any)'] = 'invoice/invoices/$1/$2';
$route['child/(:num)/newInvoice'] = 'invoice/create/$1';
$route['child/(:num)/createInvoice'] = 'invoice/store/$1';

$route['invoice/(:num)/delete'] = 'invoice/delete/$1';
$route['invoice/(:num)/view'] = 'invoice/view/$1';
$route['invoice/(:num)/addItem'] = 'invoice/addItem/$1';
$route['invoice/(:num)/deleteItem/(:num)'] = 'invoice/deleteItem/$1/$2';
$route['invoice/(:num)/makePayment'] = 'invoice/makePayment/$1';
$route['invoice/(:num)/preview'] = 'invoice/preview/$1';

$route['invoice/(:num)/download'] = 'invoice/pdf/$1';

$route['invoice/(:num)/updateStatus'] = 'invoice/updateStatus/$1';

//billing
$route['invoice/(:num)/paypal'] = 'paypal/pay/$1';
$route['paypal/cancelled'] = 'paypal/cancelled';
$route['paypal/success'] = 'paypal/success';
$route['charges/:any'] = 'accounting/charges/$1';
$route['accounting/:any'] = 'accounting/accounting/$1';

//child photos
$route['child/(:num)/photos'] = 'photos/index';

$route['photos/(:any)'] = 'photos/$1';
$route['photos/(:any)/:num'] = 'photos/$1';

//parents
$route['parents/:any'] = 'parents/$1';
$route['parents/(:any)/(:any)'] = 'parents/$1';

//parent
$route['parent/(:any)'] = 'ParentController/$1';

$route['news'] = 'NewsController/index';
$route['news/(:any)'] = 'NewsController/$1';
$route['news/(:any)/:num'] = 'NewsController/$1';

$route['lockscreen'] = 'dashboard/lockscreen';
$route['invoice/(:num)/stripe-pay'] = 'invoice/stripePayment/$1';

//reports
$route['child/reports'] = 'reports/index';
$route['child/(:num)/reports'] = 'child/reports/$1';
$route['reports/(:any)'] = 'reports/$1';

//rooms
$route['rooms'] = 'roomsController/index';
$route['rooms/(:any)'] = 'roomsController/$1';
$route['rooms/(:any)/:num'] = 'roomsController/$1';
$route['rooms/(:any)/:num/:num'] = 'roomsController/$1';

//health
$route['health/(:any)'] = 'health/$1';
$route['health/(:any)/:num'] = 'health/$1';

//meds
$route['meds/(:any)'] = 'meds/$1';
$route['meds/(:any)/:num'] = 'meds/$1';

//notes
$route['child/:num/notes'] = 'notes/index';
$route['notes/(:any)'] = 'notes/$1';
$route['notes/(:any)/:num'] = 'notes/$1';

//files
$route['files'] = 'files/index';
$route['files/(:any)'] = 'files/$1';

//food
$route['food/(:any)'] = 'food/$1';
$route['food/(:any)/:num'] = 'food/$1';

//backup
$route['admin/backup/(:any)'] = 'backupController/$1';
$route['admin/backup/(:any)/(:any)'] = 'backupController/$1';

//messaging
$route['messaging'] = 'MessagingController/index';
$route['messaging/(:any)'] = 'MessagingController/$1';
$route['messaging/(:any)/:num'] = 'MessagingController/$1/$1';

//meals
$route['meals/(:any)'] = 'MealController/$1';
$route['meals/(:any)/:num'] = 'MealController/$1';
//activities
$route['activities/(:any)'] = 'ActivityController/$1';
$route['activities/(:any)/:num'] = 'ActivityController/$1';