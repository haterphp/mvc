<?php

namespace App\Models;

use Core\Model\Model;

class Project extends Model{
    public $table = 'projects';
    protected $fillable = [
        'title',
        'description',
        'site'
    ];

    public static function links($id)
    {
        return ProjectLink::query()->where(['project_id' => $id])->get();

    }
}