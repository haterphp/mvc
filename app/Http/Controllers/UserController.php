<?php

namespace App\Http\Controllers;

use App\Models\User;
use Core\Request\Request;
use Core\Validator\Validator;

class UserController extends Controller {

    public function login()
    {
        return view('auth/login');
    }

    public function update(Request $request): void
    {

        dd($request->all());
    }

    public function create()
    {
        return view('auth/register');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required'],
        ]);
        
        if($validator->fails()){
            return redirect(route('register'))->with('errors', $validator->errors());
        }

        User::create([
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'password' => md5($request->get('password')),
            'role_id' => 2,
        ]);

        return redirect(route('home'));
    }
}