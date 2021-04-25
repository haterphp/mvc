<?php

use Core\Router\Router;
use \App\Http\Controllers\Dashboard\ProjectController;

Router::get('dashboard/projects', [ProjectController::class, 'index'])
    ->name('dashboard.projects')
    ->middleware('auth', 'can:admin');

Router::get('dashboard/projects/create', [ProjectController::class, 'create'])
    ->name('dashboard.projects.create')
    ->middleware('auth', 'can:admin');

Router::post('dashboard/projects', [ProjectController::class, 'store'])
    ->name('dashboard.projects.store')
    ->middleware('auth', 'can:admin');

Router::get('dashboard/projects/delete', [ProjectController::class, 'delete'])
    ->name('dashboard.projects.delete')
    ->middleware('auth', 'can:admin');

Router::get('dashboard/projects/edit', [ProjectController::class, 'edit'])
    ->name('dashboard.projects.edit')
    ->middleware('auth', 'can:admin');

Router::post('dashboard/projects/edit', [ProjectController::class, 'update'])
    ->name('dashboard.projects.update')
    ->middleware('auth', 'can:admin');