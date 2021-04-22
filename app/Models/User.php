<?php

namespace App\Models;

use Core\Model\Model;

class User extends Model{
    
    public $table = 'users';
    
    protected $fillable = [
        'username',
        'email',
        'password',
        'role_id'
    ];
}