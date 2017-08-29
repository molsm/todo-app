<?php

return [
    'templatePath' => 'resources/view',

    'providers' => [
        \Todo\Provider\AppServiceProvider::class,
        \Todo\Provider\RouterServiceProvider::class
    ]
];