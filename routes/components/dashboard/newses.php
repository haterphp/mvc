<?php

use Core\Router\Router;
use \App\Http\Controllers\Dashboard\NewsController;

Router::get('dashboard/newses', [NewsController::class, 'index'])
    ->name('dashboard.newses')
    ->middleware('auth', 'can:admin');

Router::get('dashboard/newses/create', [NewsController::class, 'create'])
    ->name('dashboard.newses.create')
    ->middleware('auth', 'can:admin');

Router::post('dashboard/newses', [NewsController::class, 'store'])
    ->name('dashboard.newses.store')
    ->middleware('auth', 'can:admin');

Router::get('dashboard/newses/delete', [NewsController::class, 'delete'])
    ->name('dashboard.newses.delete')
    ->middleware('auth', 'can:admin');

Router::get('dashboard/newses/edit', [NewsController::class, 'edit'])
    ->name('dashboard.newses.edit')
    ->middleware('auth', 'can:admin');

Router::post('dashboard/newses/edit', [NewsController::class, 'update'])
    ->name('dashboard.newses.update')
    ->middleware('auth', 'can:admin');