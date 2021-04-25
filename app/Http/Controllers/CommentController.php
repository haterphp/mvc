<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Core\Auth\Auth;
use Core\Request\Request;

class CommentController extends Controller{

    public function store(Request $request)
    {
        $news_id = $request->get('news');
        $comment = $request->get('comment');
        $user_id = Auth::init()->user()['id'];
        Comment::create(compact('comment', 'user_id', 'news_id'));

        return redirect(route('news.show', ['news' => $news_id]))->with('alert', [
            'status' => 'success',
            'message' => 'Комментарий успешно добавлен'
        ]);
    }

    public function ban(Request $request)
    {
        $id = $request->get('comment');

        Comment::query()->where(compact('id'))->update([
            'is_blocked' => true
        ]);

        return redirect(route('news.show', ['news' => $request->get('news')]))->with('alert', [
            'status' => 'success',
            'message' => 'Комментарий успешно заблокирован'
        ]);
    }
}