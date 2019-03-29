<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'user';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// User ROUTES

$route['dashboard'] = 'user/dashboard';
$route['sales/(:any)'] = 'sales/$1';
$route['leads'] = 'Leads/viewlist';
$route['regions/(:any)'] = 'regions/$1';
$route['sales_status/(:any)'] = 'sales_status/$1';
$route['category/(:any)'] = 'category/$1';
$route['publisher/(:any)'] = 'publisher/$1';
// Sales Executive ROUTES
$route['sales_exc/(:any)'] = 'Sales_exc/$1';


// API
$route['addLead'] = 'api/addLead';

$route['leadlist'] = 'Leads/viewlist';
$route['getpopupNotification'] = 'Notification/getpopupNotification';
$route['updatestatus'] = 'Notification/updatepopupNotification';

$route['sales_lead'] = 'Sales_exc/ajaxList';
$route['sales_executive'] = 'Sales_exc/getAllactiveExecutive';

$route['admin_leads'] = 'Leads/ajaxList';

// Logout
$route['logout/(:any)'] = 'user/logout/$1';