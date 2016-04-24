<?php

namespace playground\networking\console\controllers;
use yii\console\Controller;


/**
 * Default controller for the `networking` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

        $this->stdout(__METHOD__) ;
        return static::EXIT_CODE_NORMAL ;
    }
}
