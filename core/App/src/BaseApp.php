<?php

namespace Core\App\Src;

use Core\App\Src\Interfaces\AppInterface;
use Core\Router\Router;

abstract class BaseApp implements AppInterface {

    protected $router;
    protected $configs;

    public function __construct()
    {
        $this->getConfigs();
        $this->router = Router::init();
    }

    public function router()
    {
        return $this->router;
    }

    public function configs()
    {
        return $this->configs;
    }

    public function auth()
    {
        // code here...
    }

    abstract protected function getConfigs();
}