<?php

namespace Core\App;

use Core\App\Src\BaseApp;

class App extends BaseApp {

    protected function getConfigs(){
        $ENV = env(ROOT_PATH . '/.env');
        dd($ENV->qwe);
        $this->configs = require ROOT_PATH . '/configs/app.php';
    }
}