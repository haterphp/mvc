<?php

use App\Http\Controllers\CommentController;
use \Core\Router\Router;
use \App\Http\Controllers\SiteController;
use \App\Http\Controllers\UserController;

Router::get('/', [SiteController::class, 'index'])->name('home');

Router::get('login', [UserController::class, 'login'])->name('login');
Router::post('login', [UserController::class, 'update'])->name('login.store');

Router::get('register', [UserController::class, 'create'])->name('register');
Router::post('register', [UserController::class, 'store'])->name('register.store');

Router::get('logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');

Router::get('news', [SiteController::class, 'news'])->name('news.show');

Router::post('comment', [CommentController::class, 'store'])->name('comment.store')->middleware('auth');
Router::get('comment/ban', [CommentController::class, 'ban'])->name('comment.ban')->middleware('auth', 'can:admin');