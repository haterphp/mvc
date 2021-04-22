<?php

define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT']);
define('PUBLIC_PATH', ROOT_PATH . '/public');

function dd($data){
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die();
}

function collect($array){
    return new Core\Collection\Collection($array);
}


function view($template, $body = []){
    $loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH . '/views');
    $twig = new \Twig\Environment($loader);

    $temp = $twig->load($template . '.html');

    return $temp->render($body);
}
