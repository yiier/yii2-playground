<?php

namespace playground\queue;

use playground\core\frontend\contracts\ModuleNav;

class Module
    extends \yii\base\Module
    implements ModuleNav
{
    public $controllerNamespace = 'playground\queue\controllers';

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
            'label' => 'Queue',
            'url' => ['/queue'],
        ];
    }
}
