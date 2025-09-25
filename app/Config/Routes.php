<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/nosotros', 'Home::nosotros');
$routes->get('/categorias', 'Home::categorias');
$routes->get('/index', 'Home::admin');
$routes->get('/vino', 'Home::vitinicolas');




// Rutas para el CRUD de Personas
$routes->get('/ListaPersona', 'PersonaController::index');       
$routes->post('personas/ajax', 'PersonaController::ajax');    


//rutas para usuarios
$routes->get('/ListaUsuarios', 'UsuarioController::index');       
$routes->post('usuarios/ajax', 'UsuarioController::ajax');    






// Rutas para el CRUD de Negocios
$routes->get('negocios', 'NegociosController::index');
$routes->post('negocios/ajax', 'NegociosController::ajax');


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