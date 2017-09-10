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

        foreach ($routes as $routeData) {
            $route = new \StdClass;
            $route->httpMethod = $routeData[0];
            $route->path = $routeData[1];
            $route->subject = $routeData[2] . '::proceed';

            $this->map($route);
        }
    }

    public function register()
    {
        // Todo
    }

    protected function map(\StdClass $route)
    {
        $this->getContainer()
            ->get('route')->map($route->httpMethod, $route->path, $route->subject);
    }
}