<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once '../vendor/autoload.php';
require_once '../core/helpers.php';

// Init App and start router
$app = new \Core\App\App();
$app->router()->start();

return $app;