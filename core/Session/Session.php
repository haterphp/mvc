<?php

namespace Core\Session;

class Session{
    public function __construct() {
        $_SESSION['flash'] = [];
    }

    public function with($name, $body)
    {
        $_SESSION['flash'][$name] = $body;
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