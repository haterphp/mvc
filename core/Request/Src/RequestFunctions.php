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

    public function only(...$args)
    {
        return $this->body->only($args)->toArray();
    }
}