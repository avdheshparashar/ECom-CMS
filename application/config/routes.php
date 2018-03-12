<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "front/home";
$route['404_override'] = '';
$route['myaccount/myorder'] = 'front/customer/myorder';
$route['size/delete'] = 'size/delete';
$route['news'] = 'front/page/news';
$route['myaccount'] = 'front/customer/myaccount';
$route['myaccount/dashboard'] = 'front/customer/dashboard';
$route['myaccount/edit'] = 'front/customer/edit';
$route['myaccount/myaddress'] = 'front/customer/address';
$route['cart'] = 'front/order/cart';
$route['logout'] = 'front/customer/logout';
$route['admin'] = 'login/index';
$route['forget-password'] = 'front/customer/forget_password';
$route['reset'] = 'front/customer/reset';
$route['search'] = 'front/category/search';
$route['category/index'] = 'category/index';
$route['front/category/filter'] = 'front/category/filter';
$route['category/add'] = 'category/add';
$route['category/export'] = 'category/export';
$route['category/exportbrand'] = 'category/exportbrand';
$route['category/save'] = 'category/save';
$route['category/search'] = 'category/save';
$route['category/update'] = 'category/update';
$route['category/edit/(:any)'] = 'category/edit/$1';
$route['category/delete/(:any)'] = 'category/delete/$1';
$route['category/(:any)'] = 'front/category/index/$1';
$route['product/index'] = 'product/index';
$route['product/update'] = 'product/update';
$route['product/upload'] = 'product/upload';
$route['product/add'] = 'product/add';
$route['product/edit/(:any)'] = 'product/edit/$1';
$route['product/edit_inventory/(:any)'] = 'product/edit_inventory/$1';
$route['product/update_inventory'] = 'product/update_inventory';
$route['product/makefeatured/(:any)'] = 'product/makefeatured/$1';
$route['productimage/edit/(:any)'] = 'productimage/edit/$1';
$route['product/delete'] = 'product/delete';
$route['product/(:any)'] = 'front/product/view/$1';
$route['brand/index'] = 'brand/index';
$route['brand/index/(:any)'] = 'brand/index/$1';
$route['brand/save'] = 'brand/save';
$route['front/brand/filter'] = 'front/brand/filter';
$route['brand/export'] = 'brand/export';
$route['brand/cancel'] = 'brand/cancel';
$route['brand/(:any)'] = 'front/brand/index/$1';
/* End of file routes.php */
/* Location: ./application/config/routes.php */