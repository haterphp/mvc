<?php

namespace Core\App\Src;

use App\Providers\RouteProvider;
use Core\App\Src\Interfaces\AppInterface;
use Core\Router\Router;
use Dotenv\Dotenv;

abstract class BaseApp implements AppInterface {

    protected $router;
    protected $configs;

    public function __construct()
    {
        $dotenv = Dotenv::createMutable(ROOT_PATH);
        $dotenv->load();

        $this->getConfigs();

        $this->providersStart();

        $this->router = Router::init();
        require ROOT_PATH . '/' . 'routes/index.php';
    }

    public function providersStart()
    {
        $providers = require ROOT_PATH . '/configs/providers.php';
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