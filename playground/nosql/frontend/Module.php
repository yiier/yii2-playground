<?php

namespace playground\nosql\frontend;
use playground\core\frontend\components\ActionsDetectable;
use playground\core\frontend\contracts\ModuleNav;

/**
 * nosql module definition class
 */
class Module
    extends \yii\base\Module
    implements ModuleNav
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'playground\nosql\frontend\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    use ActionsDetectable ;
    /**
     * navigation for current module
     *
     * @return mixed|array
     */
    public static function getNavConfig()
    {
            return [
                'label'=>'nosql',
                'url'=>['/nosql'],
            ];
        }


}
