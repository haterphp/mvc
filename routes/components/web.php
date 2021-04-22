<?php

use \Core\Router\Router;
use \App\Http\Controllers\NewsController;
use \App\Http\Controllers\UserController;

Router::get('/', [NewsController::class, 'index'])->name('home');
Router::get('login', [UserController::class, 'login'])->name('login');
