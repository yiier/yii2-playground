<?php

namespace playground\fs;

use playground\core\frontend\components\ActionsDetectable;
use playground\core\frontend\contracts\ModuleNav;

class Module
    extends \yii\base\Module
implements ModuleNav
{
    public $controllerNamespace = 'playground\fs\controllers';

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
            'label' => 'fs',
            'url' => ['/fs'],
        ];
    }
}
