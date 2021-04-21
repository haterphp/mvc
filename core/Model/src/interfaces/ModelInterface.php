<?php

namespace Core\Model\Src\Interfaces;

interface ModelInterface{
    public static function query();
    public function where($args);
    public function get();
    public function first();
    public static function create($body);
    public function update($body);
}