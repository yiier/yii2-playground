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
            'class' => 'playground\queue\Module',
        ],
        'ui' => [
            'class' => 'playground\ui\Module',
        ],
        // for file system
        'fs' => [
            'class' => 'playground\fs\Module',
        ],
        // for the category others
        'others' => [
            'class' => 'playground\others\Module',
        ],
    ],
    'components'          => [
        'user'         => [
            'identityClass'   => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        //'urlManager'   => [
        //    'enablePrettyUrl' => true,
        //    'showScriptName'  => false,
        //    'rules'           => [
        //        '<controller:\w+>/<action:\w+>/<id:\d+>'                         => '<controller>/<action>',
        //        '<module:(queue|admins)>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',
        //    ],
        //],
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

        //...
        'fs' => [
            'class' => 'creocoder\flysystem\LocalFilesystem',
            'path' => '@webroot/uploads/files',
        ],
    ],
    'params'              => $params,
];
