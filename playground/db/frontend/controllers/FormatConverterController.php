<?php

namespace playground\db\frontend\controllers;

use mdm\converter\DateConverter;
use yii\base\DynamicModel;

class FormatConverterController extends \yii\web\Controller
{
    public function actionIndex()
    {

      $model = new DynamicModel([
         'created_at'=>time() ,
      ]);

        $model->attachBehavior('format',[
            'class' =>  DateConverter::className(), //'mdm\converter\DateConverter',
            'logicalFormat' => 'php:d/m/Y', // your readeble datetime format, default to 'd-m-Y'
            'physicalFormat' => 'php:time',// 'Y-m-d', // database level format, default to 'Y-m-d'
            'attributes' => [
                'createAt' => 'created_at', // sales_date is original attribute
            ]
        ]);


        var_dump($model->createAt) ;

        $model->createAt = '10/59/2015' ;

        var_dump($model->created_at) ;
        print_r([
           $model->created_at,
            time(),
        ]);
        echo str_repeat('=','5');
        $model->created_at = time() ;
        print_r([
           $model->createAt,
            $model->created_at ,
        ]);

        die(__METHOD__) ;
       // return $this->render('index');
    }

}
