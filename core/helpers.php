<?php

define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT']);
define('HOST_URI', $_SERVER['HTTP_HOST']);
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

function route($name){
    global $app;
    $route = $app->router()->getRoutes()->search('name', $name)->first();
    $url = $route->url;
    if($route->url === "/") $url = "";
    return HOST_URI  . \Core\Router\Router::$prefix . '/' . $url ?? '';
}

function view($template, $body = []){
    $loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH . '/views');
    $twig = new \Twig\Environment($loader);

    $function = new \Twig\TwigFunction('route', function ($name){
        return route($name);
    });

    $twig->addFunction($function);
    $temp = $twig->load($template . '.html');

    return $temp->render($body);
}
