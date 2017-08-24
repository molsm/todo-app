<?php declare(strict_types = 1);

namespace Todo;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Application
{
    private $container;

    private $route;

    private $root;

    public function __construct($root)
    {
        $this->root = $root;
        $this->container = new \League\Container\Container;
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

    }

    public function run()
    {
        $this->route->map('GET', '/', function (ServerRequestInterface $request, ResponseInterface $response) {
            $response->getBody()->write('<h1>Hello, World!</h1>');

            return $response;
        });

        $this->route->map('GET', '/a', function (ServerRequestInterface $request, ResponseInterface $response) {
            $response->getBody()->write('<h1>Lol!</h1>');

            return $response;
        });

        $this->route->map('GET', '/ab', 'Todo\Controllers\AcmeController::someMethod');

        $response = $this->route->dispatch($this->container->get('request'), $this->container->get('response'));
        $this->container->get('emitter')->emit($response);
    }
}