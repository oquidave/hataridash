<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
* client dashboard 
**/
$route['default_controller'] = "login";
$route['404_override'] = '';

/**
*Login
*/
$route['login'] = 'login/user_login';
$route['logout'] = 'login/logout';
$route['forgot_password'] = 'login/forgot_password';

/**
*Admin interface 
*/
$route['admin'] = 'dashadmin/home';
$route['admin/view_acc/:num'] = 'dashadmin/view_acc';

$route['admin/add_acc'] = 'dashadmin/add_acc';
$route['admin/renew_acc'] = 'dashadmin/renew_acc';
$route['admin/invoice'] = 'dashadmin/invoice';
$route['admin/client_mgt/(:any)/(:num)'] = 'dashadmin/client_mgt';

/**
* Client interface
*/
$route['client'] = "dashclient/home";
$route['client/edit_profile'] = "dashclient/edit_profile";
$route['client/chg_pw'] = "dashclient/chg_pw";


/**
*Authentication
*/
$route['u/login'] = 'auth/login';
$route['u/logout'] = 'auth/logout';
$route['u/register'] = 'auth/create_user';

$route['u/users'] = 'auth/index';
$route['u/create'] = 'auth/create_user';
$route['u/delete/:num'] = 'auth/delete_user';
$route['u/edit/:num'] = 'auth/edit_user';


/* End of file routes.php */
/* Location: ./application/config/routes.php */