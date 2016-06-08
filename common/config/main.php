<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'db' => [
            'dsn' => 'mysql:host=localhost;dbname=',
            'username' => '',
            'password' => '',
            'tablePrefix' => '',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
