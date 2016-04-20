<?php

namespace playground\webservice;
use playground\core\frontend\contracts\ModuleNav;

/**
 * webservice module definition class
 */
class Module
    extends \yii\base\Module
implements ModuleNav
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'playground\webservice\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    /**
     * navigation for current module
     *
     * @return mixed|array
     */
    public static function getNavConfig()
    {
        return [
            'label' => 'web-service',
            'url' => ['/webservice'],
        ];
    }
}
