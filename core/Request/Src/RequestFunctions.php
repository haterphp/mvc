<?php

namespace Core\Request\Src;

trait RequestFunctions {
    public function all()
    {
        return $this->body->toArray();
    }

    public function get($field)
    {
        return $this->body->get($field);
    }
}