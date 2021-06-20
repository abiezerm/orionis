<?php
use Core\Router;

// all routes should follow /
// using custom simple router

Router::add('/customers', [
  'method' => 'get',
  'controller' => 'CustomerController',
  'action' => 'index'
]);

Router::add('/customers/:id', [
  'method' => 'get',
  'controller' => 'CustomerController',
  'action' => 'view'
]);


Router::add('/city', [
  'method' => 'get',
  'controller' => 'CityController',
  'action' => 'index'
]);

Router::add('/city/:id', [
  'method' => 'get',
  'controller' => 'CityController',
  'action' => 'view'
]);
