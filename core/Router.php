<?php
namespace Core;
use App\Controllers;

// Simple Custom Router
class Router {
  protected static $routes = [];

  // Example actions
  // [
  //   'method' => 'get', 
  //   'controller' => 'CustomerController', 
  //   'action' => 'index',
  //   'function' => function() {
  //     echo 'Customers GET';
  //   }
  // ]
  public static function add($route, $actions) {
    $requestURL = "/{$_GET['url']}";
    $routes[] = [
      'route' => $route,
      'actions' => $actions
    ];

    // if a request method is not specified, the default one will be get
    if (!isset($actions['method'])) {
      $actions['method'] = 'get';
    }

    // Regular expression matching routing
    $regexPattern = self::createRouteRegex($route);
    
    if (preg_match($regexPattern, $requestURL) == 1) {
      if (self::checkRequestMethod($actions['method'])) {
        self::callToAction($requestURL, $actions);
        App::bind('validRoute', true);
        return;
      }
    }
    // simply matching, check if the request url matches with the specified in the router
    // if ($_GET['url'] === $route) {
    //   if (self::checkRequestMethod($actions['method'])) {
    //     self::callToAction($actions);
    //     return;
    //   }
    // }
  }

  // Simple regex routing generator
  /* examples 
    /customers     -> @^/customers$@D
    /customers/:id -> @^/customers/([a-zA-Z0-9\-\_]+)$@D
  /*/
  private static function createRouteRegex($route) {
    $pattern = "@^" . preg_replace('/\\\:[a-zA-Z0-9\_\-]+/', '([a-zA-Z0-9\-\_]+)', preg_quote($route)) . "$@D";
    return $pattern;
  }

  private static function checkRequestMethod($method) {
    // if the request url matches with the specified in the router
    if (strcasecmp($_SERVER['REQUEST_METHOD'], $method) == 0) {
      return true;
    }

    return false;
  }

  // if a function is specified only the function is called
  // if a controller method is specified then only the method is called (not the function action)
  private static function callToAction($requestURL, $actions) {
    // call function instead of controller method
    if (isset($actions['function'])) {
      if (is_callable($actions['function'])) {
        $actions['function']->__invoke();
        return;
      } else {
        throw new \Exception("Invalid Function"); 
      }
    } 

    // Instatiating a Controller and Calling the specified Method
    if (isset($actions['controller'])) {
      $classString = "App\\Controllers\\{$actions['controller']}";
    } else {
      throw new \Exception('A controller class was not specified');
    }

    if (class_exists($classString)) {
      // creating new controller object dynamically and injecting the database 
      $controllerObject = new $classString(App::get('database'));
      if (isset($actions['action'])) {
        if (method_exists($controllerObject, $actions['action'])) {
          self::callControllerMethod($requestURL, $controllerObject, $actions['action']);
        } else {
          throw new \Exception("Invalid Controller Action: does not exists"); 
        }
      } else {
        throw new \Exception("A controller action method was not specified"); 
      }
    } else {
      throw new \Exception("The Controller class $classString does not exists"); 
    }
  }

  private static function callControllerMethod($requestURL, $controllerObject, $method) {
    $urlParts = self::getURLParts($requestURL);
    
    // if the urlParts > 2 it means that it is a complex url: /customers/2
    if (count($urlParts) > 2) {
      $entity = $urlParts[1];
      $variable = $urlParts[2];
      // calling Controller method with parameters
      $controllerObject->{$method}($variable); 
    } else {
      $controllerObject->{$method}(); 
    }
  }

  private static function getURLParts($url) {
    $urlParts = explode('/', $url);
    return $urlParts;
  }  
}
