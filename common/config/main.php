<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'beanstalk'    => [
            'class'          => 'udokmeci\yii2beanstalk\Beanstalk',
            'host'           => "127.0.0.1", // default host
            'port'           => 11300, //default port
            'connectTimeout' => 1,
            'sleep'          => false, // or int for usleep after every job
        ],
    ],
    'controllerMap' => [
        /*
        'worker'=>[
            'class' => 'frontend\modules\queue\controllers\WorkerController',
        ]
        */
    ],
];
