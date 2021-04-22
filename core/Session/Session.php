<?php

namespace Core\Session;

use Core\Session\Src\Interfaces\SessionInterface;

class Session implements SessionInterface{

    public static function set($name, $value): void
    {
        $_SESSION[$name] = $value;
    }

    public static function get($name)
    {
        return isset($_SESSION[$name]) ? $_SESSION[$name] : null;
    }

    public static function clear($name)
    {
        unset($_SESSION[$name]);
    }
}