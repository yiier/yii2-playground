<?php
/**
 * author     : forecho <caizh@snsshop.com>
 * createTime : 2015/5/7 13:56
 * description:
 */

namespace frontend\modules\queue\controllers;

use udokmeci\yii2beanstalk\BeanstalkController;
use yii\helpers\Console;
use Yii;

class WorkerController extends BeanstalkController
{
    // Those are the default values you can override

    const DELAY_PIRORITY = "1000"; //Default priority
    const DELAY_TIME = 5; //Default delay time

    // Used for Decaying. When DELAY_MAX reached job is deleted or delayed with
    // DELAY_TIME ^ (delay_count+1)
    const DELAY_MAX = 3;

    public function listenTubes()
    {
        return ["tube"];
    }

    /**
     * @param $job
     * @return string
     */
    public function actionTube($job)
    {
        $sentData = $job->getData();
        $date = date("Y-m-d H:i:s");
        file_put_contents("test.txt", "[{$date}]Hello World. Testing!\n", FILE_APPEND);;
        var_dump($sentData);
        return false;
    }
}