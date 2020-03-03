<?php

include __DIR__ . '/vendor/autoload.php';       // for autoloading files

ini_set('display_errors', config('app.debug'));     //display errors

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $router) {
    $namespace = "\\App\\Controllers\\";
    $router->get('/', $namespace . 'SignupController@showSignUpForm');  //adding routes to dispatche
    $router->post('/', $namespace . 'SignupController@saveToJson');

});

// Fetch method and URI from somewhere

$httpMethod = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];      // checking for request method
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        [$controller, $method] = explode('@', $handler);
        (new $controller)->$method($vars);
        break;
}