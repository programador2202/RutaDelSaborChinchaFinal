<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/nosotros', 'Home::nosotros');
$routes->get('/categorias', 'Home::categorias');
$routes->get('/index', 'Home::admin');


$routes->get('/Listacategorias', 'CategoriaController::index');
$routes->post('categorias/registrar', 'CategoriaController::registrar');
$routes->post('categorias/actualizar', 'CategoriaController::actualizar');
$routes->get('categorias/borrar/(:num)', 'CategoriaController::borrar/$1');




