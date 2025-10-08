<?php

use App\Controllers\Home;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/nosotros', 'Home::nosotros');
$routes->get('/categorias', 'Home::categorias');
$routes->get('/index', 'Home::admin');
$routes->get('/blog','Home::blog');
$routes->get('negocios/detalle/(:num)', 'DetalleController::detalle/$1');
$routes->post('comentarios/guardar', 'ComentarioController::guardar');



//buscador de index
$routes->get('/buscar', 'BuscarController::index'); 
$routes->get('/buscar/sugerencias', 'BuscarController::sugerencias'); 

//ruta de mapa
$routes->get('/mapa', 'MapController::index');
$routes->get('/mapa/restaurantes', 'MapController::restaurantes');


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
$routes->post('locales/ajax', 'LocalController::ajax');
// Rutas para cartas
$routes->get('/cartas', 'CartaController::index');
$routes->post('cartas/ajax', 'CartaController::ajax');
// Rutas para horarios
$routes->get('/horarios', 'HorarioController::index');
$routes->post('Horario/ajax', 'HorarioController::ajax');
//ruta para chatbox
$routes->post('/chatbot', 'ChatController::index');

//ruta para contratos 
$routes->get('/contratos', 'ContratoController::index');
$routes->post('contrato/ajax','ContratoController::ajax');


