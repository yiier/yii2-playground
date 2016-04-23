<?php
/**
 * Created by PhpStorm.
 * User: yiqing
 * Date: 2016/4/23
 * Time: 11:29
 */

namespace playground\ui\controllers;


use yii\web\Controller;
use yiier\web\Layout;

/**
 * Class LayoutController
 * @package playground\ui\controllers
 */
class LayoutController  extends Controller
{
    /**
     * 使用本模块的布局
     *
     * @var string
     */
    public $layout = 'main' ;


    /**
     * @return string
     * @throws \yiier\web\Exception
     */
    public function actionIndex()
    {
        // + -----------------------------------------------------------------------------  +
        //                              ## 此段代码亦可出现在视图文件中
        Layout::addBlock('sidebar.right', array(
            'id'=>'right_sidebar',
            'content'=>'the content you want to add to your layout', // eg the result of a partial or widget
            /*
    $this->renderPartial('/partial/aspect_index_right', array(
            'aspects'=>$user->aspects,
            'controller'=>$this,
        ), true)
    */
        ));
    // + -----------------------------------------------------------------------------  +

        return $this->render('index');
    }

}