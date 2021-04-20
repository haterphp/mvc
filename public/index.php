<?php

require_once '../vendor/autoload.php';
require_once '../core/helpers.php';

// Init App and start router
$app = new \Core\App\App();
$app->router()->start();

return $app;