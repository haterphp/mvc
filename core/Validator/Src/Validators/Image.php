<?php

namespace Core\Validator\Src\Validators;

use Core\Validator\Src\AbstractValidator;
use Core\Validator\Src\Interfaces\ValidatorInterface;

class Image extends AbstractValidator implements ValidatorInterface{
    
    public $message = "Field :field must be image";
    protected $message_keys = [];

    public function rule($args, $value)
    {
        $allow = ['jpg', 'jpeg', 'png', 'gif'];
       
        $pattern = "[^a-zа-яё0-9,~!@#%^-_\$\?\(\)\{\}\[\]\.]";
        $name = mb_eregi_replace($pattern, '-', $value['name']);
        $name = mb_ereg_replace('[-]+', '-', $name);
        $parts = pathinfo($name);

        if(!in_array($parts['extension'], $allow)) return false;
        return true;
    }

    public function messageAssociation($args, $value)
    {
        $this->message_keys = [
            ":value" => $value,
            ":field" => $this->field
        ];
    }
}