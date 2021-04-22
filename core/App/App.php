<?php

namespace Core\App;

use Core\App\Src\BaseApp;

class App extends BaseApp {

    protected function getConfigs(){
        $this->configs = require ROOT_PATH . '/configs/app.php';
    }
}