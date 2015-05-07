<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id'                  => 'app-frontend',
    'basePath'            => dirname(__DIR__),
    'bootstrap'           => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules'             => [
        'queue' => [
            'class' => 'frontend\modules\queue\Module',
        ],
    ],
    'components'          => [
        'user'         => [
            'identityClass'   => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'urlManager'   => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules'           => [
                '<controller:\w+>/<action:\w+>/<id:\d+>'                         => '<controller>/<action>',
                '<module:(queue|admins)>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',
            ],
        ],
        'beanstalk'    => [
            'class'          => 'udokmeci\yii2beanstalk\Beanstalk',
            'host'           => "127.0.0.1", // default host
            'port'           => 11300, //default port
            'connectTimeout' => 1,
            'sleep'          => false, // or int for usleep after every job
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],

    'params'              => $params,
    'controllerMap'       => [
        'worker' => [
            'class' => 'app\commands\WorkerController',
        ]

    ],
];
