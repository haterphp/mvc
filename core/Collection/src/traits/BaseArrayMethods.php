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

    public function only(...$attrs)
    {
        $tmp = collect([]);
        foreach ($attrs as $attr){
            $tmp->push($this->array[$attr]);
        }
        return $tmp;
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
}