<?php

use Core\Session\Session;

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
    
    $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';

    $url = $route->url;
    if($route->url === "/") $url = "";
    
    return $protocol . HOST_URI  . \Core\Router\Router::$prefix . $url ?? '';
}

function redirect($url){
    header('Location: '. $url);
    return (new Session);
}

function session($name){
    $session = Session::get($name);
    Session::clear($name);
    return $session;
}

function view($template, $body = []){
    $loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH . '/views');
    $twig = new \Twig\Environment($loader, [
        'debug' => true
    ]);

    $route_func = new \Twig\TwigFunction('route', function ($name){
        return route($name);
    });

    $session_func = new \Twig\TwigFunction('session', function ($name){
        return session($name);
    });

    $twig->addFunction($route_func);
    $twig->addFunction($session_func);
    $twig->addExtension(new \Twig\Extension\DebugExtension());
    $temp = $twig->load($template . '.html');

    return $temp->render($body);
}
