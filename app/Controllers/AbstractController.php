<?php declare(strict_types = 1);

namespace Todo\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

abstract class AbstractController
{
    protected $request;
    protected $response;

    public function proceed(ServerRequestInterface $request, ResponseInterface $response)
    {
        $this->request = $request;
        $this->response = $response;

        $this->response->getBody()->write($this->execute());

        return $this->response;
    }

    abstract public function execute();
}