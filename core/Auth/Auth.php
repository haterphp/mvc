<?php

namespace Core\Auth;

use Core\Model\Src\DB;
use Core\Session\Session;

class Auth{

    protected $username = 'email';
    protected $password = 'password';

    public static function attempt($credentials)
    {
        global $app;
        $_this = (new self);
        $username = $_this->username;
        $password = $_this->password;

        $model = $app->configs()['auth']['model'];
        $other = collect($credentials)->except($username, $password);
        $user = $model::query()->where($other->toArray() + [$username => $credentials[$username]])->first();

        if(!$user or !password_verify($credentials['password'], $user['password'])) return false;
        Session::set('id', $user['id']);
        return true;
    }

    public static function init()
    {
        return (new self);
    }

    public function is_auth()
    {
        return Auth::check();
    }

    public function user()
    {
        global $app;
        $id = Session::get('id');
        $model = $app->configs()['auth']['model'];
        return $model::query()->where(['id' => $id])->first() ?? null;
    }

    public static function check()
    {
        global $app;
        $id = Session::get('id');
        if($id === null) return false;
        $model = $app->configs()['auth']['model'];
        return $model::query()->where(['id' => $id])->count();
    }

    public static function logout()
    {
        Session::clear('id');
        return true;
    }
}