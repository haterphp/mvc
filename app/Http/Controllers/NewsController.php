<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Core\Request\Request;

class NewsController extends Controller{

    public function index()
    {
        Project::query()
            ->where(['id' => 26])
            ->update(['title' => 'new project']);
        return view('home');
    }
}