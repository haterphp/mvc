<?php

namespace Core\Router\Src;

use Core\Router\Router;
use Core\Router\Src\Interfaces\RouterInterface;
use Core\Router\Src\Traits\RouterHttpMethods;
use mysql_xdevapi\Exception;

class BaseRouter {

    public $current_route = null;

    public function name($name)
    {
        $routes = &Router::$routes;
        $route = $routes->search('url', $this->current_route['url'])->search('method', $this->current_route['method'])->first();
        $route->name = $name;
        return $this;
    }

    public function middleware(...$middlewares)
    {
        $routes = &Router::$routes;
        $route = $routes->search('url', $this->current_route['url'])->search('method', $this->current_route['method'])->first();
        $route->middlewares = $middlewares;
        return $this;
    }
}