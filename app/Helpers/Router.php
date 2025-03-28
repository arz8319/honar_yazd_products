<?php

class Router {
private $routes;

public function __construct($routes) {
$this->routes = $routes;
}

public function dispatch($method, $uri) {
foreach ($this->routes[$method] as $route => $handler) {
$route = str_replace('/', '\/', $route);
if (preg_match("/^{$route}$/", $uri, $matches)) {
array_shift($matches);
return [$handler[0], $handler[1], $matches];
}
}
return null;
}
}