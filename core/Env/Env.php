<?php

namespace Core\Env;

use Core\Env\Src\Interfaces\EnvInterface;

class Env implements EnvInterface {

    protected $filepath;
    public $variables;

    public function __get($var)
    {
        if(empty($this->variables->get($var))) throw new \Exception('Undefined variable ' . $var . ' references');
        return $this->variables->get($var);
    }

    public static function createInstance($filepath)
    {
        $_this = (new self);
        $_this->filepath = $filepath;
        return $_this;
    }

    public function load()
    {
        $this->variables = collect([]);
        $tmp = collect(file($this->filepath));
        $tmp->each(function ($item) {
            $item = trim($item);
            if(!empty($item)){
                [$key, $value] = explode('=', $item);

                $key = trim($key);
                $value = trim($value);

                if($key !== "") $this->variables->push($value, $key);
            }
        });
    }
}