<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/nosotros', 'Home::nosotros');
$routes->get('/categorias', 'Home::categorias');
$routes->get('/index', 'Home::admin');



// Rutas para el CRUD de Personas

$routes->group('admin/personas', function($routes) {
    $routes->get('/personas', 'PersonaController::index');       
    $routes->post('ajax', 'PersonaController::ajax');    
});


$routes->get('/personas', 'PersonaController::index');
$routes->post('personas/registrar', 'PersonaController::registrar');
$routes->post('personas/actualizar', 'PersonaController::actualizar');
$routes->get('personas/borrar/(:num)', 'PersonaController::borrar/$1');

// Rutas para el CRUD de Usuarios
$routes->get('/usuarios', 'UsuarioController::index');              
$routes->post('registrar', 'UsuarioController::registrar'); 
$routes->post('actualizar', 'UsuarioController::actualizar'); 
$routes->get('borrar/(:num)', 'UsuarioController::borrar/$1'); 



// Rutas para el CRUD de Negocios
$routes->get('/negocios', 'NegociosController::index');             
$routes->post('/registrar', 'NegociosController::store');            
$routes->post('actualizar', 'NegociosController::update');   
$routes->get('eliminar/(:num)', 'NegociosController::delete/$1');


// Rutas para el CRUD de Locales
$routes->get('/locales', 'LocalController::index');
$routes->post('locales/registrar', 'LocalController::registrar');
$routes->post('locales/actualizar', 'LocalController::actualizar');
$routes->get('locales/borrar/(:num)', 'LocalController::borrar/$1');

// Rutas para cartas
$routes->get('/cartas', 'CartaController::index');


// Rutas para horarios
$routes->get('/horarios', 'HorarioController::index');


// Rutas para recursos
$routes->get('/recursos', 'RecursoController::index');

// Rutas para mostrar en la página principal
$routes->get('/mostrar', 'MostrarController::index');