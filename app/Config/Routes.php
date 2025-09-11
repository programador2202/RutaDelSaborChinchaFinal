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


$routes->get('/Listasecciones', 'SeccionesController::index');
$routes->post('secciones/registrar', 'SeccionesController::registrar');
$routes->post('secciones/actualizar', 'SeccionesController::actualizar');
$routes->get('secciones/borrar/(:num)', 'SeccionesController::borrar/$1');

$routes->get('/Listapersonas', 'PersonaController::index');
$routes->post('personas/registrar', 'PersonaController::registrar');
$routes->post('personas/actualizar', 'PersonaController::actualizar');
$routes->get('personas/borrar/(:num)', 'PersonaController::borrar/$1');



$routes->get('/ListarNegocios', 'NegociosController::index');
$routes->post('negocios/registrar', 'NegocioController::registrar');
$routes->post('negocios/actualizar', 'NegocioController::actualizar');
$routes->get('negocios/borrar/(:num)', 'NegocioController::borrar/$1');
