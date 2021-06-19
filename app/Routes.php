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
