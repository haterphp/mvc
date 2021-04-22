<?php

namespace App\Models;

use Core\Model\Model;

class ProjectLink extends Model{
    public $table = 'project_links';
    protected $fillable = [
        'project_id',
        'link'
    ];
}