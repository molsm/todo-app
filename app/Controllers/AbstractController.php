<?php declare(strict_types = 1);

namespace Todo\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Todo\Services\Database;
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

    /**
     * @var Database
     */
    protected $database;

    public function __construct(View $view, Database $database)
    {
        $this->view = $view;
        $this->database = $database;
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