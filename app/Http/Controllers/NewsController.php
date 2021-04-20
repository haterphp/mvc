<?php

namespace App\Http\Controllers;

use Core\Request\Request;

class NewsController extends Controller{
    public function index()
    {
        return view('home');
    }
}