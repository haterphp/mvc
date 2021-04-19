<?php

namespace Core\Collection\Src\Traits;

trait IterableArrayMethods{
    public function each($callback)
    {
        foreach ($this->array as $key => $item) {
            $callback($item, $key);
        }
        return $this;
    }

    public function map($callback)
    {
        return collect(array_map($callback, $this->array));
    }
}