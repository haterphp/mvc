<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Core\Request\Request;

class NewsController extends Controller{

    public function index()
    {
        return view('home');
    }
}