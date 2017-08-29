<?php declare(strict_types = 1);

namespace Todo\Provider;

use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class RouterServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    protected $provides = [];

    public function boot()
    {
        $routes = require $this->getContainer()->get('basePath') . '/../config/routes.php';

        foreach ($routes as $routeData) {
            $route = new \StdClass;
            $route->method = $routeData[0];

            $this->getContainer()->get('route')->map($route);
        }
    }

    public function register()
    {
        $this->getContainer();
    }

    protected function map(\StdClass $route)
    {
        $this->getContainer()->get('route')->map($route[0], [1], function (ServerRequestInterface $request, ResponseInterface $response) {



            $response->getBody()->write('<h1>Hello, World!</h1>');
            return $response;
        });
    }
}