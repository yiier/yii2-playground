<?php

namespace frontend\modules\queue\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $r1 = rand(1000, 9999);
        $r2 = rand(1000, 9999);
        $mixedData = "{{$r1}:{$r2}}";
        $tube = \Yii::$app->beanstalk->putInTube('tube', $mixedData);
        var_dump($tube);
        return $this->render('index');
    }
}
