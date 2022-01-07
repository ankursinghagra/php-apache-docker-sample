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

$route['default_controller'] = "frontend";
$route['photos'] = 'frontend/photos';
$route['photos/(:num)'] = 'frontend/photos/$1';
$route['videos'] = 'frontend/videos';
$route['videos/(:num)'] = 'frontend/videos/$1';
$route['blog'] = 'frontend/blog';
$route['blog/(:any)'] = 'frontend/blog/$1';
$route['blog/(:any)/(:any)'] = 'frontend/blog/$1/$2';
$route['our-work'] = 'frontend/projects';
$route['our-work/(:any)'] = 'frontend/projects/$1';
$route['contact'] = 'frontend/contact';
$route['sitemap\.xml'] = "frontend/sitemap";
$route['robots\.txt'] = "frontend/robots";

$route['admin'] = 'admin/dashboard';
$route['admin/(:any)'] = 'admin/$1';
$route['admin/(:any)/(:any)'] = 'admin/$1/$2';
$route['admin/(:any)/(:any)/(:any)'] = 'admin/$1/$2/$3';

$route['(:any)'] = 'frontend/pages/$1';
$route['(:any)/([0-9]+)'] = 'frontend/pages/$1/$2';
$route['(:any)/(:any)'] = 'frontend/pages_2/$1/$2';

$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */