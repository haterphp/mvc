<?php

namespace Core\Router\Src;

use Core\Router\Src\Interfaces\RouterInterface;
use Core\Router\Src\Traits\RouterHttpMethods;
use mysql_xdevapi\Exception;

class BaseRouter {

    public $current_route = null;

    public function name($name)
    {
        $this->current_route->name = $name;
        return $this;
    }

    public function middleware(...$middleware)
    {

    }
}