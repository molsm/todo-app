<?php declare(strict_types = 1);

namespace Todo\Controllers\Task;

use Todo\Controllers\AbstractController;

class Add extends AbstractController
{
    public function execute()
    {
        return $this->view->json([123]);
    }
}