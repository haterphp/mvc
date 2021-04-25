<?php

namespace App\Models;

use Core\Model\Model;

class Comment extends Model{
    public $table = 'comments';
    
    protected $fillable = [
        'comment',
        'user_id',
        'news_id',
        'is_blocked'
    ];
}