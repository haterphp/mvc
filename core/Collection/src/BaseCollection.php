<?php

namespace Core\Collection\Src;

use Core\Collection\Src\Traits\BaseArrayMethods;
use Core\Collection\Src\Traits\IterableArrayMethods;
use Core\Collection\Src\Traits\TransportArrayMethods;

class BaseCollection {

    use TransportArrayMethods, IterableArrayMethods, BaseArrayMethods;

    protected $array = [];

    public function __construct($array)
    {
        $this->array = $array;
    }
}