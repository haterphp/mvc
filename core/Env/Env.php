<?php

namespace Core\Env;

use Core\Env\Src\Interfaces\EnvInterface;

class Env implements EnvInterface {

    protected $filepath;

    public static function createInstance($filepath)
    {
        $_this = (new self);
        $_this->filepath = $filepath;
        return $_this;
    }

    public function load()
    {
        $tmp = collect(file($this->filepath));
        $tmp->each(function ($item) {
            $item = trim($item);
            if(!empty($item)){
                putenv($item);
            }
        });
    }
}