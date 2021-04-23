<?php

namespace App\Http\Middlewares;

use App\Models\Role;
use Core\Auth\Auth;

class CanMiddleware{
    
    public static function run($route, $args, $request)
    {

        $can = $args[1];
        $user = Auth::init()->user();
        $role = Role::query()->where(['id' => $user['role_id']])->first();
        return $role['name'] === $can;
    }
}