<?php declare(strict_types = 1);

namespace Todo;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Application
{
    private $container;

    private $route;

    public function __construct($root)
    {
        $this->container = new \League\Container\Container;
        $this->container->add('basePath', $root);
        $this->container->delegate(
            new \League\Container\ReflectionContainer
        );

        $this->container->share('response', \Zend\Diactoros\Response::class);
        $this->container->share('request', function () {
            return \Zend\Diactoros\ServerRequestFactory::fromGlobals(
                $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
            );
        });

        $this->container->share('emitter', \Zend\Diactoros\Response\SapiEmitter::class);

        $this->route = new \League\Route\RouteCollection($this->container);
        $this->container->share('route', $this->route);

        $mainConfig = require $root . '/../config/app.php';
        $this->container->add('config', $mainConfig);

        foreach ($mainConfig['providers'] as $provider) {
            $this->container->addServiceProvider($provider);
        }
    }

    public function run()
    {
        $response = $this->route->dispatch($this->container->get('request'), $this->container->get('response'));
        $this->container->get('emitter')->emit($response);
    }
}