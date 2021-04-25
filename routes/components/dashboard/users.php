<?php

use App\Http\Controllers\Dashboard\UserController;
use Core\Router\Router;

Router::get('dashboard/users', [UserController::class, 'index'])
    ->name('dashboard.users')
    ->middleware('auth', 'can:admin');

Router::get('dashboard/users/ban', [UserController::class, 'ban'])
    ->name('dashboard.users.ban')
    ->middleware('auth', 'can:admin');