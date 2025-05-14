<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Router\RouteCollection;

$routes = Services::routes();

$routes->get('/', 'VisitorController::index');
$routes->get('/visitor', 'VisitorController::index');
$routes->post('/visitor/signin', 'VisitorController::signIn');
$routes->get('/visitor/log', 'VisitorController::log');
$routes->get('/visitor/exportpdf', 'VisitorController::exportPdf');
