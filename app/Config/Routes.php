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