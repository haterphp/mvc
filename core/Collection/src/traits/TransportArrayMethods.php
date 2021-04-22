<?php

namespace Core\Collection\Src\Traits;

trait TransportArrayMethods{

    public function push($value, $key = null){
        if(gettype($value) === 'array') $value = (object) $value;

        if($key) $this->array[$key] = $value;
        else $this->array[] = $value;

        return $this;
    }

    public function unshift($value)
    {
        array_unshift($this->array, $value);
        return $this;
    }

    public function shift()
    {
        array_shift($this->array);
        return $this;
    }

    public function pop()
    {
        array_pop($this->array);
        return $this;
    }

    public function splice($idx, $length = 1)
    {
        array_splice($idx, $length);
        return $this;
    }
}