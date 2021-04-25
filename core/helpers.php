<?php

use App\Models\Role;
use Core\Auth\Auth;
use Core\Session\SessionFlash;

define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT']);
define('HOST_URI', $_SERVER['HTTP_HOST']);
define('PUBLIC_PATH', ROOT_PATH . '/public');

function dd($data){
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die();
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function collect($array){
    return new Core\Collection\Collection($array);
}

function auth(){
    return Auth::init();
}

function can($ability){
    if(!Auth::check()) return false;
    $user = auth()->user();
    $role = Role::query()->where(['id' => $user['role_id']])->first();
    return $role['name'] === $ability;
}

function route($name, $params = null){
    global $app;
    $route = $app->router()->getRoutes()->search('name', $name)->first();

    if(!$route) throw new Exception("Route $name not round");

    $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';
    
    $query = "";
    if($params){
        $query = "?";
        $params = collect($params)->keys()->map(function($key) use($params){
            return $key . '=' . $params[$key];
        })->toArray();
        $query .= implode('&', $params);
    }

    $url = $route->url;
    if($route->url === "/") $url = "";
    
    return $protocol . HOST_URI  . \Core\Router\Router::$prefix . $url . $query ?? '';
}

function redirect($url){
    header('Location: '. $url);
    return (new SessionFlash);
}

function session($name){
    $session = SessionFlash::get($name);
    SessionFlash::clear($name);
    return $session;
}

function view($template, $body = []){
    $loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH . '/views');
    $twig = new \Twig\Environment($loader, [
        'debug' => true
    ]);

    $route_func = new \Twig\TwigFunction('route', function ($name, $params = null){
        return route($name, $params);
    });

    $session_func = new \Twig\TwigFunction('session', function ($name){
        return session($name);
    });

    $auth_func = new \Twig\TwigFunction('auth', function (){
        return auth();
    });

    $can_func = new \Twig\TwigFunction('can', function ($ability){
        return can($ability);
    });

    $storage_func = new \Twig\TwigFunction('storage', function($path){
        $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === 0 ? 'https://' : 'http://';
        return $protocol . HOST_URI  . '/storage/' . $path;
    });

    $twig->addFunction($route_func);
    $twig->addFunction($session_func);
    $twig->addFunction($auth_func);
    $twig->addFunction($can_func);
    $twig->addFunction($storage_func);

    $twig->addExtension(new \Twig\Extension\DebugExtension());
    $temp = $twig->load($template . '.html');

    return $temp->render($body);
}
