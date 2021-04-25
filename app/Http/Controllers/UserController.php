<?php

namespace App\Http\Controllers;

use App\Models\User;
use Core\Auth\Auth;
use Core\Request\Request;
use Core\Validator\Validator;

class UserController extends Controller {

    public function login()
    {
        return view('auth/login');
    }

    public function update(Request $request)
    {
        if(!User::login($request->only('email', 'password'))){
            return redirect(route('login'))->with('alert', [
                'status' => 'danger',
                'message' => 'Не верный логин или пароль'
            ]);
        }
        return redirect(route('home'));
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
            'password' => password_hash($request->get('password'), PASSWORD_DEFAULT),
            'role_id' => 2,
        ]);

        User::login($request->only('email', 'password'));

        return redirect(route('home'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('home'));
    }
}