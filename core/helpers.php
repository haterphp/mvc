<?php

define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT']);
define('PUBLIC_PATH', ROOT_PATH . '/public');

function dd(...$data){
    echo "<pre>" . var_dump($data) ."</pre>";
    die();
}

function collect($array){
    return new Core\Collection\Collection($array);
}

function env($filepath){
    $env = \Core\Env\Env::createInstance($filepath);
    $env->load();
    return $env;
}

