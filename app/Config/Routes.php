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


$routes->get('admin/dashboard', 'AdminController::index');
$routes->get('logout', 'AuthController::logout');

/*


$routes->group('api', function ($routes) {
    // Apply tokenAuth to specific POST routes
    $routes->post('protected-route', 'ProtectedController::index', ['filter' => 'tokenAuth']);
    $routes->post('another-protected-route', 'AnotherController::index', ['filter' => 'tokenAuth']);

    // Unprotected POST routes
    $routes->post('unprotected-route', 'UnprotectedController::index');
});
*/

