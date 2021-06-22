<?php
use Core\Router;

// all routes should follow /
// using custom simple router

Router::add('/customers', [
  'method' => 'get',
  'controller' => 'CustomerController',
  'action' => 'index'
]);

Router::add('/customers', [
  'method' => 'post',
  'controller' => 'CustomerController',
  'action' => 'add'
]);

Router::add('/customers/:id', [
  'method' => 'get',
  'controller' => 'CustomerController',
  'action' => 'view'
]);

Router::add('/customers/:id', [
  'method' => 'put',
  'controller' => 'CustomerController',
  'action' => 'edit'
]);

Router::add('/customers/:id', [
  'method' => 'delete',
  'controller' => 'CustomerController',
  'action' => 'delete'
]);

Router::add('/customers/:id/addresses', [
  'method' => 'post',
  'controller' => 'CustomerController',
  'action' => 'addAddress'
]);

Router::add('/addresses', [
  'method' => 'get',
  'controller' => 'AddressController',
  'action' => 'index'
]);

Router::add('/addresses', [
  'method' => 'post',
  'controller' => 'AddressController',
  'action' => 'add'
]);

Router::add('/addresses/:id', [
  'method' => 'get',
  'controller' => 'AddressController',
  'action' => 'view'
]);



Router::add('/addresses/:id', [
  'method' => 'put',
  'controller' => 'AddressController',
  'action' => 'edit'
]);


Router::add('/addresses/:id', [
  'method' => 'delete',
  'controller' => 'AddressController',
  'action' => 'delete'
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


// cities will not be used, it is a simple varchar field instead on the address table
// Router::add('/cities', [
//   'method' => 'get',
//   'controller' => 'CityController',
//   'action' => 'index'
// ]);

// Router::add('/cities/:id', [
//   'method' => 'get',
//   'controller' => 'CityController',
//   'action' => 'view'
// ]);

