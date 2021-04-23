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

    public function except(...$attrs)
    {
        if(gettype($attrs[0]) === 'array') $attrs = $attrs[0];
        $tmp = $this->array;
        foreach ($attrs as $attr){
            if(!isset($this->array[$attr])) continue;
            unset($tmp[$attr]);
        }
        return collect($tmp);
    }

    public function only(...$attrs)
    {
        if(gettype($attrs[0]) === 'array') $attrs = $attrs[0];
        $tmp = [];
        foreach ($attrs as $attr){
            if(!isset($this->array[$attr])) continue;
            $tmp[$attr] = $this->array[$attr];
        }
        return collect($tmp);
    }

    public function first()
    {
        return $this->array[array_key_first($this->array)];
    }

    public function search($key, $value)
    {
        $tmp = array_keys(array_column($this->array, $key), $value);
        return collect($tmp)->map(function ($idx){
            return $this->array[$idx];
        });
    }

    public function count()
    {
        return count($this->array);
    }

    public function toArray()
    {
        return $this->array;
    }
}