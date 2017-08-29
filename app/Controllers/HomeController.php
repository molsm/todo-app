<?php

namespace Todo\Controllers;

use Todo\Controllers\AbstractController;

class HomeController extends AbstractController
{
    protected $baz;

    public function __construct(\Todo\Controllers\Baz $baz)
    {
        $this->baz = $baz;
    }

    public function execute()
    {
        return $this->baz->test();
    }
}