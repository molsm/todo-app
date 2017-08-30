<?php

namespace Todo\Services;

use Todo\Contracts\ViewInterface;
use Zend\Diactoros\Response\JsonResponse;

class View implements ViewInterface
{
    protected $twig;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function render($file, $data = [])
    {
        return $this->twig->render($file, $data);
    }

    public function json($data)
    {
        return new JsonResponse($data);
    }
}