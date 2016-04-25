<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2016/4/25
 * Time: 0:24
 */

namespace playground\networking\front\controllers;


use yii\web\Controller;

use WebSocket\Client;

class WsController extends Controller
{

    public function actionTest()
    {

        // $client = new Client("ws://echo.websocket.org/");
        // @see http://emqtt.io/docs/guide.html#mqtt-over-websocket
        $client = new Client("ws://localhost:8083/mqtt"); // emqtt 默认监听端口
        $client->send("Hello WebSocket.org!");

        echo $client->receive(); // Will output 'Hello WebSocket.org!'
    }

}