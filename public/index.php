<?php

require __DIR__ . "/../vendor/autoload.php";

use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

// CONSTANTS
require __DIR__ . '/../app/helpers/config.php';
// ROUTES
require __DIR__ . '/../app/routes/routes.php';

$app->run();