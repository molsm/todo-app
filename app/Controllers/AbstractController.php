<?php declare(strict_types = 1);

namespace Todo\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Todo\Contracts\ViewInterface;
use Todo\Services\View;
use Zend\Diactoros\Response\JsonResponse;

abstract class AbstractController
{
    protected $request;
    protected $response;

    /**
     * @var View
     */
    protected $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function proceed(ServerRequestInterface $request, ResponseInterface $response)
    {
        $this->request = $request;
        $this->response = $response;

        $result = $this->execute();

        if ($result instanceof JsonResponse) {
            return $result;
        }

        $this->response->getBody()->write($result);

        return $this->response;
    }

    /**
     * @return mixed
     */
    abstract public function execute();
}