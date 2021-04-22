<?php

namespace Core\Validator;

class Validator {

    private static $validators = [];
    protected $errors = [];

    public static function init()
    {
        self::$validators = require ROOT_PATH . '/configs/validators.php';
        return (new self);
    }

    public static function make($body, $rules, $messages = [])
    {
        $_this = self::init();

        foreach($rules as $name => $field){
            foreach($field as $rule) {
                if(isset($_this->errors[$name])) continue;
                $tmp = explode(':', $rule);
                
                $rule_name = $tmp[0];
                $args = isset($tmp[1]) ? explode(',', $tmp[1]) : [];

                $validator = self::$validators[$rule_name] ?? null;
                if(!$validator) continue;

                $validator = $validator::init();
                $validator->field($name);
                $result = $validator->validate($body[$name] ?? null, $args, $messages[$rule_name] ?? null);
                
                if($result !== true) $_this->errors[$name] = $result;
            }
        }

        return $_this;
    }

    public function fails()
    {
        return count($this->errors) ? 1 : 0;
    }

    public function errors()
    {
        return $this->errors;
    }
}