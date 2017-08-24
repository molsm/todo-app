<?php declare(strict_types = 1);

$appConfig = include_once __DIR__.'/../config/app.php';
$routes = include_once __DIR__.'/../config/routes.php';

$app = new \Todo\Application(__DIR__);
$app->setConfig($appConfig);
$app->setRoutes($routes);

return $app;