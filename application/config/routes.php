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

$route[rawurlencode('หมวด')]='db'; // หากไม่ต้องการใช้ function rawurlencode ในการแปลง สามารถแปลงอัตโนมัติได้ที่ไฟล์ system/core/URI.php
$route[rawurlencode('หวย')]='fun/test3';
$route['default_controller'] = "welcome/index";//welcome
$route['404_override'] = 'welcome/error';
//$route['translate_uri_dashes'] = FALSE;
$route['post_error'] = 'welcome/post_error';
$route['error'] = 'welcome/error';
$route['view/(:any)'] = 'welcome/view/$1';
$route['post'] = 'welcome/post';
$route['post/(:any)'] = 'welcome/post/$1';
$route['post_picture/(:any)'] = 'welcome/post_picture/$1';
$route['login'] = 'welcome/login';
$route['register'] = 'welcome/register';
$route['help'] = 'welcome/help';
$route['payment'] = 'welcome/payment';
$route['contact'] = 'welcome/contact';
$route['profile'] = 'member/profile';
$route['verify'] = 'welcome/verify';
$route['uploadify'] = 'welcome/uploadify';
$route['page/(:num)'] = 'welcome/page/$1';

/*$route['register'] = 'first/register';
$route['setting'] = 'first/setting';
$route['post'] = 'first/post';
$route['edit/(:num)'] = 'first/edit/$1';

$route['u/(:num)/(:any)'] = 'first/u/$1/$2';
$route['u/(:num)'] = 'first/u/$1';

$route['view/(:num)'] = 'first/view/$1';

$route['(:num)'] = 'admin/login_page/$1';*/

/* End of file routes.php */
/* Location: ./application/config/routes.php */