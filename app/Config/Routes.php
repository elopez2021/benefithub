<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index'); // Home page
$routes->get('/about', 'Home::about'); // About page
$routes->get('/contact', 'Home::contact'); // Contact section
$routes->get('/login', 'Home::login'); // Login page
$routes->post('login/submit', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');
$routes->get('checksession', 'AuthController::checkSession');

/*

$routes->get('admin/dashboard', 'AdminController::index');
$routes->get('employee/dashboard', 'EmployeeController::index');
$routes->get('business/dashboard', 'BusinessController::index');
$routes->get('logout', 'AuthController::logout');

*/



$routes->group('api', ['filter' => 'authFilter'], function ($routes) {
    $routes->post('user/register', 'AuthController::register', ['filter' => 'authFilter']);
    $routes->post('businesses/create', 'BusinessController::create', ['filter' => 'authFilter']);
    $routes->post('restaurants/create', 'RestaurantController::create', ['filter' => 'authFilter']);
    $routes->put('businesses/(:num)', 'BusinessController::update/$1');
    $routes->put('restaurants/(:num)', 'RestaurantController::update/$1');
    
    $routes->post('category/create', 'CategoryController::create');


    $routes->post('product/create', 'ProductsController::create');


});



$routes->group('admin', ['filter' => 'authFilter'], function ($routes) {
    $routes->get('dashboard', 'AdminController::index');
    $routes->get('business', 'AdminController::showBusiness');
    $routes->get('restaurants', 'AdminController::showRestaurants');
});

$routes->group('restaurant', ['filter' => 'authFilter'], function ($routes) {
    $routes->get('dashboard', 'RestaurantController::index');
    $routes->get('products', 'RestaurantController::products');
    $routes->get('categories', 'RestaurantController::categories');
});

$routes->group('employee', ['filter' => 'authFilter'], function ($routes) {
    $routes->get('dashboard', 'EmployeeController::index');
});
$routes->group('business', ['filter' => 'authFilter'], function ($routes) {
    $routes->get('dashboard', 'BusinessController::index');
});

/*


$routes->group('api', function ($routes) {
    // Apply tokenAuth to specific POST routes
    $routes->post('protected-route', 'ProtectedController::index', ['filter' => 'tokenAuth']);
    $routes->post('another-protected-route', 'AnotherController::index', ['filter' => 'tokenAuth']);

    // Unprotected POST routes
    $routes->post('unprotected-route', 'UnprotectedController::index');
});
*/

