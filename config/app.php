<?php

return [
    'templatePath' => 'resources/views',

    'providers' => [
        \Todo\Provider\RouterServiceProvider::class,
        \Todo\Provider\AppServiceProvider::class
    ]
];