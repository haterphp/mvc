<?php

namespace Core\Model\Src\Traits;

use Core\Model\Src\DB;

trait ModelFunctions{

    protected $rows = [];

    public static function query(){
        return (new static);
    }

    public function where($args){
        $this->rows = DB::select($this->table, self::bodySelectFormatter(array_keys($args)), $args);
        return $this;
    }

    public static function all()
    {
        $rows = DB::select((new static)->table);
        return $rows;
    }

    public function get(){
        return $this->rows;
    }

    public function first(){
        return $this->rows[array_key_first($this->rows)];
    }

    protected static function bodySelectFormatter($args){
        $set = 'WHERE ';
        if(!count($args)) return "";
        foreach ($args as $arg) {
            $set.="`".str_replace("`","``",$arg)."`". "=:$arg, ";
        }
        return substr($set, 0, -2);
    }

    protected static function bodyInsertFormatter($allowed, &$values, $source = array()){
        $set = '';
        $values = array();
        if (!$source) $source = &$_POST;
        foreach ($allowed as $field) {
            if (isset($source[$field])) {
                $set.="`".str_replace("`","``",$field)."`". "=:$field, ";
                $values[$field] = $source[$field];
            }
        }
        return substr($set, 0, -2);
    }

    public static function create($body){
        $insert_body = [];
        $id = DB::insert((new static)->table, self::bodyInsertFormatter((new static)->fillable, $insert_body, $body), $insert_body);
        $body['id'] = $id;
        return $body;
    }

    public function update($body){
        $insert_body = [];
        DB::update($this->rows[0]['id'], (new static)->table, self::bodyInsertFormatter((new static)->fillable, $insert_body, $body), $insert_body);
        return $this->where(['id' => $this->rows[0]['id']])->first();
    }

    public function delete()
    {
        DB::destroy($this->rows[0]['id'], (new static)->table);
        return true;
    }
}