<?php

namespace Core\App\Src;

use App\Providers\RouteProvider;
use Core\App\Src\Interfaces\AppInterface;
use Core\Router\Router;

abstract class BaseApp implements AppInterface {

    protected $router;
    protected $configs;

    public function __construct()
    {
        $this->getConfigs();

        $this->providersStart();

        $this->router = Router::init();
        require ROOT_PATH . '/' . 'routes/index.php';
    }

    public function providersStart()
    {
        require ROOT_PATH . '/' . 'app/Providers/providers.php';
        foreach ($providers as $provider){
            $provider::boot();
        }
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