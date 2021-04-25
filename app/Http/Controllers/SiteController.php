<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\News;
use App\Models\Project;
use App\Models\Role;
use App\Models\User;
use Core\Auth\Auth;
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

        $newses = array_slice(array_reverse(News::all()), 0, 6);

        return view('home', compact('projects', 'newses'));
    }

    public function news(Request $request)
    {
        $id = $request->get('news');
        $news = News::query()->where(compact('id'))->first();
        $query = Comment::query();

        $orderWithAbility = [
            'admin' => [
                'news_id' => $id
            ],
            'user' => [
                'news_id' => $id,
                'is_blocked' => 0
            ],
            'other' => [
                'news_id' => $id,
                'is_blocked' => 0
            ]
        ];

        $user = Auth::init()->user();
        $ability = $user ? Role::query()->where(['id' => $user['role_id']])->first()['name'] : 'other';
        $comments = $query->where($orderWithAbility[$ability])->get();
        
        $comments = collect(array_reverse($comments))->map(function($comment){
            $comment['user'] = User::query()->where(['id' => $comment['user_id']])->first();
            return $comment;
        })->toArray();

        return view('news', compact('news', 'comments'));
    }
}