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

