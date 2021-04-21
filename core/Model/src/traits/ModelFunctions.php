<?php

namespace Core\Model\Src\Traits;

use Core\Model\Src\DB;

trait ModelFunctions{

    protected $row = [];

    public static function query(){
        return (new static);
    }

    public function where($args){
        $this->row = DB::select($this->table, self::bodySelectFormatter(array_keys($args)), $args);
        return $this;
    }

    public function get(){
        return $this->row;
    }

    public function first(){
        return $this->row[array_key_first($this->row)];
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
        $insert_body['id'] = $this->row[0]['id'];
        DB::insert((new static)->table, self::bodyInsertFormatter((new static)->fillable, $insert_body, $body), $insert_body);
        return true;
    }
}