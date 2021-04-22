<?php

namespace App\Providers;

use Core\Router\Router;

class RouteProvider{
    public static function boot()
    {
        Router::prefix('/public/');
    }
}