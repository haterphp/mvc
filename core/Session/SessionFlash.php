<?php

namespace Core\Session;

use Core\Session\Src\Interfaces\SessionInterface;

class SessionFlash implements SessionInterface{

    public function __construct() {
        $_SESSION['flash'] = [];
    }

    public function with($name, $body)
    {
        SessionFlash::set($name, $body);
    }

    public static function set($name, $value)
    {
        $_SESSION['flash'][$name] = $value;
    }

    public static function get($name)
    {
        return isset($_SESSION['flash'][$name]) ? $_SESSION['flash'][$name] : null;
    }

    public static function clear($name)
    {
        unset($_SESSION['flash'][$name]);
    }
}