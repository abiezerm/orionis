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

Router::add('/customers', [
  'method' => 'post',
  'controller' => 'CustomerController',
  'action' => 'add'
]);

Router::add('/addresses', [
  'method' => 'get',
  'controller' => 'AddressController',
  'action' => 'index'
]);

Router::add('/addresses/:id', [
  'method' => 'get',
  'controller' => 'AddressController',
  'action' => 'view'
]);

Router::add('/countries', [
  'method' => 'get',
  'controller' => 'CountryController',
  'action' => 'index'
]);

Router::add('/countries/:id', [
  'method' => 'get',
  'controller' => 'CountryController',
  'action' => 'view'
]);

Router::add('/countries/:id/states', [
  'method' => 'get',
  'controller' => 'CountryController',
  'action' => 'getStates'
]);

Router::add('/states', [
  'method' => 'get',
  'controller' => 'StateController',
  'action' => 'index'
]);

Router::add('/states/:id', [
  'method' => 'get',
  'controller' => 'StateController',
  'action' => 'view'
]);


Router::add('/states/:id/cities', [
  'method' => 'get',
  'controller' => 'StateController',
  'action' => 'getCities'
]);


Router::add('/cities', [
  'method' => 'get',
  'controller' => 'CityController',
  'action' => 'index'
]);

Router::add('/cities/:id', [
  'method' => 'get',
  'controller' => 'CityController',
  'action' => 'view'
]);

