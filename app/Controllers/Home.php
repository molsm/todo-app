<?php declare(strict_types = 1);

namespace Todo\Controllers;

use Todo\Controllers\AbstractController;

class Home extends AbstractController
{
    public function execute()
    {
        return $this->view->render('index.twig', ['test' => 123]);
    }
}