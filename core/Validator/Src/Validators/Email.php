<?php

namespace Core\Validator\Src\Validators;

use Core\Validator\Src\AbstractValidator;
use Core\Validator\Src\Interfaces\ValidatorInterface;

class Email extends AbstractValidator implements ValidatorInterface{
    
    public $message = "Field :field contains wrong symbols";
    protected $message_keys = [];

    public function rule($args, $value)
    {
        return (new Regex)->rule(["/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/"], $value);
    }

    public function messageAssociation($args, $value)
    {
        $this->message_keys = [
            ":value" => $value,
            ":field" => $this->field
        ];
    }
}