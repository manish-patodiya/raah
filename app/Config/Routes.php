<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Frontend');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override(
    function () {
        return view('frontend/errors/404.php');
    }
);
$routes->setAutoRoute(true);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// common routes
$routes->get('/', 'Frontend::index');
$routes->get('/home', 'Frontend::index');
$routes->get('/news', 'Frontend::news');
$routes->get('/about', 'Frontend::about');
$routes->get('/production-process', 'Frontend::production_process');
$routes->get('/what-we-do', 'Frontend::what_we_do');
$routes->get('/get-involve', 'Frontend::get_involve');
$routes->get('/about-ktdc', 'Frontend::about_ktdc');
$routes->get('/our-mission-vision', 'Frontend::our_mission');
$routes->get('/donate', 'Frontend::donate');
$routes->get('/contact-us', 'Frontend::contact_us');
$routes->get('/terms-conditions', 'Frontend::terms_and_conditions');
$routes->get('/privacy-policy', 'Frontend::privacy_policy');
$routes->get('/cancellation-policy', 'Frontend::cancellation_policy');
$routes->get('/returns-refunds-replacement-policy', 'Frontend::returns_refunds_replacement_policy');
$routes->get('/responsible-disclosure-policy', 'Frontend::responsible_disclosure_policy');
$routes->get('/intellectual-property-policy', 'Frontend::intellectual_property_policy');
$routes->get('/anti-plishing-alert', 'Frontend::anti_plishing_alert');
$routes->get('/faqs', 'Frontend::faqs');

// product related routes
$routes->get('/products', 'Products::index');
$routes->get('/products/detail/(:any)', 'Products::product_detail/$1');
$routes->get('/cart', 'Products::product_cart');

// auth routing
$routes->get('/admin', 'Admin\Auth::index');
$routes->get('/customer', 'Customer\Auth::index');
$routes->get('/seller', 'Seller\Auth::index');

$routes->post('/auth/adminlogin', 'Admin\Auth::checklogin/admin');

$routes->post('/auth/sellerlogin', 'Seller\Auth::checklogin');
$routes->post('/auth/sellerRegistration', 'Seller\Auth::register');

$routes->post('/auth/customerlogin', 'Customer\Auth::checklogin');
$routes->post('/auth/customerRegistration', 'Customer\Auth::register');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}