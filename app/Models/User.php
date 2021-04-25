<?php

namespace App\Models;

use Core\Auth\Auth;
use Core\Model\Model;

class User extends Model{
    
    public $table = 'users';
    
    protected $fillable = [
        'username',
        'email',
        'password',
        'role_id',
        'is_banned'
    ];

    public static function login($credits)
    {
        return Auth::attempt($credits);
    }
}