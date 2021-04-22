<?php

namespace Core\Validator\Src\Validators;

use Core\Validator\Src\AbstractValidator;
use Core\Validator\Src\Interfaces\ValidatorInterface;

class Required extends AbstractValidator implements ValidatorInterface{
    
    public $message = "Field :field is required";
    protected $message_keys = [];

    public function rule($args, $value)
    {
        return $value !== "";
    }

    public function messageAssociation($args, $value)
    {
        $this->message_keys = [
            ":value" => $value,
            ":field" => $this->field
        ];
    }
}