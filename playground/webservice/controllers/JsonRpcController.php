<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2016/4/20
 * Time: 18:24
 */

namespace playground\webservice\controllers;


use nizsheanez\jsonRpc\Action;
use nizsheanez\jsonRpc\Client;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * Class JsonRpcController
 * @package playground\webservice\controllers
 */
class JsonRpcController extends Controller
{
    /**
     * @return array
     */
    public function actions()
    {
        return array(
           // 'index' => array(
            'index' => array(
               // 'class' => '\nizsheanez\JsonRpc\Action',
                'class' => Action::className(),
            ),
        );
    }

    public function sum($a, $b) {
        return $a + $b;
    }

    /**
     * test the json rpc  . this is the client side
     */
    public function actionClient()
    {
        // $client = new \nizsheanez\JsonRpc\Client(Url::to(['index'],true));
        $client = new Client(Url::to(['index'],true));

        $response = $client->sum(2, 3);
        echo $response;
    }
}