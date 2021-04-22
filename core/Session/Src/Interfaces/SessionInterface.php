<?php

namespace Core\Session\Src\Interfaces;

interface SessionInterface{
    public static function get($name);
    public static function set($name, $value);
    public static function clear($name);
}