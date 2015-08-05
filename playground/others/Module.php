<?php

namespace playground\others;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'playground\others\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
        \Yii::$app->set('redis', [
            'class' => 'ijackwu\ssdb\Connection',
            'host' => 'localhost',
            'port' => 8888,
        ]);
    }
}
