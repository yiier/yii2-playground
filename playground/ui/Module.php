<?php

namespace playground\ui;

use playground\core\frontend\contracts\ModuleNav;

class Module extends \yii\base\Module
implements ModuleNav
{
    public $controllerNamespace = 'playground\ui\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    /**
     * @return mixed|array
     */
    public static function getNavConfig()
    {
        // TODO: Implement getNavConfig() method.
        return [
            'label' => 'UI',
            'url' => ['/ui'],
        ];

    }
}
