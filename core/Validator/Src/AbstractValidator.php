<?php

namespace Core\Validator\Src;

abstract class AbstractValidator {
    public $message;
    protected $field = null;
    protected $message_keys = [];

    public static function init()
    {
        return (new static);
    }

    public function validate($value, $args = [], $message = null)
    {
        $this->messageAssociation($args, $value);
        if(!$this->rule($args, $value)) 
            return $this->messageFormmater($this->message($message));
        return true;
    }

    private function messageFormmater($message)
    {
        foreach($this->message_keys as $key => $value){
            $message = str_replace($key, $value, $message);
        }
        return $message;
    }

    public function message($message)
    {
        return $message ?? $this->message;
    }

    public function field($field)
    {
        $this->field = $field;
    }
}