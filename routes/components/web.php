<?php

use \Core\Router\Router;
use \App\Http\Controllers\NewsController;

Router::get('/', [NewsController::class, 'index']);