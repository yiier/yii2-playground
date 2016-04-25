<?php

namespace playground\networking\front;
use playground\core\frontend\contracts\ModuleNav;

/**
 * networking module definition class
 */
class Module
    extends \yii\base\Module
    implements ModuleNav
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'playground\networking\front\controllers';

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
            'label' => 'networking',
            'url' => ['/networking'],
        ];
    }

    /**
     * for module sidebar
     *
     * @return array|mix
     */
    public static function getSidebar()
    {
        return [

            [
                'label'=>'websocket',
                'url'=>['/networking/ws/test']
            ],
        ];
    }
}
