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
$routes->get('/admin/encuentros', 'Admin\Encuentros::index');
$routes->post('/admin/encuentros/actualizar', 'Admin\Encuentros::actualizar');
$routes->post('/admin/encuentros/recarga', 'Admin\Encuentros::recarga');
$routes->get('/admin/encuentros/eliminar/(:num)', 'Admin\Encuentros::eliminar/$1');
$routes->get('/admin/encuentros/modificar/(:num)', 'Admin\Encuentros::modificar/$1');
$routes->get('/admin/contactos', 'Admin\Contactos::index');
$routes->post('/admin/contactos/actualizar', 'Admin\Contactos::actualizar');
$routes->post('/admin/contactos/recarga', 'Admin\Contactos::recarga');
$routes->get('/admin/contactos/eliminar/(:num)/(:num)', 'Admin\Contactos::eliminar/$1/$2');
$routes->get('/admin/contactos/modificar/(:num)', 'Admin\Contactos::modificar/$1');
$routes->get('/admin/contactos/eliminarContacto/(:num)/(:num)/(:num)', 'Admin\Contactos::eliminarContacto/$1/$2/$3');
$routes->get('/admin/contactos/insertarEncuentro/(:num)/(:num)', 'Admin\Contactos::insertarEncuentro/$1/$2');
$routes->get('/admin/contactos/modificarContacto/(:num)/(:num)', 'Admin\Contactos::modificarContacto/$1/$2');
$routes->get('/admin/carteles', 'Admin\Carteles::index');
$routes->post('/admin/carteles/actualizar', 'Admin\Carteles::actualizar');
$routes->post('/admin/carteles/recarga', 'Admin\Carteles::recarga');
$routes->get('/admin/carteles/eliminar/(:num)/(:num)', 'Admin\Carteles::eliminar/$1/$2');
$routes->get('/admin/carteles/modificar/(:num)', 'Admin\Carteles::modificar/$1');
