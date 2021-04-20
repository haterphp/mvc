<?php

namespace Core\Router\Src\Interfaces;

interface RouterInterface{

    public static function get($url, $handler);
    public static function post($url, $handler);
    public static function put($url, $handler);
    public static function delete($url, $handler);

    public function name($name);
    public function middleware(...$middleware);

}