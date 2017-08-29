<?php declare(strict_types = 1);

namespace Todo\Provider;

use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;

class RouterServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    protected $provides = [];

    public function boot()
    {
        $routes = require $this->getContainer()->get('basePath') . '/../config/routes.php';

        foreach ($routes as $route) {
            $this->getContainer()->get('route')->map($route[0], $route[1], $route[2]);
        }
    }

    public function register()
    {
        $this->getContainer();
    }
}