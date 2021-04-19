<?php

namespace Core\Collection\Src\Traits;

trait BaseArrayMethods{
    public function keys()
    {
        return collect(array_keys($this->array));
    }

    public function values()
    {
        return collect(array_values($this->array));
    }

    public function get($key = null)
    {
        if($key) return $this->array[$key] ?? null;
        return $this->array;
    }

    public function first()
    {
        return $this->array[array_key_first($this->array)];
    }
}