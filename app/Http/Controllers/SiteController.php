<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Core\Request\Request;

class SiteController extends Controller{

    public function index()
    {
        $projects = Project::all(); 
        $projects = collect($projects)->map(function(&$item){
            $links = Project::links($item['id']);
            $item['links'] = collect($links)->map(function($link) {
                return $link['link'];
            })->toArray();
            return $item;
        })->toArray();
        return view('home', compact('projects'));
    }
}