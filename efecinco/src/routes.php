<?php

// Rutas de Servicios
$router->get('/servicios', 'ServicesController@index');
$router->get('/servicios/{id}', 'ServicesController@detalle');

// Rutas de Administración de Servicios
$router->get('/admin/servicios', 'ServicesAdminController@index');
$router->get('/admin/servicios/crear', 'ServicesAdminController@crear');
$router->post('/admin/servicios/crear', 'ServicesAdminController@crear');
$router->get('/admin/servicios/editar/{id}', 'ServicesAdminController@editar');
$router->post('/admin/servicios/editar/{id}', 'ServicesAdminController@editar');
$router->get('/admin/servicios/eliminar/{id}', 'ServicesAdminController@eliminar');

// Rutas de Proyectos
$router->get('/proyectos', 'ProjectsController@index');
$router->get('/proyectos/{id}', 'ProjectsController@detalle'); 