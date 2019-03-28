<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
$route['default_controller'] = 'user';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// User ROUTES

// Admin Panel URL ROUTES

$route['dashboard'] = 'user/dashboard';
$route['sales/(:any)'] = 'sales/$1';
$route['allleads'] = 'user/viewlist';
$route['allleads/(:any)'] = 'user/viewlist/$1';
$route['leads'] = 'Leads/viewlist';
$route['marketing/(:any)'] = 'marketing/$1';
$route['marketing_agent/(:any)'] = 'marketing_agent/$1';
$route['regions/(:any)'] = 'regions/$1';
$route['sales_status/(:any)'] = 'sales_status/$1';
$route['category/(:any)'] = 'category/$1';
$route['publisher/(:any)'] = 'publisher/$1';

// Sales Executive ROUTES
$route['sales_exc/(:any)'] = 'Sales_exc/$1';

// Marketing Executive ROUTES
$route['marketing_exc/(:any)'] = 'marketing_exc/$1';

// Marketing Team ROUTES
$route['marketing_team/(:any)'] = 'marketing_team/$1';

// Logout
$route['logout/(:any)'] = 'user/logout/$1';

// API
$route['addLead'] = 'api/addLead';


$route['leadlist'] = 'Leads/viewlist';
//$route['Leads/viewlist'] = 'Leads/ajaxList';
$route['getpopupNotification'] = 'Notification/getpopupNotification';
$route['updatestatus'] = 'Notification/updatepopupNotification';



$route['sales_lead'] = 'Sales_exc/ajaxList';
$route['sales_executive'] = 'Sales_exc/getAllactiveExecutive';


$route['admin_leads'] = 'Leads/ajaxList';