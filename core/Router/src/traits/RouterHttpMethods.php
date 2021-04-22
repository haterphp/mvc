<?php

namespace Core\Router\Src\Traits;

trait RouterHttpMethods{
    public function methodBind(&$route)
    {
        $this->current_route = $route;
    }

    public static function methodPush($method, $url, $handler)
    {
        if(gettype($handler) === 'object') {
            $route = compact('url', 'handler', 'method');
            static::$routes->push($route);
            return true;
        }
        if(count($handler) !== 2) throw new \Exception('Invalid arguments');
        [ $controller, $action ] = $handler;
        $route = compact('url', 'controller', 'action' , 'method');
        static::$routes->push($route);
    }

    public static function get($url, $handler)
    {
        self::methodPush('GET', $url, $handler);
        return (new static)->methodBind($route);
    }

    public static function post($url, $handler)
    {
        self::methodPush('POST', $url, $handler);
        return (new static)->methodBind($route);
    }

    public static function put($url, $handler)
    {
        self::methodPush('PUT', $url, $handler);
        return (new static)->methodBind($route);
    }

    public static function delete($url, $handler)
    {
        self::methodPush('DELETE', $url, $handler);
        return (new static)->methodBind($route);
    }
}