<?php

use App\Controllers\Home;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/nosotros', 'Home::nosotros');
$routes->get('/categorias', 'Home::categorias');
$routes->get('/dashboard', 'Home::admin');
$routes->get('/blog','Home::blog');
$routes->get('negocios/detalle/(:num)', 'DetalleController::detalle/$1');
$routes->get('comentarios', 'ComentarioController::index');
$routes->get('/datos/dashboard', 'DashboardController::index');




$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->post('comentarios/guardar', 'ComentarioController::guardar');
});

//login de administadores
$routes->get('/index', 'AdminLogin::index');
$routes->post('admin/loginPost', 'AdminLogin::loginPost');
$routes->get('admin/logout', 'AdminLogin::logout');


//listar usuarios
$routes->get('/usuarios', 'LoginController::index');
$routes->post('/usuarios/ajax', 'LoginController::ajax');





//login de usuarios 
$routes->get('login', 'LoginController::login');
$routes->post('loginPost', 'LoginController::loginPost');
$routes->get('register', 'LoginController::register');
$routes->post('registerPost', 'LoginController::registerPost');
$routes->get('/logout', 'LoginController::logout');


//buscador de index
$routes->get('/buscar', 'BuscarController::index'); 
$routes->get('/buscar/sugerencias', 'BuscarController::sugerencias'); 
$routes->get('/buscar/mapaBusquedaPorPlato', 'BuscarController::mapaBusquedaPorPlato');




//ruta de mapa
$routes->get('/mapa', 'MapController::index');
$routes->get('/mapa/restaurantes', 'MapController::restaurantes');
$routes->get('mapa/buscar', 'MapController::buscar');




// Rutas para el CRUD de Personas
$routes->get('/ListaPersona', 'PersonaController::index');       
$routes->post('personas/ajax', 'PersonaController::ajax');    
//rutas para usuarios
$routes->get('/ListaUsuarios', 'UsuarioController::index');       
$routes->post('/usuarios/accion', 'UsuarioController::ajax');    
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
// Rutas para reservas
$routes->get('/reservas', 'ReservasController::index');        
$routes->post('ajax', 'ReservasController::ajax');  
$routes->get('/reservas/public/', 'ReservasController::vistaPublica');

//rutas para reservas platos
$routes->get('/reservasplatos', 'ReservasPlatosController::index');
$routes->get('reservas-platos/agregar/(:num)/(:num)', 'ReservasPlatosController::agregar/$1/$2'); // agregar platos a reserva
$routes->post('reservas-platos/guardar', 'ReservasPlatosController::guardar'); 





