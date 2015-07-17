<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2015/7/17
 * Time: 12:33
 */

namespace frontend\modules\others\controllers;


use ijackwu\ssdb\Connection;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;
use yii\web\Controller;

class SsdbController extends Controller
{

    /**
     * @var \Redis
     */
    public $ssdb;

    /**
     * @param \yii\base\Action $action
     * @return bool
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        /**
         * ssdb 测试监听的是8883端口
         */
        $this->ssdb = \Yii::createObject([
            //  'class' => 'ijackwu\ssdb\Connection',
            'class' => Connection::className(), // 'ijackwu\ssdb\Connection',
            'host' => 'localhost',
            'port' => 8883, //   8888,
        ]);
        // 准备捕获action的输出
        ob_start();

        return parent::beforeAction($action);
    }

    public function afterAction($action, $result)
    {
        $result = parent::afterAction($action, $result);

        // your custom code here

        $obResult = ob_get_clean() ;
        if(!empty($obResult)){
           // 所有actionXxx中 如果出现 echo print dump 等向缓存输出内容的调用 将走此逻辑
            return $this->renderContent($obResult) ;
            // return $obResult ;
        }

        return $result;
    }

    public function  actionIndex()
    {
        $actions = [];
        $rc = new \ReflectionClass($this);
        $publicMethods = $rc->getMethods(\ReflectionMethod::IS_PUBLIC);

        $availableActions = [] ;
        foreach($publicMethods as $publicMethod)
        {
             $methodName = $publicMethod->name ;
            if($methodName == 'actions'){
                continue ;
            }
             if(StringHelper::startsWith($methodName,'action')){

                 $availableActions[] = $methodName ;
             }
        }
        if(count($this->actions()) > 0){
            $availableActions = $availableActions + array_keys($this->actions());
        }

        $menus = [] ;
        foreach($availableActions as $actionName){
            $routeId = Inflector::camel2id( substr($actionName,strlen('action'))) ;
            $menus[] = Html::a($actionName,[$routeId]);
        }

        echo implode('<br/>',$menus) ;

    }

    /**
     * 测试设置
     */
    public function actionSet()
    {
        $redis = $this->ssdb;
        $redis->set('myKey', 'yes ssdb as redis');

        print_r($redis->get('myKey'));
    }
    public function actionDelete()
    {
        $key = __METHOD__ ;
        $this->ssdb->set($key,__METHOD__);
        print_r([
           'key'=>$key,
            'val'=>$this->ssdb->get($key),
        ]);
        // delete it
        $this->ssdb->del($key); // delete操作失效 但del可用！
        print_r([
            'after delete: ',
           'key'=>$key ,
            'val'=>$this->ssdb->get($key),
        ]);
    }
}