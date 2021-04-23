<?php

namespace App\Http\Middlewares;

use Core\Auth\Auth;

class AuthMiddleware{
    
    public static function run($route, $middleware, $request)
    {
        return Auth::check();
    }
}