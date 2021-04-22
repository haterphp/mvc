<?php

use \Core\Router\Router;
use \App\Http\Controllers\NewsController;
use \App\Http\Controllers\UserController;

Router::get('/', [NewsController::class, 'index'])->name('home');

Router::get('login', [UserController::class, 'login'])->name('login');
Router::post('login', [UserController::class, 'update'])->name('login.store');

Router::get('register', [UserController::class, 'create'])->name('register');
Router::post('register', [UserController::class, 'store'])->name('register.store');
