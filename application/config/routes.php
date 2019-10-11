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

$route['default_controller'] = "home";
$route['404_override'] = '';

$route['home']='home/index';
$route['food']='home/food';
$route['deals']='home/deals';
$route['send_message']='home/send_message';
$route['get_deals']='home/get_deals';
$route['get_deals_items']='home/get_deals_items';
$route['get_foods']='home/get_foods';
$route['get_promotions']='home/get_promotions';
$route['get_foods_cat']='home/get_foods_cat';
$route['get_deals_cat']='home/get_deals_cat';
$route['deal/(:any)']='home/deal/$1';
$route['checkout'] = 'home/checkout';
$route['order_tracking/(:any)'] = 'home/orderTrack/$1';
$route['track-order'] = 'home/track_order';

$route['cart'] = 'home/cart';
$route['menu'] = 'home/menu';
$route['midnight-deals'] = 'home/midnight_deals';
$route['order-confirmation'] = 'home/order_confirmation';
$route['outlets'] = 'home/outlets';
$route['profile'] = 'home/profile';
$route['real-big-deals'] = 'home/real_big_deals';
$route['tempting-deals'] = 'home/tempting_deals';
/**
 * User Portal
 */
$route['user/register'] = 'user/register';
$route['user/otp/(:any)'] = 'user/otp/$1';
$route['user/login'] = 'user/login';
$route['user/portal'] = 'user/portal';
$route['user/orders/(:num)'] = 'user/orders/$1';


/*backend router*/
$route['admin/(:num)'] = 'admin/genres/index/$1';
$route['admin/categories/(:num)']='admin/categories/index/$1';
$route['admin/users/(:num)']='admin/users/index/$1';
$route['admin/sizes/(:num)']='admin/sizes/index/$1';
$route['admin/deal_categories/(:num)']='admin/deal_categories/index/$1';
$route['admin/deals/(:num)']='admin/deals/index/$1';
$route['admin/extras/(:num)']='admin/extras/index/$1';
$route['admin/foods/(:num)']='admin/foods/index/$1';
$route['admin/orders/(:num)']='admin/orders/index/$1';
$route['admin/contact/(:num)']='admin/contact/index/$1';

/**
 * XHR requests
 */
$route['xhr/load_cart'] = 'home/loadCart';
$route['xhr/checkout'] = 'home/checkoutPost';
$route['xhr/order_status'] = 'home/orderStatus';

/* End of file routes.php */
/* Location: ./application/config/routes.php */