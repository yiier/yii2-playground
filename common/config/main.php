<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
    'controllerMap' => [
        'worker'=>[
            'class' => 'frontend\modules\queue\controllers\WorkerController',
        ]

    ],
];
