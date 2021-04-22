<?php

namespace Core\Validator\Src\Interfaces;

interface ValidatorInterface {
    public function rule($args, $value);
    public function messageAssociation($args, $value);
}