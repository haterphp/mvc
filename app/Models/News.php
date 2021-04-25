<?php

namespace App\Models;

use Core\Model\Model;

class News extends Model{
    public $table = "newses";
    protected $fillable = [
        'title', 
        'description', 
        'image'
    ];
}