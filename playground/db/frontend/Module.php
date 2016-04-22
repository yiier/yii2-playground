<?php

namespace playground\db\frontend;

use playground\core\frontend\contracts\ModuleNav;

class Module
    extends \yii\base\Module
    implements ModuleNav
{
    public $controllerNamespace = 'playground\db\frontend\controllers';

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
            'label' => 'db',
            'url' => ['/db'],
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
                'label'=>'format-converter',
                'url'=>['/db/format-converter']
            ],

        ];
    }
}
