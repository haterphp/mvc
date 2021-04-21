<?php

namespace Core\App;

use Core\App\Src\BaseApp;

class App extends BaseApp {

    protected function getConfigs(){
        env(ROOT_PATH . '/.env');
        $this->configs = require ROOT_PATH . '/configs/app.php';
    }
}