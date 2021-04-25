<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Core\Request\Request;

class UserController extends Controller{
    
    public function index()
    {
        $users = User::query()->where(['role_id' => 2])->get();
        return view('dashboard/users/index', compact('users'));
    }

    public function ban(Request $request)
    {
        $id = $request->get('user');
        $user = User::query()->where(compact('id'))->first();

        User::query()->where(compact('id'))->update([
            'is_banned' => (int) !$user['is_banned']
        ]);

        return redirect(route('dashboard.users'))->with('alert', [
            'status' => 'success',
            'message' => 'Статус успешно изменен'
        ]);
    }
}