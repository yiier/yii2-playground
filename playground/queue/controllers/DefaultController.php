<?php

namespace playground\queue\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $r1 = rand(1000, 9999);
        $r2 = rand(1000, 9999);
        $mixedData = "{{$r1}:{$r2}}";
        \Yii::$app->beanstalk->putInTube('tube', $mixedData);
        \Yii::$app->beanstalk->putInTube('test', $mixedData);
        var_dump($mixedData);
        return $this->render('index');
    }
}
