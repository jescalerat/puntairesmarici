<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/admin', 'Home::indexAdmin');
$routes->get('/calendario/(:num)/(:num)', 'Calendario::index/$1/$2');
$routes->get('/encuentros/(:num)/(:num)/(:num)/(:num)', 'Encuentros::index/$1/$2/$3/$4');
$routes->get('/encuentro/(:num)/(:num)', 'Encuentro::index/$1/$2');
$routes->get('/buscador', 'Buscador::index');
$routes->post('/combos/comunidades', 'Combos::comunidades');
$routes->post('/combos/provincias', 'Combos::provincias');
$routes->post('/combos/municipios', 'Combos::municipios');
$routes->post('/buscador/recarga', 'Buscador::recarga');
$routes->get('/contactar', 'Contactar::index');
$routes->post('/contactar/mensaje', 'Contactar::mensaje');
$routes->get('/cambioidioma/(:any)', 'CambioIdioma::index/$1');
$routes->get('/admin/login', 'Admin\Login::index');
$routes->post('/admin/comprobar', 'Admin\Login::comprobar');
$routes->get('/admin/inicio', 'Admin\Inicio::index');
$routes->get('/admin/info', 'Admin\Info::index');
$routes->get('/admin/visitas', 'Admin\Visitas::index');
$routes->get('/admin/visitas/eliminar/(:num)', 'Admin\Visitas::eliminar/$1');
$routes->get('/admin/paginas', 'Admin\Paginas::index');
$routes->get('/admin/paginas/eliminar/(:num)', 'Admin\Paginas::eliminar/$1');
$routes->get('/admin/paginas/buscar/(:any)/(:any)', 'Admin\Paginas::buscar/$1/$2');
$routes->get('/admin/correo', 'Admin\Correo::index');
$routes->get('/admin/correo/eliminar/(:num)', 'Admin\Correo::eliminar/$1');
$routes->get('/admin/cambio', 'Admin\Cambio::index');
$routes->post('/admin/cambio/actualizar', 'Admin\Cambio::actualizar');
$routes->get('/admin/bbdd', 'Admin\Bbdd::index');
$routes->post('/admin/bbdd/actualizar', 'Admin\Bbdd::actualizar');
$routes->get('/admin/municipios', 'Admin\Municipios::index');
$routes->post('/admin/municipios/actualizar', 'Admin\Municipios::actualizar');
$routes->post('/admin/municipios/recarga', 'Admin\Municipios::recarga');
$routes->get('/admin/municipios/eliminar/(:num)', 'Admin\Municipios::eliminar/$1');
$routes->get('/admin/municipios/modificar/(:num)', 'Admin\Municipios::modificar/$1');