<?php

namespace Todo\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AcmeController
{
    protected $baz;

    public function __construct(\Todo\Controllers\Baz $baz)
    {
        $this->baz = $baz;
    }

    public function someMethod(ServerRequestInterface $request, ResponseInterface $response)
    {
        $response->getBody()->write($this->baz->test());

        return $response;
    }
}