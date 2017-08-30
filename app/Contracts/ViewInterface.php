<?php

namespace Todo\Contracts;

interface ViewInterface
{
    /**
     * @param $file
     * @param array $data
     * @return mixed
     */
    public function render($file, $data = []);

    public function json($data);
}