<?php

namespace Core\Env\Src\Interfaces;

interface EnvInterface {
    public static function createInstance($path);
    public function load();
}