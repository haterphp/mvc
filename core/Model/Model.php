<?php

namespace Core\Model;

use Core\Model\Src\Interfaces\ModelInterface;
use Core\Model\Src\Traits\ModelFunctions;

class Model implements ModelInterface {
    use ModelFunctions;
    public $table;
    protected $fillable = [];
}