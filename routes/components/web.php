<?php

use \Core\Router\Router;
use \App\Http\Controllers\NewsController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\Dashboard\ProjectController as DashboardProjectController;

Router::get('/', [NewsController::class, 'index'])->name('home');

Router::get('login', [UserController::class, 'login'])->name('login');
Router::post('login', [UserController::class, 'update'])->name('login.store');

Router::get('register', [UserController::class, 'create'])->name('register');
Router::post('register', [UserController::class, 'store'])->name('register.store');

Router::get('logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');

Router::get('dashboard/projects', [DashboardProjectController::class, 'index'])->name('dashboard.projects')->middleware('auth', 'can:admin');

Router::get('dashboard/projects/create', [DashboardProjectController::class, 'create'])
    ->name('dashboard.projects.create')
    ->middleware('auth', 'can:admin');

Router::post('dashboard/projects', [DashboardProjectController::class, 'store'])
    ->name('dashboard.projects.store')
    ->middleware('auth', 'can:admin');

Router::get('dashboard/projects/delete', [DashboardProjectController::class, 'delete'])
    ->name('dashboard.projects.delete')
    ->middleware('auth', 'can:admin');

Router::get('dashboard/projects/edit', [DashboardProjectController::class, 'edit'])
    ->name('dashboard.projects.edit')
    ->middleware('auth', 'can:admin');

Router::post('dashboard/projects/edit', [DashboardProjectController::class, 'update'])
    ->name('dashboard.projects.update')
    ->middleware('auth', 'can:admin');