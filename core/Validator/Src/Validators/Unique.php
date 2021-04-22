<?php

namespace Core\Validator\Src\Validators;

use Core\Model\Src\DB;
use Core\Validator\Src\AbstractValidator;
use Core\Validator\Src\Interfaces\ValidatorInterface;

class Unique extends AbstractValidator implements ValidatorInterface{
    
    public $message = "Field :field must be unique";
    protected $message_keys = [];

    public function rule($args, $value)
    {
        $query = "WHERE " . $args[1]. "=:" . $args[1];
        $rows = DB::select($args[0], $query, [ $args[1] => $value ]);

        if(count($rows)) {
            if(isset($args[2]) && $rows[0]['id'] == $args[2]) return true;
            return false;
        }
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