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

$route['default_controller'] = "Welcome";
$route['404_override'] = 'error_404';
$route['translate_uri_dashes'] = FALSE;


/*********** USER DEFINED ROUTES *******************/
$route['administrator/login']='backend/login';
$route['administrator/loginMe'] = 'backend/login/loginMe';
$route['administrator/dashboard'] = 'backend/user';
$route['administrator/logout'] = 'backend/user/logout';
$route['administrator/userListing'] = 'backend/user/userListing';
$route['administrator/userListing/(:num)'] = "backend/user/userListing/$1";
$route['administrator/addNew'] = "backend/user/addNew";
$route['administrator/addNewUser'] = "backend/user/addNewUser";
$route['administrator/editOld'] = "backend/user/editOld";
$route['administrator/editOld/(:num)'] = "backend/user/editOld/$1";
$route['administrator/editUser'] = "backend/user/editUser";
$route['deleteUser'] = "backend/user/deleteUser";
$route['administrator/profile'] = "backend/user/profile";
$route['administrator/profile/(:any)'] = "backend/user/profile/$1";
$route['administrator/profileUpdate'] = "backend/user/profileUpdate";
$route['administrator/profileUpdate/(:any)'] = "backend/user/profileUpdate/$1";

$route['administrator/loadChangePass'] = "backend/user/loadChangePass";
$route['administrator/changePassword'] = "backend/user/changePassword";
$route['administrator/changePassword/(:any)'] = "backend/user/changePassword/$1";
$route['pageNotFound'] = "backend/user/pageNotFound";
$route['checkEmailExists'] = "backend/user/checkEmailExists";
$route['login-history'] = "backend/user/loginHistoy";
$route['login-history/(:num)'] = "backend/user/loginHistoy/$1";
$route['login-history/(:num)/(:num)'] = "backend/user/loginHistoy/$1/$2";

$route['forgotPassword'] = "backend/login/forgotPassword";
$route['resetPasswordUser'] = "backend/login/resetPasswordUser";
$route['resetPasswordConfirmUser'] = "backend/login/resetPasswordConfirmUser";
$route['resetPasswordConfirmUser/(:any)'] = "backend/login/resetPasswordConfirmUser/$1";
$route['resetPasswordConfirmUser/(:any)/(:any)'] = "backend/login/resetPasswordConfirmUser/$1/$2";
$route['createPasswordUser'] = "backend/login/createPasswordUser";
$route['register']='backend/register/index';

$route['administrator/categoryListing'] = 'backend/category/category/categoryListing';
$route['administrator/categoryListing/(:num)'] = 'backend/category/category/categoryListing/$1';
$route['administrator/category/add']='backend/category/category/add';
$route['administrator/category/edit/(:any)']='backend/category/category/edit/$1';
$route['administrator/category/view/(:any)']='backend/category/category/view/$1';

$route['administrator/productListing']='backend/product/product/productListing';
$route['administrator/productListing/(:num)']='backend/product/product/productListing/$1';
$route['administrator/product/add']='backend/product/product/add';
$route['administrator/product/edit/(:any)']='backend/product/product/edit/$1';
$route['administrator/product/view/(:any)']='backend/product/product/view/$1';

/* End of file routes.php */
/* Location: ./application/config/routes.php */
