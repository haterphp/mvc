<?php

namespace Core\Router;

use Core\Request\Request;
use Core\Router\Src\BaseRouter;
use Core\Router\Src\Interfaces\RouterInterface;
use Core\Router\Src\Traits\RouterHttpMethods;

class Router extends BaseRouter implements RouterInterface {

    use RouterHttpMethods;

    public static $routes;
    public static $prefix = "";

    public static function prefix($value)
    {
        self::$prefix = $value;
    }

    public static function init()
    {
        self::$routes = collect([]);
        return (new self);
    }

    public function start()
    {
        $routes = $this->getRoutes();
        
        $path = explode('?', $_SERVER['REQUEST_URI'])[0];
        $path = str_replace(Router::$prefix, '', $path);
        if($path === "") $path = "/";

        $routes = $routes->search('url', $path);
        if(!$routes->count()) throw new \Exception("Route $path not found");
        
        $route = $routes->search('method', $_SERVER['REQUEST_METHOD']);
        if(!$route->count()) throw new \Exception("Not supported method. Supported methods: " . $routes->first()->method);
        
        $route = $route->first();

        if(!$this->startMiddlewares($route)) throw new \Exception('Request not authorized');
        if(isset($route->handler)) echo call_user_func($route->handler, new Request());
        else echo call_user_func([new $route->controller, $route->action], new Request());
    }

    public function startMiddlewares($route)
    {
        global $app;
        if(!isset($route->middlewares)) return true;
        $middlewares = $app->configs()['middlewares'];
        foreach($route->middlewares as $middleware){
            $args = explode(':', $middleware);
            if(!$middlewares[$args[0]]::run($route, $args, new Request())) return false;
        }
        return true;
    }

    public function getRoutes()
    {
        return Router::$routes;
    }
}