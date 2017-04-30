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
|	http://codeigniter.com/user_guide/general/routing.html
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
$route['default_controller'] = 'Customer_interface_c';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// admin interface
$route['admin']					    				= 'Dashboard1';
$route['user_list']									= 'User_c';
$route['user_form']					 				= 'User_c/User_form';
$route['user_form_edit/(:num)']            = 'User_c/User_edit/$1';

$route['cabang_list']               = 'Cabang_c';
$route['cabang_form']               = 'Cabang_c/cabang_form';
$route['cabang_edit/(:num)']        = 'Cabang_c/cabang_edit/$1';

$route['lapangan_list']             = 'Ruangan_c';
$route['lapangan_edit/(:num)']      = 'Ruangan_c/edit_ruangan/$1';
$route['lapangan_form']             = 'Ruangan_c/ruangan_form';

$route['Head_office']               = 'Office_c';
$route['Head_office_form']          = 'Office_c/office_form';
